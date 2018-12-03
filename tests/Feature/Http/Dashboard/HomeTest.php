<?php

namespace Tests\Feature\Http\Dashboard;

use Tests\TestCase;

/**
 * @coversNothing
 */
class HomeTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_dashboard()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_the_dashboard()
    {
        $this->createIdentity($user = $this->createVoter());

        $this
            ->actingAs($user)
            ->get('/dashboard')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_the_dashboard()
    {
        $this
            ->get('/dashboard')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
