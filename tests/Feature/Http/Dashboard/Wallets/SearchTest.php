<?php

namespace Tests\Feature\Http\Dashboard\Wallets;

use Tests\TestCase;

/**
 * @coversNothing
 */
class SearchTest extends TestCase
{
    /** @test */
    public function administrators_cannot_search_wallets()
    {
        $wallet = $this->createWallet();

        $this
            ->actingAs($this->createAdministrator())
            ->post('/dashboard/wallets/search', ['search' => $wallet->address])
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_search_wallets()
    {
        $wallet = $this->createWallet();

        $this->withoutExceptionHandling();

        $this
            ->actingAs($wallet->user)
            ->post('/dashboard/wallets/search', ['search' => $wallet->address])
            ->assertSuccessful()
            ->assertSee($wallet->address);
    }

    /** @test */
    public function guests_cannot_search_wallets()
    {
        $wallet = $this->createWallet();

        $this
            ->post('/dashboard/wallets/search', ['search' => $wallet->address])
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
