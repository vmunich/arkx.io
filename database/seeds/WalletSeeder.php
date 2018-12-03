<?php

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::all()->each(function ($user) {
            for ($i = 0; $i < 20; $i++) {
                $user->wallets()->save(factory(Wallet::class)->make());
            }
        });
    }
}
