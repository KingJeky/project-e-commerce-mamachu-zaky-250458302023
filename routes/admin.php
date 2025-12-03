<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Features\Admin;

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', Admin\Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/categories', Admin\Categories\Index::class)->name('admin.categories');
    Route::get('/admin/brands', Admin\Brands\Index::class)->name('admin.brands');
    Route::get('/admin/products', Admin\Products\Index::class)->name('admin.products');
    Route::get('/admin/users', Admin\Users\Index::class)->name('admin.users');
    Route::get('/admin/orders', Admin\Orders\Index::class)->name('admin.orders');
});