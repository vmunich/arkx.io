<?php

namespace Tests\Feature\Http\Dashboard\LostAndFound;

use App\Models\Wallet;
use Tests\TestCase;

/**
 * @coversNothing
 */
class SearchTest extends TestCase
{
    /** @test */
    public function administrators_cannot_search_disbursements()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->post('/dashboard/lost-and-found/search', ['search' => 'fake-address'])
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_search_disbursements()
    {
        $wallets = factory(Wallet::class)->create(['verified_at' => null]);

        $this
            ->actingAs($this->createVoter())
            ->post('/dashboard/lost-and-found/search', ['search' => $wallets->first()->address])
            ->assertSuccessful()
            ->assertSee($wallets->first()->address);
    }

    /** @test */
    public function guests_cannot_search_disbursements()
    {
        $this
            ->post('/dashboard/lost-and-found/search', ['search' => 'fake-address'])
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
