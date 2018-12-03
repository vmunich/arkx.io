<?php

namespace App\Console\Commands\Polling;

use App\Models\Disbursement;
use App\Services\Ark\Database;
use ArkX\Eloquent\Models\Block;
use ArkX\Eloquent\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Confirmations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:confirmations';

    /**
     * Execute the console command.
     */
    public function handle(Database $database): void
    {
        $disbursements = $this->getDisbursements();
        $currentHeight = Block::orderByDesc('height')->first()->height;

        foreach ($disbursements as $disbursement) {
            try {
                $transaction = Transaction::findById($disbursement->transaction_id);

                $this->line('Polling Confirmations: <info>'.$transaction->id.'</info>');

                $disbursement->update([
                    'confirmations' => $currentHeight - $transaction->block->height,
                ]);
            } catch (\Exception $e) {
                Log::critical('Transaction not found - '.$disbursement->transaction_id);
            }
        }
    }

    private function getDisbursements(): Collection
    {
        $confirmations = config('ark.broadcast.confirmations');

        return Disbursement::where('confirmations', '<', $confirmations)->get();
    }
}
