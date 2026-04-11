<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');

Route::get('/auth/google/redirect', [AuthController::class, 'google_redirect'])->name('auth.google_redirect');
Route::get('/auth/google/callback', [AuthController::class, 'google_callback'])->name('auth.google_callback');

Route::get('/auth/x/redirect', [AuthController::class, 'x_redirect'])->name('auth.x_redirect');
Route::get('/auth/x/callback', [AuthController::class, 'x_callback'])->name('auth.x_callback');

Route::get('/auth/linkedin/redirect', [AuthController::class, 'linkedin_redirect'])->name('auth.linkedin_redirect');
Route::get('/auth/linkedin/callback', [AuthController::class, 'linkedin_callback'])->name('auth.linkedin_callback');

Route::get('/auth/github/redirect', [AuthController::class, 'github_redirect'])->name('auth.github_redirect');
Route::get('/auth/github/callback', [AuthController::class, 'github_callback'])->name('auth.github_callback');
