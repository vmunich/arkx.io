<?php

namespace Tests\Feature\Http\Front\Disbursements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class SearchTest extends TestCase
{
    /** @test */
    public function can_search_disbursements()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->post('/disbursements/search', ['search' => $disbursement->transaction_id])
            ->assertSuccessful()
            ->assertSee($disbursement->transaction_id);
    }
}
