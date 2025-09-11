<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(\App\Repositories\Contracts\UserRepositoryContract::class, \App\Repositories\Eloquent\UserRepository::class);
        app()->bind(\App\Repositories\Contracts\ChatRepositoryContract::class, \App\Repositories\Eloquent\ChatRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
