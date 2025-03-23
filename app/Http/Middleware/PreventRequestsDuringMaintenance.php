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
    protected $except = ['/', 'login', 'logout'];

    public function __construct()
    {
        $this->except = array_merge(
            $this->except,
            collect(Route::getRoutes()->getRoutesByMethod()['GET'] ?? [])
                ->map(fn ($route) => $route->uri())
                ->toArray()
        );
    }
}
