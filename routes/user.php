<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Features\User;

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