<?php

namespace App\Livewire\Features\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;

    #[Layout('components.layouts.admin')]
    public $name, $slug, $image, $category_id;
    public bool $is_active = true;
    public $newImage;
    public $search = '';
    public $isOpen = 0;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'newImage' => 'nullable|image|max:2048', 
        'is_active' => 'required|boolean',
    ];

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(3);


        return view('livewire.features.admin.categories.index', [
            'categories' => $categories,
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
        $this->reset(['name', 'slug', 'image', 'is_active', 'category_id', 'newImage']);
        $this->is_active = true;
    }

    public function store()
    {
        $this->validate();

        $imagePath = $this->image;
        if ($this->newImage) {
            $imagePath = $this->newImage->store('categories', 'public');
        }

        Category::updateOrCreate(['id' => $this->category_id], [
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
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->image = $category->image;
        $this->is_active = (bool) $category->is_active;

        $this->openModal();
    }

    public function delete($id)
    {
        Category::find($id)->delete();
    }
}
