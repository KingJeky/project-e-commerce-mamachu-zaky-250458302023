<?php

use App\Livewire\Features\Admin;
use App\Livewire\Features\User;
use App\Livewire\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Features\Admin\Categories;
use App\Livewire\Features\Admin\Brands;
use App\Livewire\Features\Admin\Products;
use App\Livewire\Features\User\Home;

// Homepage
// Hapus atau komentari rute lama yang mengarah ke view 'welcome'
// Route::get('/', function () {
//     return view('welcome');
// });

// Tambahkan rute baru yang menunjuk ke komponen Livewire 'Home'
Route::get('/', Home::class);

// Rute-rute lain yang sudah ada
Route::prefix('auth')
    ->group(function () {
        Route::get('/login', Auth\Login::class)->name('login');
        Route::get('/register', Auth\Register::class)->name('register');
    });

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', Admin\Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/categories', Categories\Index::class)->name('admin.categories');
    Route::get('/admin/brands', Brands\Index::class)->name('admin.brands');
    Route::get('/admin/products', Products\Index::class)->name('admin.products');
    Route::get('/admin/users', Admin\Users\Index::class)->name('admin.users');
    Route::get('/admin/orders', Admin\Orders\Index::class)->name('admin.orders');
});

Route::middleware(['role:user'])->group(function () {
    Route::get('/user/main', User\Main::class)->name('user.main');
});
