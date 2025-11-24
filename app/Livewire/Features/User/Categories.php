<?php

namespace App\Livewire\Features\User;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Categories extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $categories = Category::where('is_active', true)->withCount('products')->get();

        return view('livewire.features.user.categories', [
            'categories' => $categories,
        ]);
    }
}
