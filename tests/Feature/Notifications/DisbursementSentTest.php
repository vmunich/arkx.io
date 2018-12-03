<?php

namespace Tests\Feature\Notifications;

use App\Models\User;
use App\Notifications\DisbursementSent;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * @coversNothing
 */
class DisbursementSentTest extends TestCase
{
    /** @test */
    public function it_should_notify_the_user()
    {
        Notification::fake();

        $disbursement = $this->createDisbursement();

        $user = factory(User::class)->create();
        $user->notify(new DisbursementSent($disbursement));

        Notification::assertSentTo(
            $user,
            DisbursementSent::class,
            function ($notification, $channels) use ($disbursement) {
                return $notification->disbursement->id === $disbursement->id;
            }
        );
    }
}
