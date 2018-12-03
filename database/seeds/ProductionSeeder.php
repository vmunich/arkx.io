<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        User::create([
            'email'     => 'trusty@arkx.io',
            'password'  => Hash::make(str_random(64)),
            'api_token' => bin2hex(openssl_random_pseudo_bytes(32)),
        ])->assignRole('admin');
    }
}
