<?php

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Wallet::class, function (Faker $faker) {
    return [
        'user_id'            => function () {
            $user = factory(User::class)->create();
            $user->assignRole('voter');

            return $user->id;
        },
        'address'            => str_random(34),
        'public_key'         => str_random(66),
        'balance'            => $faker->randomNumber(9),
        'earnings'           => $faker->randomNumber(9),
        'verification_token' => $faker->uuid,
        'verified_at'        => $faker->boolean ? Carbon::now() : null,
    ];
});
