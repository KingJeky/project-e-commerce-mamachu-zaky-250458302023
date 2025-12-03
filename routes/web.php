<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\Features\User\Home;

Route::get('/', Home::class)->name('home');

// buat login register logout bang!
require __DIR__ . '/auth.php';

require __DIR__ . '/global.php';

// Buat admin bang!
require __DIR__ . '/admin.php';

// Buat user bang!
require __DIR__ . '/user.php';

// Midtrans
require __DIR__ . '/midtrans.php';


