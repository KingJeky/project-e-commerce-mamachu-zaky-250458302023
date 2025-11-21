<?php

namespace App\Livewire\Features\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Dashboard extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.features.user.dashboard');
    }
}
