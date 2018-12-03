<?php

namespace App\Console\Commands\Settings;

use App\Models\Wallet;
use Illuminate\Console\Command;

class Wallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:settings:wallets {--frequency=} {--percentage=}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Wallet::get()->each(function ($wallet) {
            if ($this->option('frequency')) {
                $wallet->extra_attributes->set('settings.share.frequency', $this->option('frequency'));
            }

            if ($this->option('percentage')) {
                $wallet->extra_attributes->set('settings.share.percentage', $this->option('percentage'));
            }

            $wallet->save();
        });
    }
}
