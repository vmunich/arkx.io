<?php

namespace Tests\Feature\Http\Front\Disbursements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ListTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_disbursement_list()
    {
        $this
            ->get('/disbursements')
            ->assertSuccessful();
    }
}
