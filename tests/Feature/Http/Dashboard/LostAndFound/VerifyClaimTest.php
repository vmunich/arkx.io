<?php

namespace Tests\Feature\Http\Dashboard\LostAndFound;

use App\Models\Wallet;
use ArkEcosystem\Crypto\Identities\Address;
use ArkEcosystem\Crypto\Identities\PublicKey;
use ArkEcosystem\Crypto\Utils\Message;
use Tests\TestCase;

/**
 * @coversNothing
 */
class VerifyClaimTest extends TestCase
{
    private $invalidMessage = 'The signed message could not be verified! The wallet has been reset.';

    /** @test */
    public function cannot_verify_claim_if_the_message_is_invalid()
    {
        $message = Message::sign('Hello World', 'passphrase')->toArray();
        $message['message'] = 'invalid';

        $wallet = factory(Wallet::class)->create([
            'address'            => Address::fromPassphrase('passphrase'),
            'public_key'         => PublicKey::fromPassphrase('passphrase')->getHex(),
            'verification_token' => 'Hello World',
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($wallet->user)
            ->post("/dashboard/lost-and-found/{$wallet->address}", [
                'message' => json_encode($message),
            ])
            ->assertSessionHas('alert.message', $this->invalidMessage);
    }

    /** @test */
    public function cannot_verify_claim_if_the_public_key_does_not_match()
    {
        $message = Message::sign('Hello', 'other passphrase')->toArray();

        $wallet = factory(Wallet::class)->create([
            'address'            => Address::fromPassphrase('passphrase'),
            'public_key'         => PublicKey::fromPassphrase('passphrase')->getHex(),
            'verification_token' => 'Hello World',
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($wallet->user)
            ->post("/dashboard/lost-and-found/{$wallet->address}", [
                'message' => json_encode($message),
            ])
            ->assertSessionHas('alert.message', $this->invalidMessage);
    }

    /** @test */
    public function cannot_verify_claim_if_the_message_does_not_match()
    {
        $message = Message::sign('Hello', 'passphrase')->toArray();

        $wallet = factory(Wallet::class)->create([
            'address'            => Address::fromPassphrase('passphrase'),
            'public_key'         => PublicKey::fromPassphrase('passphrase')->getHex(),
            'verification_token' => 'Hello World',
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($wallet->user)
            ->post("/dashboard/lost-and-found/{$wallet->address}", [
                'message' => json_encode($message),
            ])
            ->assertSessionHas('alert.message', $this->invalidMessage);
    }

    /** @test */
    public function can_verify_claim_if_the_message_is_valid()
    {
        $message = Message::sign('Hello World', 'passphrase')->toArray();

        $wallet = factory(Wallet::class)->create([
            'address'            => Address::fromPassphrase('passphrase'),
            'public_key'         => PublicKey::fromPassphrase('passphrase')->getHex(),
            'verification_token' => 'Hello World',
            'verified_at'        => null,
        ]);

        $this
            ->actingAs($wallet->user)
            ->post("/dashboard/lost-and-found/{$wallet->address}", [
                'message' => json_encode($message),
            ])
            ->assertSessionHas('alert.message', 'The wallet has been verified.');

        $this->assertNull($wallet->fresh()->verification_token);
        $this->assertNotNull($wallet->fresh()->verified_at);
    }
}
