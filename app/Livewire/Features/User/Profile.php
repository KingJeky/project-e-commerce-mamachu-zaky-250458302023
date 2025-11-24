<?php

namespace App\Livewire\Features\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

#[Layout('components.layouts.app')]
class Profile extends Component
{
    public $name;
    public $email;
    public $editMode = false;

    // Store original values for cancel
    public $originalName;
    public $originalEmail;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->originalName = $user->name;
        $this->originalEmail = $user->email;
    }

    public function toggleEdit()
    {
        $this->editMode = !$this->editMode;
        
        if ($this->editMode) {
            // Reset to current values when entering edit mode
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
        }
    }

    public function cancelEdit()
    {
        $this->editMode = false;
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->resetValidation();
    }

    public function updateProfile()
    {
        $user = Auth::user();
        
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->editMode = false;
        $this->originalName = $this->name;
        $this->originalEmail = $this->email;

        session()->flash('success', 'Profile berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.features.user.profile');
    }
}
