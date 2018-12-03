<?php

namespace Tests\Feature\Http\Front\Disbursements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ShowTest extends TestCase
{
    /** @test */
    public function guests_can_view_the_disbursement()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->get("/disbursements/{$disbursement->transaction_id}")
            ->assertSuccessful();
    }
}
