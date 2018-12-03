<?php

namespace Tests\Feature;

use App\Jobs\CreateDisbursement;
use App\Models\Wallet;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

/**
 * @coversNothing
 */
class CreateDisbursementTest extends TestCase
{
    /** @test */
    public function it_should_push_the_job_to_the_queue()
    {
        Queue::fake();

        $wallet = factory(Wallet::class)->create();

        CreateDisbursement::dispatch($wallet);

        Queue::assertPushed(CreateDisbursement::class, function ($job) use ($wallet) {
            return $job->wallet->id === $wallet->id;
        });

        // Queue::assertPushedOn('disbursements', CreateDisbursement::class);
    }
}
