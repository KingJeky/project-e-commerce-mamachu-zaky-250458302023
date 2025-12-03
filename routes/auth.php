<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth;

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