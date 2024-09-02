<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;

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
        /* preventLazyLoading
         * preventAccessingMissingAttributes
         * preventSilentlyDiscardingAttributes
         * you can enable all of them at once by using the 'Model::shouldBeStrict()'
         */
        // Model::preventAccessingMissingAttributes();
        // Model::preventSilentlyDiscardingAttributes();

        Lang::handleMissingKeysUsing(function (string $key, array $replacements, string $locale) {
            info("Missing translation key [$key] detected.");

            return $key;
        });

        Carbon::setWeekStartsAt(Carbon::SUNDAY);

        Carbon::setWeekendDays([Carbon::FRIDAY, Carbon::SATURDAY]);
    }
}
