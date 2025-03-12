<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$checkRoles): Response
    {
        // dd($checkRoles);
        if (Auth::check()) {
        $name_role = (request()->user()->role->name);
        foreach ($checkRoles as $role) {
            if ($name_role == $role) {
                return $next($request);
            }
        }
        return redirect('/')->with('error', 'Acceso denegado');
        }
        return redirect('login');
    }
}
