<?php

namespace App\Livewire\Features\User;

use App\Models\Address;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class Addresses extends Component
{
    public $addresses;
    public $addressId;
    
    // Form fields
    public $label = 'Rumah';
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $is_default = false;
    
    public $showForm = false;
    public $editMode = false;

    public function mount()
    {
        $this->loadAddresses();
    }

    public function loadAddresses()
    {
        $this->addresses = Auth::user()->addresses()->latest()->get();
    }

    public function showCreateForm()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showForm = true;
    }

    public function showEditForm($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        
        $this->addressId = $address->id;
        $this->label = $address->label;
        $this->first_name = $address->first_name;
        $this->last_name = $address->last_name;
        $this->phone = $address->phone;
        $this->street_address = $address->street_address;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->zip_code = $address->zip_code;
        $this->is_default = $address->is_default;
        
        $this->editMode = true;
        $this->showForm = true;
    }

    public function saveAddress()
    {
        $validated = $this->validate([
            'label' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'required|string|min:10|max:50',
            'street_address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'required|string|max:50',
            'is_default' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();

        if ($this->editMode) {
            $address = Address::where('user_id', Auth::id())->findOrFail($this->addressId);
            $address->update($validated);
            session()->flash('success', 'Alamat berhasil diperbarui!');
        } else {
            Address::create($validated);
            session()->flash('success', 'Alamat baru berhasil ditambahkan!');
        }

        $this->loadAddresses();
        $this->cancelForm();
    }

    public function deleteAddress($id)
    {
        Address::where('user_id', Auth::id())->findOrFail($id)->delete();
        
        $this->loadAddresses();
        session()->flash('success', 'Alamat berhasil dihapus!');
    }

    public function setDefaultAddress($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->update(['is_default' => true]);
        
        $this->loadAddresses();
        session()->flash('success', 'Alamat default berhasil diubah!');
    }

    public function cancelForm()
    {
        $this->showForm = false;
        $this->resetForm();
        $this->resetValidation();
    }

    private function resetForm()
    {
        $this->addressId = null;
        $this->label = 'Rumah';
        $this->first_name = '';
        $this->last_name = '';
        $this->phone = '';
        $this->street_address = '';
        $this->city = '';
        $this->state = '';
        $this->zip_code = '';
        $this->is_default = false;
    }

    public function render()
    {
        return view('livewire.features.user.addresses');
    }
}
