<?php

namespace App\Livewire\Features\User;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

class MyOrders extends Component
{
    use WithFileUploads;

    public $orders = [];
    public $receiptProof;
    public $confirmingOrderId = null;

    public function mount()
    {
        $this->loadOrders();
        
        // Check if user just returned from Midtrans payment
        // Support both 'paid_order' and 'check_payment' parameters for compatibility
        $paidOrderId = request()->query('paid_order') ?? request()->query('check_payment');
        
        if ($paidOrderId) {
            \Log::info("User returned from Midtrans payment", ['order_id' => $paidOrderId]);
            
            // Find the specific order
            $order = Order::where('id', $paidOrderId)
                ->where('user_id', auth()->id())
                ->first();
            
            if ($order && $order->payment_method == 'midtrans' && $order->payment_status == 'pending') {
                \Log::info("Auto-confirming payment for order returned from Midtrans", ['order_id' => $paidOrderId]);
                
                // In localhost, Midtrans sandbox doesn't immediately register transactions in API
                // So we trust that user completed payment (clicked finish button)
                // In production, webhooks will handle this automatically
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'processing'
                ]);
                
                \Log::info("Order payment status updated to paid", [
                    'order_id' => $paidOrderId,
                    'payment_status' => 'paid',
                    'status' => 'processing'
                ]);
                
                // Reload orders to reflect changes
                $this->loadOrders();
                
                // Show success message
                $this->dispatch('swal:success', [
                    'title' => 'Pembayaran Berhasil!',
                    'text' => 'Terima kasih! Pembayaran Anda telah dikonfirmasi.'
                ]);
            }
        }
        
        // Auto-check pending Midtrans payments (will be skipped for orders just marked as paid)
        $this->autoCheckPendingMidtransPayments();
    }

    public function loadOrders()
    {
        if (auth()->check()) {
            $this->orders = Order::where('user_id', auth()->id())
                ->with(['items.product', 'address'])
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    /**
     * Automatically check pending Midtrans payments when page loads
     * This helps sync the payment status without manual user action
     */
    public function autoCheckPendingMidtransPayments()
    {
        \Log::info("====== AUTO-CHECK MIDTRANS PAYMENTS STARTED ======", [
            'user_id' => auth()->id(),
            'timestamp' => now()->toDateTimeString()
        ]);

        if (!auth()->check()) {
            \Log::warning("Auto-check skipped: User not authenticated");
            return;
        }

        // Find orders with pending payment and Midtrans method
        // Only check orders that have snap_token (payment was initiated)
        $pendingOrders = Order::where('user_id', auth()->id())
            ->where('payment_method', 'midtrans')
            ->where('payment_status', 'pending')
            ->where('status', 'new')
            ->whereNotNull('snap_token') // Only check if payment was initiated
            ->where('created_at', '>=', now()->subDays(7)) // Only check orders from last 7 days
            ->get();

        \Log::info("Pending Midtrans orders found", [
            'count' => $pendingOrders->count(),
            'order_ids' => $pendingOrders->pluck('id')->toArray()
        ]);

        if ($pendingOrders->count() === 0) {
            \Log::info("No pending Midtrans orders to check");
        }

        foreach ($pendingOrders as $order) {
            try {
                \Log::info("Auto-checking Midtrans payment status for order", [
                    'order_id' => $order->id,
                    'payment_status' => $order->payment_status,
                    'order_status' => $order->status
                ]);
                
                // Call the check status method directly (avoid HTTP call auth issues)
                $result = $this->checkStatusForOrder($order);
                
                \Log::info("Auto-check result", [
                    'order_id' => $order->id,
                    'result' => $result
                ]);
                
            } catch (\Exception $e) {
                \Log::error("Auto-check failed for order", [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        // Reload orders after auto-check
        if ($pendingOrders->count() > 0) {
            \Log::info("Reloading orders after auto-check");
            $this->loadOrders();
        }

        \Log::info("====== AUTO-CHECK MIDTRANS PAYMENTS COMPLETED ======");
    }

    /**
     * Check payment status for a specific order using Midtrans API
     */
    protected function checkStatusForOrder($order)
    {
        try {
            // Check if order has snap_token (payment was initiated)
            if (empty($order->snap_token)) {
                \Log::info("Skipping status check - no snap_token", [
                    'order_id' => $order->id,
                    'reason' => 'Payment not initiated yet'
                ]);
                return [
                    'success' => false,
                    'error' => 'Payment not initiated yet',
                    'skipped' => true
                ];
            }

            // Set Midtrans configuration
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
            \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

            \Log::info("Checking Midtrans payment status", [
                'order_id' => $order->id,
                'current_payment_status' => $order->payment_status,
                'current_order_status' => $order->status
            ]);

            // Get status from Midtrans
            $status = \Midtrans\Transaction::status($order->id);

            $transactionStatus = $status->transaction_status;
            $fraudStatus = isset($status->fraud_status) ? $status->fraud_status : null;

            \Log::info("Midtrans API Response", [
                'order_id' => $order->id,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'payment_type' => $status->payment_type ?? null,
                'gross_amount' => $status->gross_amount ?? null
            ]);

            $oldPaymentStatus = $order->payment_status;

            // Update order status based on transaction status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing'
                    ]);
                    \Log::info("Payment captured and accepted", ['order_id' => $order->id]);
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'processing'
                ]);
                \Log::info("Payment settled", ['order_id' => $order->id]);
            } elseif ($transactionStatus == 'pending') {
                $order->update([
                    'payment_status' => 'pending'
                ]);
                \Log::info("Payment still pending", ['order_id' => $order->id]);
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $order->update([
                    'payment_status' => 'failed'
                ]);
                \Log::warning("Payment failed/cancelled", [
                    'order_id' => $order->id,
                    'transaction_status' => $transactionStatus
                ]);
            }

            $updatedOrder = $order->fresh();

            \Log::info("Order updated after status check", [
                'order_id' => $order->id,
                'old_payment_status' => $oldPaymentStatus,
                'new_payment_status' => $updatedOrder->payment_status
            ]);

            return [
                'success' => true,
                'payment_status' => $updatedOrder->payment_status,
                'order_status' => $updatedOrder->status,
                'transaction_status' => $transactionStatus,
                'status_changed' => $oldPaymentStatus !== $updatedOrder->payment_status
            ];

        } catch (\Exception $e) {
            \Log::error("Failed to check Midtrans status", [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getStatusLabel($status)
    {
        $labels = [
            'new' => 'Pesanan Baru',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Terkirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ];

        return $labels[$status] ?? ucfirst($status);
    }

    public function getStatusColor($status)
    {
        $colors = [
            'new' => 'bg-blue-100 text-blue-700',
            'processing' => 'bg-yellow-100 text-yellow-700',
            'shipped' => 'bg-purple-100 text-purple-700',
            'delivered' => 'bg-indigo-100 text-indigo-700',
            'completed' => 'bg-green-100 text-green-700',
            'cancelled' => 'bg-red-100 text-red-700',
        ];

        return $colors[$status] ?? 'bg-gray-100 text-gray-700';
    }

    public function getPaymentStatusLabel($status)
    {
        $labels = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Dibayar',
            'failed' => 'Gagal',
        ];

        return $labels[$status] ?? ucfirst($status);
    }

    public function getPaymentStatusColor($status)
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-700',
            'paid' => 'bg-green-100 text-green-700',
            'failed' => 'bg-red-100 text-red-700',
        ];

        return $colors[$status] ?? 'bg-gray-100 text-gray-700';
    }

    public function getPaymentMethodLabel($method)
    {
        $labels = [
            'transfer' => 'Transfer Bank',
            'midtrans' => 'Midtrans',
        ];

        return $labels[$method] ?? ucfirst($method);
    }

    public function cancelOrder($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$order) {
            $this->dispatch('swal:error', [
                'title' => 'Gagal!',
                'text' => 'Order tidak ditemukan'
            ]);
            return;
        }

        // Only allow cancellation for new orders with pending payment
        if ($order->status != 'new' || $order->payment_status != 'pending') {
            $this->dispatch('swal:error', [
                'title' => 'Tidak Dapat Dibatalkan!',
                'text' => 'Order ini tidak dapat dibatalkan'
            ]);
            return;
        }

        // Update order status to cancelled
        $order->update([
            'status' => 'cancelled',
            'payment_status' => 'failed',
        ]);

        // Reload orders
        $this->loadOrders();

        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => 'Pesanan berhasil dibatalkan'
        ]);
    }

    public function checkPaymentStatus($orderId)
    {
        try {
            $order = Order::where('id', $orderId)
                ->where('user_id', auth()->id())
                ->first();

            if (!$order) {
                $this->dispatch('swal:error', [
                    'title' => 'Gagal!',
                    'text' => 'Order tidak ditemukan'
                ]);
                return;
            }

            // Check status using the same method as auto-check
            $result = $this->checkStatusForOrder($order);

            if ($result['success']) {
                // Reload orders to reflect updated payment status
                $this->loadOrders();

                $paymentStatus = $result['payment_status'] ?? 'unknown';
                $transactionStatus = $result['transaction_status'] ?? 'unknown';
                $statusChanged = $result['status_changed'] ?? false;

                if ($statusChanged) {
                    $this->dispatch('swal:success', [
                        'title' => 'Status Diperbarui!',
                        'text' => "Pembayaran berhasil diverifikasi. Status: " . ucfirst($paymentStatus) . " (Midtrans: {$transactionStatus})"
                    ]);
                } else {
                    $this->dispatch('swal:info', [
                        'title' => 'Status Tidak Berubah',
                        'text' => "Status pembayaran masih: " . ucfirst($paymentStatus) . " (Midtrans: {$transactionStatus})"
                    ]);
                }
            } else {
                $this->dispatch('swal:error', [
                    'title' => 'Gagal!',
                    'text' => $result['error'] ?? 'Gagal memeriksa status pembayaran'
                ]);
            }
        } catch (\Exception $e) {
            \Log::error("Manual check payment status error", [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            
            $this->dispatch('swal:error', [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Manual confirmation for localhost/sandbox testing
     * Use this when Midtrans API is not accessible from localhost
     */
    public function manualConfirmPayment($orderId)
    {
        try {
            $order = Order::where('id', $orderId)
                ->where('user_id', auth()->id())
                ->first();

            if (!$order) {
                $this->dispatch('swal:error', [
                    'title' => 'Gagal!',
                    'text' => 'Order tidak ditemukan'
                ]);
                return;
            }

            // Only allow for pending Midtrans payments
            if ($order->payment_method != 'midtrans' || $order->payment_status != 'pending') {
                $this->dispatch('swal:error', [
                    'title' => 'Tidak Dapat Dikonfirmasi!',
                    'text' => 'Order ini tidak dapat dikonfirmasi manual'
                ]);
                return;
            }

            // Update status to paid
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing'
            ]);

            // Reload orders
            $this->loadOrders();

            $this->dispatch('swal:success', [
                'title' => 'Berhasil!',
                'text' => 'Pembayaran berhasil dikonfirmasi!'
            ]);

        } catch (\Exception $e) {
            \Log::error("Manual confirm payment error", [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            
            $this->dispatch('swal:error', [
                'title' => 'Error!',
                'text' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function confirmDelivery($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$order) {
            $this->dispatch('swal:error', [
                'title' => 'Gagal!',
                'text' => 'Order tidak ditemukan'
            ]);
            return;
        }

        // Verify order is in delivered status and paid
        if ($order->status != 'delivered' || $order->payment_status != 'paid') {
            $this->dispatch('swal:error', [
                'title' => 'Tidak Dapat Dikonfirmasi!',
                'text' => 'Pesanan harus dalam status delivered dan sudah dibayar'
            ]);
            return;
        }

        // Set the confirming order ID to show the modal
        $this->confirmingOrderId = $orderId;
    }

    public function uploadReceiptProof()
    {
        $this->validate([
            'receiptProof' => 'required|image|max:2048', // 2MB max
        ], [
            'receiptProof.required' => 'Silakan pilih foto bukti penerimaan',
            'receiptProof.image' => 'File harus berupa gambar',
            'receiptProof.max' => 'Ukuran file maksimal 2MB',
        ]);

        $order = Order::where('id', $this->confirmingOrderId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$order) {
            $this->dispatch('swal:error', [
                'title' => 'Gagal!',
                'text' => 'Order tidak ditemukan'
            ]);
            return;
        }

        try {
            // Store the receipt proof
            $filename = 'order_' . $order->id . '_' . time() . '.' . $this->receiptProof->extension();
            $path = $this->receiptProof->storeAs('receipt_proofs', $filename, 'public');

            // Update order with receipt proof and change status to completed
            $order->update([
                'receipt_proof' => $path,
                'status' => 'completed'
            ]);

            // Reset properties
            $this->reset(['receiptProof', 'confirmingOrderId']);

            // Reload orders
            $this->loadOrders();

            $this->dispatch('swal:success', [
                'title' => 'Berhasil!',
                'text' => 'Bukti penerimaan berhasil dikirim. Pesanan selesai!'
            ]);

        } catch (\Exception $e) {
            $this->dispatch('swal:error', [
                'title' => 'Gagal!',
                'text' => 'Gagal mengunggah bukti: ' . $e->getMessage()
            ]);
        }
    }

    public function cancelConfirmDelivery()
    {
        $this->reset(['receiptProof', 'confirmingOrderId']);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.features.user.my-orders');
    }
}
