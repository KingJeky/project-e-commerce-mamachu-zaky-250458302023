<?php

namespace App\Livewire\Features\User;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Livewire\Component;
use Livewire\Attributes\Layout;

class OrderPage extends Component
{
    public $cart;
    public $cartItems = [];
    public $addresses = [];
    public $selectedAddressId;
    public $paymentMethod = 'transfer';
    public $notes = '';
    
    public function mount()
    {
        $this->loadCart();
        $this->loadAddresses();
        
        // Redirect if cart is empty
        if ($this->cartItems->count() == 0) {
            session()->flash('error', 'Keranjang belanja Anda kosong');
            return redirect()->route('user.cart');
        }
        
        // Set default address if exists
        $defaultAddress = $this->addresses->where('is_default', true)->first();
        if ($defaultAddress) {
            $this->selectedAddressId = $defaultAddress->id;
        } elseif ($this->addresses->count() > 0) {
            $this->selectedAddressId = $this->addresses->first()->id;
        }
    }
    
    public function loadCart()
    {
        if (auth()->check()) {
            $this->cart = Cart::firstOrCreate(
                ['user_id' => auth()->id()]
            );
            
            $this->cartItems = CartItem::where('cart_id', $this->cart->id)
                ->with(['product.category', 'product.brand'])
                ->get();
        }
    }
    
    public function loadAddresses()
    {
        if (auth()->check()) {
            $this->addresses = Address::where('user_id', auth()->id())
                ->orderBy('is_default', 'desc')
                ->get();
        }
    }
    
    public function getSubtotal()
    {
        return $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
    
    public function placeOrder()
    {
        // Validate
        $this->validate([
            'selectedAddressId' => 'required|exists:addresses,id',
            'paymentMethod' => 'required|in:transfer',
            'notes' => 'nullable|string|max:500',
        ], [
            'selectedAddressId.required' => 'Silakan pilih alamat pengiriman',
            'selectedAddressId.exists' => 'Alamat tidak valid',
            'paymentMethod.required' => 'Silakan pilih metode pembayaran',
            'paymentMethod.in' => 'Metode pembayaran tidak valid',
        ]);
        
        // Check cart is not empty
        if ($this->cartItems->count() == 0) {
            $this->dispatch('swal:error', [
                'title' => 'Gagal!',
                'text' => 'Keranjang belanja kosong'
            ]);
            return;
        }
        
        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'address_id' => $this->selectedAddressId,
            'grand_total' => $this->getSubtotal(),
            'payment_method' => $this->paymentMethod,
            'payment_status' => 'pending',
            'status' => 'new',
            'currency' => 'IDR',
            'shipping_amount' => 0,
            'shipping_method' => 'regular',
            'notes' => $this->notes,
        ]);
        
        // Create order items from cart items
        foreach ($this->cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'unit_amount' => $cartItem->product->price,
                'total_amount' => $cartItem->product->price * $cartItem->quantity,
            ]);
        }
        
        // Clear cart
        CartItem::where('cart_id', $this->cart->id)->delete();
        
        // Dispatch event to update cart counter
        $this->dispatch('cartUpdated')->to('components.cart-counter');
        
        // Flash success message
        session()->flash('success', 'Pesanan berhasil dibuat! Order ID: #' . $order->id);
        
        // Redirect to my orders page
        return redirect()->route('user.my-orders');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.features.user.order-page', [
            'subtotal' => $this->getSubtotal(),
        ]);
    }
}
