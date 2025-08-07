<?php

use App\Http\Controllers\Frontend\AssignmentController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\TimeTableController;
use App\Http\Controllers\Frontend\TransactionController;
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

    Route::middleware(['isTeacher'])
    ->group(function () {
            // assignment routes
            Route::get('assignments/{teacher}', [AssignmentController::class, 'index'])->name('assignments.index');
            Route::get('assignments/{teacher}/create', [AssignmentController::class, 'create'])->name('assignments.create');
            Route::post('assignments', [AssignmentController::class, 'store'])->name('assignments.store');
            Route::get('assignments/{id}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');
            Route::put('assignments/{id}', [AssignmentController::class, 'update'])->name('assignments.update');
            Route::delete('assignments/{id}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');
        });
        Route::get('assignments/students/{grade}', [AssignmentController::class, 'show'])->name('assignments.show');

    // timetable routes
    Route::get('time-tables/{grade}', [TimeTableController::class, 'show'])->name('time-tables.show');
    // transaction routes
    Route::get('transactions/{student}', [TransactionController::class, 'show'])->name('transactions.show');
});


require __DIR__.'/auth.php';
