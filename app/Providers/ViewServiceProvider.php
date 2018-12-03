<?php

namespace App\Providers;

use App\Http\ViewComposers\App\OverviewComposer as AppOverviewComposer;
use App\Http\ViewComposers\Dashboard\OverviewComposer as DashboardOverviewComposer;
use App\Http\ViewComposers\Shared\EncryptedCsrfTokenComposer;
use App\Http\ViewComposers\Shared\GlobalViewComposer;
use App\Http\ViewComposers\Wallet\OverviewComposer as WalletOverviewComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', GlobalViewComposer::class);
        View::composer('*.layouts.*', EncryptedCsrfTokenComposer::class);

        View::composer('layouts.sidebars.dashboard', DashboardOverviewComposer::class);
        View::composer('layouts.sidebars.app', AppOverviewComposer::class);
        View::composer('layouts.sidebars.wallet', WalletOverviewComposer::class);
    }
}
