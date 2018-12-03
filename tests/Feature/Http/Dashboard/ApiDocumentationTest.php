<?php

namespace Tests\Feature\Http\Dashboard;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ApiDocumentationTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_api_documentation()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/api')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_the_api_documentation()
    {
        $this->createIdentity($user = $this->createVoter());

        $this
            ->actingAs($user)
            ->get('/dashboard/api')
            ->assertSuccessful()
            ->assertSee($user->api_token);
    }

    /** @test */
    public function guests_cannot_view_the_api_documentation()
    {
        $this
            ->get('/dashboard/api')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
