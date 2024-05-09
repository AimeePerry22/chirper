<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
Route::view('/', 'welcome');

Route::middleware(['role:admin'])->get('users', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('users');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
