<?php

namespace Tests\Feature\Notifications;

use App\Models\User;
use App\Models\Wallet;
use App\Notifications\WalletVerified;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * @coversNothing
 */
class WalletVerifiedTest extends TestCase
{
    /** @test */
    public function it_should_notify_the_user()
    {
        Notification::fake();

        $wallet = factory(Wallet::class)->create();

        $user = factory(User::class)->create();
        $user->notify(new WalletVerified($wallet));

        Notification::assertSentTo(
            $user,
            WalletVerified::class,
            function ($notification, $channels) use ($wallet) {
                return $notification->wallet->id === $wallet->id;
            }
        );
    }
}
