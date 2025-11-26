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
Route::get('/', Home::class)->name('home');

// Rute-rute lain yang sudah ada
Route::prefix('auth')
    ->group(function () {
        Route::get('/login', Auth\Login::class)->name('login');
        Route::get('/register', Auth\Register::class)->name('register');
        Route::post('/logout', function () {
            \Illuminate\Support\Facades\Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/');
        })->name('logout');
    });

// Public Brands Page
Route::get('/brands', User\Brands::class)->name('brands');

// Public Categories Page
Route::get('/categories', User\Categories::class)->name('categories');

// Public Featured Products Page
Route::get('/featured', User\FeaturedProducts::class)->name('featured');

// Product Detail Page
Route::get('/product/{slug}', User\ProductDetail::class)->name('product.detail');

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
    Route::get('/user/profile', User\Profile::class)->name('user.profile');
    Route::get('/user/addresses', User\Addresses::class)->name('user.addresses');
    Route::get('/user/cart', User\CartPage::class)->name('user.cart');
    Route::get('/user/order', User\OrderPage::class)->name('user.order');
    Route::get('/user/my-orders', User\MyOrders::class)->name('user.my-orders');
    Route::get('/user/payment/{orderId}', User\PaymentPage::class)->name('user.payment');
    Route::get('/user/midtrans-payment/{orderId}', User\MidtransPayment::class)->name('user.midtrans-payment');
});

// Midtrans callback (no middleware, will be called by Midtrans server)
Route::post('/midtrans/callback', [App\Http\Controllers\MidtransController::class, 'callback'])->name('midtrans.callback');

// Midtrans check status (for development, when webhook doesn't work)
Route::get('/midtrans/check-status/{orderId}', [App\Http\Controllers\MidtransController::class, 'checkStatus'])
    ->middleware(['role:user'])
    ->name('midtrans.check-status');

