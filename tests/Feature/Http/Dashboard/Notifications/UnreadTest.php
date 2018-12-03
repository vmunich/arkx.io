<?php

namespace Tests\Feature\Http\Dashboard\Notifications;

use App\Notifications\DisbursementSent;
use Tests\TestCase;

/**
 * @coversNothing
 */
class UnreadTest extends TestCase
{
    /** @test */
    public function administrators_cannot_view_unread_notifications()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->get('/dashboard/notifications/unread')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_view_unread_notifications()
    {
        $user = $this->createVoter();
        $user->notify(new DisbursementSent($this->createDisbursement()));

        $this
            ->actingAs($user)
            ->get('/dashboard/notifications/unread')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_unread_notifications()
    {
        $this
            ->get('/dashboard/notifications/unread')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
