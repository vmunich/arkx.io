<?php

namespace Tests\Feature\Http\Dashboard\Notifications;

use App\Notifications\DisbursementSent;
use Tests\TestCase;

/**
 * @coversNothing
 */
class ReadTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_read_notifications()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/notifications/read')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_read_notifications()
    {
        $user = $this->createVoter();
        $user->notify(new DisbursementSent($this->createDisbursement()));

        $this
            ->actingAs($user)
            ->get('/dashboard/notifications/read')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_read_notifications()
    {
        $this
            ->get('/dashboard/notifications/read')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
