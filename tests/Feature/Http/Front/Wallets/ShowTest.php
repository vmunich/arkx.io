<?php

namespace Tests\Feature\Http\Front\Wallets;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ShowTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_wallet()
    {
        $wallet = $this->createAnnouncement();

        $this
            ->get("/wallets/{$wallet->address}")
            ->assertSuccessful();
    }
}
