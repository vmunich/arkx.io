<?php

namespace Tests\Feature\Http\Dashboard\LostAndFound;

use Tests\TestCase;

/**
 * @coversNothing
 */
class ListTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_the_lost_and_found_list()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/lost-and-found')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_the_lost_and_found_list()
    {
        $this->createWallet();

        $this
            ->actingAs($this->createVoter())
            ->get('/dashboard/lost-and-found')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_the_lost_and_found_list()
    {
        $this
            ->get('/dashboard/lost-and-found')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
