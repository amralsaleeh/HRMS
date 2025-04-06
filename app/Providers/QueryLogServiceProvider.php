<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class QueryLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (app()->environment('local')) {
            DB::enableQueryLog();

            DB::whenQueryingForLongerThan(1000, function ($connection) {
                Log::warning(
                    'Long running queries detected.', [
                        'queries' => $connection->getQueryLog(),
                        'url' => request()->fullUrl(),
                    ]);
            });
        }
    }
}
