<?php

namespace App\Livewire\Features\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    #[Layout('components.layouts.admin')]
    public $name, $slug, $description, $price, $product_id, $category_id, $brand_id;
    public $images = [];
    public $newImage1, $newImage2, $newImage3;
    public bool $is_active = true, $is_featured = false, $in_stock = true;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public $isOpen = 0;
    public $viewingImages = [];
    public bool $showImageModal = false;
    public $viewingStatusProduct = null;
    public bool $showStatusModal = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'newImage1' => 'nullable|image|max:2048',
            'newImage2' => 'nullable|image|max:2048',
            'newImage3' => 'nullable|image|max:2048',
            'is_active' => 'required|boolean',
            'is_featured' => 'required|boolean',
            'in_stock' => 'required|boolean',
        ];
    }

    public function render()
    {
        $products = Product::with(['category', 'brand'])
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhereHas('category', function ($categoryQuery) {
                          $categoryQuery->where('name', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('brand', function ($brandQuery) {
                          $brandQuery->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->latest()
            ->paginate(7);

        $categories = Category::where('is_active', true)->get();
        $brands = Brand::where('is_active', true)->get();

        return view('livewire.features.admin.products.index', [
            'products' => $products,
            'categories' => $categories,
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
        $this->reset(['name', 'slug', 'description', 'price', 'product_id', 'category_id', 'brand_id', 'images', 'newImage1', 'newImage2', 'newImage3']);
        $this->is_active = true;
        $this->is_featured = false;
        $this->in_stock = true;
    }

    public function store()
    {
        $this->validate();

        $imagePaths = $this->images;

        if ($this->newImage1) {
            if (isset($imagePaths[0])) {
                Storage::disk('public')->delete($imagePaths[0]);
            }
            $imagePaths[0] = $this->newImage1->store('products', 'public');
        }
        if ($this->newImage2) {
            if (isset($imagePaths[1])) {
                Storage::disk('public')->delete($imagePaths[1]);
            }
            $imagePaths[1] = $this->newImage2->store('products', 'public');
        }
        if ($this->newImage3) {
            if (isset($imagePaths[2])) {
                Storage::disk('public')->delete($imagePaths[2]);
            }
            $imagePaths[2] = $this->newImage3->store('products', 'public');
        }

        Product::updateOrCreate(['id' => $this->product_id], [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'description' => $this->description,
            'price' => $this->price,
            'images' => array_values(array_filter($imagePaths)),
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'in_stock' => $this->in_stock,
        ]);

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->images = $product->images;
        $this->is_active = (bool) $product->is_active;
        $this->is_featured = (bool) $product->is_featured;
        $this->in_stock = (bool) $product->in_stock;

        $this->openModal();
    }

    public function delete($id)
    {
        Product::find($id)->delete();
    }

    public function viewImages($id)
    {
        $product = Product::findOrFail($id);
        $this->viewingImages = $product->images;
        $this->showImageModal = true;
    }

    public function closeImageModal()
    {
        $this->showImageModal = false;
        $this->viewingImages = [];
    }

    public function viewStatus($id)
    {
        $this->viewingStatusProduct = Product::findOrFail($id);
        $this->showStatusModal = true;
    }

    public function closeStatusModal()
    {
        $this->showStatusModal = false;
        $this->viewingStatusProduct = null;
    }
}
