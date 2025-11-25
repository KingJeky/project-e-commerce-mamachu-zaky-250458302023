<?php

namespace App\Livewire\Features\User;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;
use Livewire\Attributes\Layout;

class CartPage extends Component
{
    public $cart;
    public $cartItems = [];

    public function mount()
    {
        $this->loadCart();
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

    public function updateQuantity($cartItemId, $quantity)
    {
        if ($quantity < 1) {
            return;
        }

        $cartItem = CartItem::find($cartItemId);
        if ($cartItem && $cartItem->cart_id == $this->cart->id) {
            $cartItem->update(['quantity' => $quantity]);
            $this->loadCart();
            
            $this->dispatch('swal:success', [
                'title' => 'Berhasil!',
                'text' => 'Jumlah item diupdate'
            ]);

            // Dispatch event to update cart counter
            $this->dispatch('cartUpdated')->to('components.cart-counter');
        }
    }

    public function removeItem($cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);
        if ($cartItem && $cartItem->cart_id == $this->cart->id) {
            $productName = $cartItem->product->name;
            $cartItem->delete();
            $this->loadCart();
            
            $this->dispatch('swal:success', [
                'title' => 'Dihapus!',
                'text' => $productName . ' telah dihapus dari keranjang'
            ]);

            // Dispatch event to update cart counter
            $this->dispatch('cartUpdated')->to('components.cart-counter');
        }
    }

    public function clearCart()
    {
        if ($this->cart) {
            CartItem::where('cart_id', $this->cart->id)->delete();
            $this->loadCart();
            
            $this->dispatch('swal:success', [
                'title' => 'Keranjang Dikosongkan!',
                'text' => 'Semua item telah dihapus'
            ]);

            // Dispatch event to update cart counter
            $this->dispatch('cartUpdated')->to('components.cart-counter');
        }
    }

    public function getSubtotal()
    {
        return $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.features.user.cart-page', [
            'subtotal' => $this->getSubtotal(),
        ]);
    }
}
