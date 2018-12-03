<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(User::class)
            ->create(['email' => 'trusty@arkx.io'])
            ->assignRole('admin');

        factory(User::class)
            ->create(['email' => 'admin@arkx.io'])
            ->assignRole('admin');
    }
}
