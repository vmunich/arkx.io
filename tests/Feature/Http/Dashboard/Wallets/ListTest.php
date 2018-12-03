<?php

namespace Tests\Feature\Http\Dashboard\Wallets;

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
            ->get('/dashboard/wallets')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_the_announcement_list()
    {
        $user = $this->createVoter();
        $this->createIdentity($user);

        $this
            ->actingAs($user)
            ->get('/dashboard/wallets')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_the_announcement_list()
    {
        $this
            ->get('/dashboard/wallets')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
