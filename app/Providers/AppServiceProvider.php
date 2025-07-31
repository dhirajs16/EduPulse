<?php

namespace App\Providers;

use App\Repositories\Implementations\FeeRepository;
use App\Repositories\Implementations\FeeTypeRepository;
use App\Repositories\Implementations\StudentRepository;
use App\Repositories\Implementations\SubjectRepository;
use App\Repositories\Implementations\SystemSettingRepository;
use App\Repositories\Implementations\TeacherRepository;
use App\Repositories\Implementations\TransactionRepository;
use App\Repositories\Interfaces\FeeRepositoryInterface;
use App\Repositories\Interfaces\FeeTypeRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\SubjectRepositoryInterface;
use App\Repositories\Interfaces\SystemSettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the SystemSettingRepositoryInterface to SystemSettingRepository binding
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(FeeTypeRepositoryInterface::class, FeeTypeRepository::class);
        $this->app->bind(FeeRepositoryInterface::class, FeeRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);

        // You can add more bindings here as needed
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super admin') ? true : null;
        });
    }
}
