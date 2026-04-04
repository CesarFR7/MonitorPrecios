<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');

Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');
