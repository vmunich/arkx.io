<?php

namespace App\Console\Commands\Polling;

use App\Models\User;
use App\Models\Wallet;
use App\Services\Ark\Database;
use Illuminate\Console\Command;

class Voters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:voters';

    /**
     * Execute the console command.
     */
    public function handle(Database $database): void
    {
        foreach ($database->voters() as $wallet) {
            $this->line('Polling Wallet: <info>'.$wallet->address.'</info>');

            try {
                Wallet::findByAddress($wallet->address)->update($wallet->toArray());
            } catch (\Exception $e) {
                User::first()->wallets()->create($wallet->toArray());
            }
        }
    }
}
