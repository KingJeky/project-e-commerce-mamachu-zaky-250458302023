<?php

namespace App\Livewire\Features\User;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Layout;

class Home extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $brands = Brand::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->withCount('products')->get();
        $products = Product::where('is_active', true)->where('is_featured', true)->get();

        return view('livewire.features.user.home', [
            'brands' => $brands,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
