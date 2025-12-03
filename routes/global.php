<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Features\User;


// Public Brands Page
Route::get('/brands', User\Brands::class)->name('brands');

// Public Categories Page
Route::get('/categories', User\Categories::class)->name('categories');

// Public Featured Products Page
Route::get('/featured', User\FeaturedProducts::class)->name('featured');

// Product Detail Page
Route::get('/product/{slug}', User\ProductDetail::class)->name('product.detail');