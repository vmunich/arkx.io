<?php

namespace Tests\Feature\Http\Front\Wallets;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ListTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_wallet_list()
    {
        $this
            ->get('/wallets')
            ->assertSuccessful();
    }
}
