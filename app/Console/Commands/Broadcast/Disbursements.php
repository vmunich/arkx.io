<?php

namespace App\Console\Commands\Broadcast;

use App\Jobs\BroadcastDisbursements as Job;
use App\Models\Disbursement;
use App\Services\Ark\Broadcaster;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class Disbursements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:broadcast:disbursements {--unconfirmed} {--limit=500}';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Broadcaster $broadcaster)
    {
        $disbursements = $this->option('unconfirmed')
            ? $this->getUnconfirmed()
            : $this->getDisbursements();

        foreach ($disbursements->chunk(config('ark.broadcast.chunkSize')) as $chunk) {
            $this->line("Broadcasting Transactions: <info>{$chunk->count()}</info>");

            $chunk = $chunk->map(function ($disbursement) {
                return $disbursement->transaction;
            });

            Job::dispatch($chunk);
        }

        $this->line("Broadcasting of <info>{$disbursements->count()}</info> transactions was successful.");
    }

    private function getDisbursements(): Collection
    {
        $disbursements = Disbursement::latest();

        if ($this->option('limit')) {
            $disbursements = $disbursements->limit($this->option('limit'));
        }

        return $disbursements->get();
    }

    private function getUnconfirmed(): Collection
    {
        return Disbursement::where('confirmations', '<', config('ark.broadcast.confirmations'))
            ->get();
    }
}
