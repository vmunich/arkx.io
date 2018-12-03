<?php

namespace Tests\Feature\Jobs;

use App\Jobs\BroadcastDisbursements;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

/**
 * @coversNothing
 */
class BroadcastDisbursementsTest extends TestCase
{
    // TODO: adjust to bulk broadcast
    public function testExample()
    {
        Queue::fake();

        $disbursement = $this->createDisbursement();
        $disbursements = collect($disbursement->transaction);

        BroadcastDisbursements::dispatch($disbursements);

        Queue::assertPushed(BroadcastDisbursements::class, function ($job) use ($disbursements) {
            return $job->disbursements === $disbursements->toArray();
        });

        // Queue::assertPushedOn('disbursements', BroadcastDisbursements::class);
    }
}
