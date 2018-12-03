<?php

namespace Tests\Feature\Http\Dashboard\Disbursements;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ListTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_announcement_list()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/disbursements')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_the_announcement_list()
    {
        $this->createIdentity($user = $this->createVoter());

        $this
            ->actingAs($user)
            ->get('/dashboard/disbursements')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_the_announcement_list()
    {
        $this
            ->get('/dashboard/disbursements')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
