<?php

namespace App\Livewire\Features\User;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ProductDetail extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'brand'])
            ->firstOrFail();
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Get or create user's cart
        $cart = \App\Models\Cart::firstOrCreate(
            ['user_id' => auth()->id()]
        );

        // Check if product already in cart
        $cartItem = \App\Models\CartItem::where('cart_id', $cart->id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($cartItem) {
            // Update quantity if item already exists
            $cartItem->increment('quantity', $this->quantity);
        } else {
            // Create new cart item
            \App\Models\CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,
                'quantity' => $this->quantity
            ]);
        }

        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => $this->product->name . ' ditambahkan ke keranjang (' . $this->quantity . ' item)'
        ]);

        // Reset quantity
        $this->quantity = 1;
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.features.user.product-detail');
    }
}
