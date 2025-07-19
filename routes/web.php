<?php

use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;


// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// auth and verified routes
Route::middleware(['auth', 'verified'])
->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
});


require __DIR__.'/auth.php';
