<?php

namespace App\Providers;

use App\Repositories\Implementations\SystemSettingRepository;
use App\Repositories\Interfaces\SystemSettingRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SystemSettingRepositoryInterface::class, SystemSettingRepository::class);
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
