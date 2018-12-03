<?php

namespace Tests\Feature\Http\Dashboard\LostAndFound;

use App\Models\Wallet;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ClaimTest extends TestCase
{
    /** @test */
    public function voters_can_claim_unclaimed_wallets()
    {
        $wallet = factory(Wallet::class)->create([
            'verification_token' => null,
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($this->createVoter())
            ->get("/dashboard/lost-and-found/{$wallet->address}")
            ->assertRedirect("/dashboard/wallets/{$wallet->address}");

        $this->assertNotNull($wallet->fresh()->claimed_at);
        $this->assertNotNull($wallet->fresh()->verification_token);
    }

    /** @test */
    public function voters_cannot_claim_pending_wallets()
    {
        $wallet = factory(Wallet::class)->create([
            'user_id'            => 2,
            'claimed_at'         => Carbon::now(),
            'verification_token' => str_random(123),
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($this->createVoter())
            ->from('dashboard/lost-and-found')
            ->get("/dashboard/lost-and-found/{$wallet->address}")
            ->assertRedirect('/dashboard/lost-and-found');

        $this->assertNotNull($wallet->fresh()->claimed_at);
        $this->assertNotNull($wallet->fresh()->verification_token);
    }

    /** @test */
    public function voters_cannot_claim_claimed_wallets()
    {
        $wallet = factory(Wallet::class)->create([
            'user_id'            => 2,
            'claimed_at'         => Carbon::now(),
            'verification_token' => null,
            'verified_at'        => Carbon::now(),
        ]);

        $this
            ->actingAs($this->createVoter())
            ->from('dashboard/lost-and-found')
            ->get("/dashboard/lost-and-found/{$wallet->address}")
            ->assertRedirect('/dashboard/lost-and-found');

        $this->assertNull($wallet->fresh()->verification_token);
    }
}
