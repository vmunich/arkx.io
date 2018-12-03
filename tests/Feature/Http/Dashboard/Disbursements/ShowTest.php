<?php

namespace Tests\Feature\Http\Dashboard\Disbursements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ShowTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_disbursement()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->actingAs($this->createAdministrator())
            ->get("/dashboard/disbursements/{$disbursement->transaction_id}")
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_the_disbursement()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->actingAs($disbursement->user)
            ->get("/dashboard/disbursements/{$disbursement->transaction_id}")
            ->assertSuccessful();
    }

    /** @test */
    public function other_voters_cannot_view_the_disbursement()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->actingAs($this->createVoter())
            ->get("/dashboard/disbursements/{$disbursement->transaction_id}")
            ->assertStatus(403);
    }

    /** @test */
    public function guests_cannot_view_the_disbursement()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->get("/dashboard/disbursements/{$disbursement->transaction_id}")
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
