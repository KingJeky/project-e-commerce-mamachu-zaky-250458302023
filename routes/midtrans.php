
<?php

use Illuminate\Support\Facades\Route;


Route::post('/midtrans/callback', [App\Http\Controllers\MidtransController::class, 'callback'])->name('midtrans.callback');

// Midtrans check status (for development, when webhook doesn't work)
Route::get('/midtrans/check-status/{orderId}', [App\Http\Controllers\MidtransController::class, 'checkStatus'])
    ->middleware(['role:user'])
    ->name('midtrans.check-status');