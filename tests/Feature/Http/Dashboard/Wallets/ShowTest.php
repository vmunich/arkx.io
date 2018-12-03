<?php

namespace Tests\Feature\Http\Dashboard\Wallets;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ShowTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_wallet()
    {
        $wallet = $this->createWallet();

        $this
            ->actingAs($this->createAdministrator())
            ->get("/dashboard/wallets/{$wallet->address}")
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_the_wallet()
    {
        $wallet = $this->createWallet();

        $this
            ->actingAs($wallet->user)
            ->get("/dashboard/wallets/{$wallet->address}")
            ->assertSuccessful();
    }

    /** @test */
    public function other_voters_cannot_view_the_wallet()
    {
        $wallet = $this->createWallet();

        $this
            ->actingAs($this->createVoter())
            ->get("/dashboard/wallets/{$wallet->address}")
            ->assertStatus(403);
    }

    /** @test */
    public function guests_cannot_view_the_wallet()
    {
        $wallet = $this->createWallet();

        $this
            ->get("/dashboard/wallets/{$wallet->address}")
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
