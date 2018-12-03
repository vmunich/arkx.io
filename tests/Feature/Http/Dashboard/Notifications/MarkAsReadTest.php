<?php

namespace Tests\Feature\Http\Dashboard\Notifications;

use App\Notifications\DisbursementSent;
use Tests\TestCase;

/**
 * @coversNothing
 */
class MarkAsReadTest extends TestCase
{
    /** @test */
    public function administrators_cannot_mark_the_notification_as_read()
    {
        $this
            ->actingAs($this->createAdministrator())
            ->post('/dashboard/notifications/fake/mark-as-read')
            ->assertStatus(403);
    }

    /** @test */
    public function voters_can_mark_the_notification_as_read()
    {
        $user = $this->createVoter();
        $user->notify(new DisbursementSent($this->createDisbursement()));

        $notification = $user->notifications->first();

        $this
            ->actingAs($user)
            ->post("/dashboard/notifications/{$notification->id}/mark-as-read")
            ->assertSuccessful();
    }

    /** @test */
    public function others_voters_cannot_mark_the_notification_as_read()
    {
        $user = $this->createVoter();
        $user->notify(new DisbursementSent($this->createDisbursement()));

        $notification = $user->notifications->first();

        $this
            ->actingAs($this->createVoter())
            ->post("/dashboard/notifications/{$notification->id}/mark-as-read")
            ->assertStatus(404);
    }

    /** @test */
    public function guests_cannot_mark_the_notification_as_read()
    {
        $this
            ->post('/dashboard/notifications/fake/mark-as-read')
            ->assertStatus(302)
            ->assertRedirect('/auth/login');
    }
}
