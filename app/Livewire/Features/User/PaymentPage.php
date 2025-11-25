<?php

namespace App\Livewire\Features\User;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

class PaymentPage extends Component
{
    use WithFileUploads;

    public $orderId;
    public $order;
    public $paymentProof;

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
    }

    public function loadOrder()
    {
        $this->order = Order::with(['items.product', 'address'])
            ->where('id', $this->orderId)
            ->first();
    }

    public function submitPayment()
    {
        $this->validate([
            'paymentProof' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2MB max
        ], [
            'paymentProof.required' => 'Silakan upload bukti pembayaran',
            'paymentProof.image' => 'File harus berupa gambar',
            'paymentProof.mimes' => 'Format file harus jpeg, png, atau jpg',
            'paymentProof.max' => 'Ukuran file maksimal 2MB',
        ]);

        // Store the file
        $filename = 'payment_' . $this->orderId . '_' . time() . '.' . $this->paymentProof->extension();
        $path = $this->paymentProof->storeAs('payment_proofs', $filename, 'public');

        // Update order
        $this->order->update([
            'payment_proof' => $path,
            'payment_status' => 'paid',
        ]);

        session()->flash('success', 'Bukti pembayaran berhasil diupload! Pesanan Anda sedang diproses.');
        return redirect()->route('user.my-orders');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.features.user.payment-page');
    }
}
