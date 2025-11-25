<?php

namespace App\Livewire\Features\User;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class Main extends Component
{
    use WithPagination;

    public string $search = '';

    public array $selectedCategories = [];

    public array $selectedBrands = [];

    public $maxPrice;

    public $initialMaxPrice;

    public string $sortBy = 'default';

    public function mount()
    {
        $this->initialMaxPrice = Product::max('price') ?? 100000;
        $this->maxPrice = $this->initialMaxPrice;
    }

    public function updating($key)
    {
        if (in_array($key, ['search', 'selectedCategories', 'selectedBrands', 'maxPrice', 'sortBy'])) {
            $this->resetPage();
        }
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->selectedCategories = [];
        $this->selectedBrands = [];
        $this->maxPrice = $this->initialMaxPrice;
        $this->sortBy = 'default';
        $this->resetPage();
    }

    public function addToCart($productId)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $product = Product::find($productId);
        if (!$product || !$product->is_active) {
            $this->dispatch('swal:error', [
                'title' => 'Gagal!',
                'text' => 'Produk tidak ditemukan atau tidak tersedia'
            ]);
            return;
        }

        // Get or create user's cart
        $cart = \App\Models\Cart::firstOrCreate(
            ['user_id' => auth()->id()]
        );

        // Check if product already in cart
        $cartItem = \App\Models\CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Update quantity if item already exists
            $cartItem->increment('quantity', 1);
        } else {
            // Create new cart item
            \App\Models\CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => $product->name . ' ditambahkan ke keranjang'
        ]);

        // Dispatch event to update cart counter
        $this->dispatch('cartUpdated')->to('components.cart-counter');
    }

    public function render()
    {
        $productsQuery = Product::with(['category', 'brand'])->where('is_active', true);

        if ($this->search) {
            $productsQuery->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->selectedCategories) {
            $productsQuery->whereIn('category_id', $this->selectedCategories);
        }

        if ($this->selectedBrands) {
            $productsQuery->whereIn('brand_id', $this->selectedBrands);
        }

        if ($this->maxPrice) {
            $productsQuery->where('price', '<=', $this->maxPrice);
        }

        switch ($this->sortBy) {
            case 'low':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'high':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'az':
                $productsQuery->orderBy('name', 'asc');
                break;
            default:
                $productsQuery->latest();
                break;
        }

        $products = $productsQuery->paginate(9);
        $brands = Brand::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();

        return view('livewire.features.user.main', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
        ]);
    }
}
