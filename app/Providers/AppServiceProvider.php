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
        Gate::before(function (User $user, string $ability) {
            if ($user->role->name === 'admin') {
                return true;
            }
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
        Gate::define('visitador', function (User $user) {
            return $user->role->name === 'visitador';
        });
        Gate::define('jefe-operaciones', function (User $user) {
             if($user->role->name === 'jefe-operaciones'){
                 return true;

             }
        });
        Gate::define('gerencia-general', function (User $user) {
            return $user->role->name === 'gerencia-general';
        });
        Gate::define('coordinador-lineas', function (User $user) {
            return $user->role->name === 'coordinador-lineas';
        });
        Gate::define('jefe-comercial', function (User $user) {
            return $user->role->name === 'jefe-comercial';
        });
        Paginator::useBootstrapFive();
    }
}
