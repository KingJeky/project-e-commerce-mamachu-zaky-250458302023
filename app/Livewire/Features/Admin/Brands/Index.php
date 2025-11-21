<?php

namespace App\Livewire\Features\Admin\Brands;

use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    #[Layout('components.layouts.admin')]
    public $name, $slug, $image, $brand_id;
    public bool $is_active = true;
    public $newImage;
    public $search = '';
    public $isOpen = 0;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'newImage' => 'nullable|image|max:2048', // 2MB Max
        'is_active' => 'required|boolean',
    ];

    public function render()
    {
        $brands = Brand::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(3);

        return view('livewire.features.admin.brands.index', [
            'brands' => $brands,
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
        $this->reset(['name', 'slug', 'image', 'is_active', 'brand_id', 'newImage']);
        $this->is_active = true;
    }

    public function store()
    {
        $this->validate();

        $imagePath = $this->image;
        if ($this->newImage) {
            $imagePath = $this->newImage->store('brands', 'public');
        }

        Brand::updateOrCreate(['id' => $this->brand_id], [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'image' => $imagePath,
            'is_active' => $this->is_active,
        ]);

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $this->brand_id = $id;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->image = $brand->image;
        $this->is_active = (bool) $brand->is_active;

        $this->openModal();
    }

    public function delete($id)
    {
        Brand::find($id)->delete();
    }
}
