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
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();

        return view('livewire.features.user.home', [
            'brands' => $brands,
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
