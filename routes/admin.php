<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SystemSettingController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeTypeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

Route::middleware('auth:admin')
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        // admin profile routes
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

        // admin access management routes
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('roles/update/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('roles/delete/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');


        // admin role-user management routes
        Route::resource('role-users', RoleUserController::class);

        // admin settings routes
        Route::resource('settings', SettingController::class);

        // Student management routes
        Route::resource('students', StudentController::class);

        // Fee Type management routes
        Route::resource('fee-types', FeeTypeController::class);

        // Fee management routes
        Route::resource('fees', FeeController::class);

        // Transaction management routes
        Route::resource('transactions', TransactionController::class);

        // Subject management routes
        Route::resource('subjects', SubjectController::class);

        // Teacher management routes
        Route::resource('teachers', TeacherController::class);

        // Teacher management routes
        Route::resource('time-tables', TimeTableController::class);
    });
