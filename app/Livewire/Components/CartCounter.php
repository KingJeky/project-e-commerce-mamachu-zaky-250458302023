<?php

namespace App\Livewire\Components;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;

class CartCounter extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => '$refresh'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->first();
            if ($cart) {
                $this->cartCount = CartItem::where('cart_id', $cart->id)->sum('quantity');
            } else {
                $this->cartCount = 0;
            }
        }
    }

    public function render()
    {
        $this->updateCartCount();
        return view('livewire.components.cart-counter');
    }
}
