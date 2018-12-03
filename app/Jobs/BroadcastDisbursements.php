<?php

namespace App\Jobs;

use App\Services\Ark\Broadcaster;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class BroadcastDisbursements implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The disbursements to be broadcasted.
     *
     * @var \Illuminate\Support\Collection
     */
    public $disbursements;

    /**
     * Create a new job instance.
     */
    public function __construct(Collection $disbursements)
    {
        $this->disbursements = $disbursements->values()->toArray();
    }

    /**
     * Execute the job.
     *
     * @params \App\Services\Ark\Broadcaster $broadcaster
     */
    public function handle(Broadcaster $broadcaster)
    {
        $broadcaster->broadcast($this->disbursements);
    }

    /**
     * Get the tags that should be assigned to the job.
     *
     * @return array
     */
    public function tags()
    {
        return ['broadcast'];
    }
}
