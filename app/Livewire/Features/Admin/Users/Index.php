<?php

namespace App\Livewire\Features\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Layout('components.layouts.admin')]
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public $isOpen = 0;
    public $user_id, $name, $email, $password, $role;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required|in:admin,user',
        ];

        if (!$this->user_id) {
            $rules['password'] = 'required|string|min:8';
        } else {
            $rules['password'] = 'nullable|string|min:8';
        }

        return $rules;
    }

    public function render()
    {
        $users = User::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(7);

        return view('livewire.features.admin.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->reset(['user_id', 'name', 'email', 'password', 'role']);
    }

    public function store()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->user_id], $data);

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;

        $this->openModal();
    }

    public function delete($id)
    {
        if ($id == Auth::id()) {
            $this->dispatch('swal:error', [
                'title' => 'Gagal!',
                'text' => 'Anda tidak dapat menghapus akun Anda sendiri.',
            ]);
            return;
        }

        User::find($id)->delete();
        $this->dispatch('swal:success', [
            'title' => 'Pengguna Dihapus!',
            'text' => 'Pengguna berhasil dihapus.',
        ]);
    }
}
