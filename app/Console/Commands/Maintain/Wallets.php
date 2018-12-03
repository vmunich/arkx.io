<?php

namespace App\Console\Commands\Maintain;

use App\Models\Wallet;
use Illuminate\Console\Command;

class Wallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:maintain:wallets';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Wallet::pending()->each(function ($wallet) {
            if ($wallet->claimHasExpired()) {
                $wallet->reset();
            }
        });
    }
}
