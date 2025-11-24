<?php

namespace App\Livewire\Features\User;

use App\Models\Brand;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Brands extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $brands = Brand::where('is_active', true)->get();

        return view('livewire.features.user.brands', [
            'brands' => $brands,
        ]);
    }
}
