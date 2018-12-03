<?php

namespace Tests\Feature\Http\Dashboard\Disbursements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class SearchTest extends TestCase
{
    /** @test */
    public function administrators_cannot_search_disbursements()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->actingAs($this->createAdministrator())
            ->post('/dashboard/disbursements/search', ['search' => $disbursement->transaction_id])
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_search_disbursements()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->actingAs($disbursement->user)
            ->post('/dashboard/disbursements/search', ['search' => $disbursement->transaction_id])
            ->assertSuccessful()
            ->assertSee($disbursement->transaction_id);
    }

    /** @test */
    public function guests_cannot_search_disbursements()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->post('/dashboard/disbursements/search', ['search' => $disbursement->transaction_id])
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
