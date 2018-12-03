<?php

namespace App\Providers;

use App\Repositories\DisbursementRepository;
use App\Repositories\WalletRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind('wallets', function ($app) {
            return new WalletRepository();
        });

        $this->app->bind('disbursements', function ($app) {
            return new DisbursementRepository();
        });
    }
}
