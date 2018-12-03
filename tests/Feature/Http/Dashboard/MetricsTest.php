<?php

namespace Tests\Feature\Http\Dashboard;

use Tests\TestCase;

/**
 * @coversNothing
 */
class MetricsTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_metrics()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/metrics')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_the_metrics()
    {
        $user = $this->createVoter();
        $this->createIdentity($user);

        $this
            ->actingAs($user)
            ->get('/dashboard/metrics')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_the_metrics()
    {
        $this
            ->get('/dashboard/metrics')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
