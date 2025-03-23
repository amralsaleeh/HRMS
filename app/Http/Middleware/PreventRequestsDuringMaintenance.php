<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;
use Illuminate\Support\Facades\Route;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int, string>
     */
    protected $except = ['/', 'login', 'logout', '/lang/ar', '/lang/en'];

    public function handle($request, \Closure $next)
    {
        $routes = collect(Route::getRoutes()->getRoutes())
            ->map(function ($route) {
                return '/'.ltrim($route->uri(), '/'); // للتأكد من وجود / في البداية
            })
            ->unique()
            ->toArray();
        // dd($routes);
        $this->except = array_merge($this->except, $routes);

        return parent::handle($request, $next);
    }
}
