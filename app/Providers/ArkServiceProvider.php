<?php

namespace App\Providers;

use ArkEcosystem\Crypto\Configuration\Network;
use ArkEcosystem\Crypto\Networks\Devnet;
use ArkEcosystem\Crypto\Networks\Mainnet;
use ArkEcosystem\Crypto\Networks\Testnet;
use Illuminate\Support\ServiceProvider;

class ArkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        if ($this->app->runningUnitTests()) {
            Network::set(Testnet::new());
        } elseif ($this->app->isLocal()) {
            Network::set(Devnet::new());
        } else {
            Network::set(Mainnet::new());
        }
    }
}
