<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::directive('active', function ($expression) {
            return "<?php echo request()->routeIs($expression) ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : 'text-gray-600 hover:text-blue-600'; ?>";
        });
    }
}
