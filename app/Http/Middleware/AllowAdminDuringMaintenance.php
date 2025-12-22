<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AllowAdminDuringMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->isDownForMaintenance()) {
            if (in_array($request->path(), ['login', 'maintenance-mode', 'contact-us'])) {
                return $next($request);
            }

            if (! Auth::check()) {
                return redirect('/login');
            }

            $user = Auth::user();
            $route = $request->route();
            $routeName = $route ? $route->getName() : null;

            if ($user->hasRole('Admin') || $user->name === 'HR Payroll') {
                return $next($request);
            }

            if ($routeName === 'messages-bulk' && $user->hasAnyRole(['Admin', 'CC'])) {
                return $next($request);
            }

            return redirect('/maintenance-mode');
        }

        return $next($request);
    }
}
