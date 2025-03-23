<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
            if (! Auth::check()) {
                return redirect('/login');
            }

            $user = Auth::user();
            if ($user->hasRole('Admin') || $user->name === 'HR Payroll') {
                return $next($request);
            }

            throw new HttpException(503);
        } else {
            return $next($request);
        }
    }
}
