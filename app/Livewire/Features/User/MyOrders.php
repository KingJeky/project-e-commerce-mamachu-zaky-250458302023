<?php

namespace App\Livewire\Features\User;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

class MyOrders extends Component
{
    public $orders = [];

    public function mount()
    {
        $this->loadOrders();
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

    public function getStatusLabel($status)
    {
        $labels = [
            'new' => 'Pesanan Baru',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
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

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.features.user.my-orders');
    }
}
