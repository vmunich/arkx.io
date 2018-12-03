<?php

namespace App\Console\Commands\Disburse;

use App\Services\Ark\Broadcaster;
use App\Services\Ark\Signer;
use Illuminate\Console\Command;

class Jobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:disburse:jobs';

    /**
     * Execute the console command.
     *
     * @param \App\Services\Ark\Signer      $broadcaster
     * @param \App\Services\Ark\Broadcaster $signer
     *
     * @return mixed
     */
    public function handle(Signer $signer, Broadcaster $broadcaster)
    {
        foreach (config('ark.jobs') as $job) {
            if (!$job['enabled']) {
                continue;
            }

            $transfer = $signer->sign(
                $job['address'],
                (422 * ($job['sharePercentage'] / 100)) * 1e8,
                $job['vendorField']
            );

            if ($transfer->verify()) {
                $broadcaster->broadcast([$transfer->toArray()]);

                $this->info('The transaction has been broadcasted.');
            } else {
                $this->error('The transaction could not be verified.');
            }
        }
    }
}
