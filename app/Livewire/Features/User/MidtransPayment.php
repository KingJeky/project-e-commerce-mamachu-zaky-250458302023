<?php

namespace App\Livewire\Features\User;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

class MidtransPayment extends Component
{
    public $orderId;
    public $order;
    public $snapToken;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->loadOrder();

        // Redirect if order not found or not belong to user
        if (!$this->order || $this->order->user_id != auth()->id()) {
            session()->flash('error', 'Order tidak ditemukan');
            return redirect()->route('user.my-orders');
        }

        // Redirect if already paid
        if ($this->order->payment_status == 'paid') {
            session()->flash('info', 'Order sudah dibayar');
            return redirect()->route('user.my-orders');
        }

        // Redirect if not using Midtrans
        if ($this->order->payment_method != 'midtrans') {
            session()->flash('error', 'Order ini tidak menggunakan metode pembayaran Midtrans');
            return redirect()->route('user.my-orders');
        }

        // Generate token if not exists
        if (!$this->order->snap_token) {
            $this->generateSnapToken();
        } else {
            $this->snapToken = $this->order->snap_token;
        }
    }

    public function loadOrder()
    {
        $this->order = Order::with(['items.product', 'address'])
            ->where('id', $this->orderId)
            ->first();
    }

    private function generateSnapToken()
    {
        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        // Prepare transaction details
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->id,
                'gross_amount' => (int) $this->order->grand_total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [],
            'callbacks' => [
                'finish' => route('user.my-orders', ['paid_order' => $this->order->id]),
            ],
        ];

        // Add items
        foreach ($this->order->items as $item) {
            $params['item_details'][] = [
                'id' => $item->product_id,
                'price' => (int) $item->unit_amount,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
        }

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $this->order->update(['snap_token' => $snapToken]);
            $this->snapToken = $snapToken;
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal generate token pembayaran: ' . $e->getMessage());
            return redirect()->route('user.my-orders');
        }
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.features.user.midtrans-payment');
    }
}
