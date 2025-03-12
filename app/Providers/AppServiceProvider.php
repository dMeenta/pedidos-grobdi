<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        Gate::define('usuarios', function (User $user) {
            return $user->role->name === 'admin';
        });
        Gate::define('motorizados', function (User $user) {
            return $user->role->name === 'motorizado';
        });
        Gate::define('contabilidad', function (User $user) {
            return $user->role->name === 'contabilidad';
        });
        Gate::define('laboratorio', function (User $user) {
            return $user->role->name === 'laboratorio';
        });
        Gate::define('counter', function (User $user) {
            return $user->role->name === 'counter';
        });
        Paginator::useBootstrapFive();
    }
}
