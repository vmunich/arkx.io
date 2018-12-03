<?php

namespace Tests\Feature\Http\Dashboard\Wallets;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ExportTest extends TestCase
{
    /** @test */
    public function administrators_cannot_export_the_wallets()
    {
        $wallet = $this->createWallet();

        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/wallets/export')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_export_the_wallets()
    {
        $wallet = $this->createWallet();

        $this
            ->actingAs($wallet->user)
            ->get('/dashboard/wallets/export')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_export_the_wallets()
    {
        $wallet = $this->createWallet();

        $this
            ->get('/dashboard/wallets/export')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
