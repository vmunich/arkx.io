<?php

use App\Models\Wallet;
use App\Notifications\DisbursementSent;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Wallet::all()->each(function ($wallet) {
            for ($i = 0; $i < 20; $i++) {
                $wallet->user->notify(new DisbursementSent($wallet->user->disbursements()->first()));
            }
        });
    }
}
