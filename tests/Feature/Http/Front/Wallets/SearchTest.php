<?php

namespace Tests\Feature\Http\Front\Wallets;

use App\Models\Wallet;
use Tests\TestCase;

/**
 * @coversNothing
 */
class SearchTest extends TestCase
{
    /** @test */
    public function administrators_can_search_wallets()
    {
        $this->withoutExceptionHandling();

        $wallet = factory(Wallet::class)->create();

        $this
            ->post('/wallets/search', ['search' => $wallet->address])
            ->assertSuccessful()
            ->assertSee($wallet->address);
    }
}
