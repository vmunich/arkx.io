<?php

namespace App\Providers;

use DateInterval;
use DatePeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        Carbon::macro('range', function ($start, $end) {
            return new Collection(new DatePeriod($start, new DateInterval('P1D'), $end));
        });
    }
}
