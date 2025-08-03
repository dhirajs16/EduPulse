<?php

use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\TimeTableController;
use Illuminate\Support\Facades\Route;


// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// auth and verified routes
Route::middleware(['auth', 'verified'])
->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/personal-info', [ProfileController::class, 'personalInfo'])->name('profile.personal_info');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // timetable routes
    Route::get('time-tables/{grade}', [TimeTableController::class, 'show'])->name('time-tables.show');
});


require __DIR__.'/auth.php';
