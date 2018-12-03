<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Laravel\Horizon\Horizon;

class HorizonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Horizon::routeMailNotificationsTo(config('mail.support'));

        Horizon::auth(function (Request $request) {
            if (app()->environment('local')) {
                return true;
            }

            if (auth()->guest()) {
                return false;
            }

            return $request->user()->hasRole('admin');
        });
    }
}
