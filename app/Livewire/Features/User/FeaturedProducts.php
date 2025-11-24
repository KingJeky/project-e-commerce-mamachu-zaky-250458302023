<?php

namespace App\Livewire\Features\User;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

class FeaturedProducts extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $products = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with(['category', 'brand'])
            ->get();

        return view('livewire.features.user.featured-products', [
            'products' => $products,
        ]);
    }
}
