<?php

namespace App\Console\Commands;

use App\Models\Disbursement;
use App\Services\Ark\Database;
use ArkEcosystem\Crypto\Transactions\Deserializer;
use ArkEcosystem\Crypto\Transactions\Serializer;
use ArkX\Eloquent\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class VerifyDisbursements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:verify {--limit=1000}';

    /**
     * Execute the console command.
     */
    public function handle(Database $database): void
    {
        $disbursements = $this->getDisbursements();

        foreach ($disbursements as $disbursement) {
            $serialised = Serializer::new($disbursement->transaction)->serialize();
            $deserialised = Deserializer::new($serialised->getHex())->deserialize();

            if (!$deserialised->verify()) {
                Log::critical('Transaction is invalid - '.$disbursement->transaction_id);
            }
        }
    }

    private function getDisbursements(): Collection
    {
        return Disbursement::latest()
            ->limit($this->option('limit'))
            ->get();
    }
}
