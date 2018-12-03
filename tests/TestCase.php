<?php

namespace Tests;

use App\Models\Disbursement;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use Concerns\CreatesUsers;

    public function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed', ['--class' => \RolesAndPermissionsSeeder::class]);
    }

    public function createIdentity(User $user)
    {
        factory(Wallet::class)->create([
            'user_id' => $user->id,
        ])->each(function ($wallet) {
            $wallet->disbursements()->save(factory(Disbursement::class)->make());
        });
    }
}
