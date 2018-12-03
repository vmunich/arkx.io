<?php

namespace App\Providers;

use App\Models\Disbursement;
use App\Models\Wallet;
use App\Policies\DisbursementPolicy;
use App\Policies\WalletPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Disbursement::class => DisbursementPolicy::class,
        Wallet::class       => WalletPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
