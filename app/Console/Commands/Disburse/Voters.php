<?php

namespace App\Console\Commands\Disburse;

use App\Jobs\CreateDisbursement;
use App\Models\Wallet;
use Illuminate\Console\Command;

class Voters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:disburse:voters {--frequency=}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $wallets = Wallet::eligible();

        if ($this->option('frequency')) {
            $wallets = $wallets->frequency($this->option('frequency'));
        }

        $wallets->get()->each(function ($wallet) {
            if ($wallet->shouldBePaid()) {
                $this->line("Disbursing Wallet: <info>{$wallet->address}</info>");

                CreateDisbursement::dispatch($wallet);
            }
        });
    }
}
