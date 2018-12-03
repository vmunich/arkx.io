<?php

namespace Tests\Feature\Http\Dashboard\Disbursements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ExportTest extends TestCase
{
    /** @test */
    public function administrators_cannot_export_the_disbursements()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/disbursements/export')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_export_the_disbursements()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->actingAs($disbursement->user)
            ->get('/dashboard/disbursements/export')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_export_the_disbursements()
    {
        $disbursement = $this->createDisbursement();

        $this
            ->get('/dashboard/disbursements/export')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
