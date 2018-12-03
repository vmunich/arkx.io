<?php

namespace App\Console\Commands\Polling;

use App\Models\User;
use App\Models\Wallet;
use App\Services\Ark\Database;
use ArkX\Eloquent\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class Transactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:transactions {--skip-vendor-field} {--skip-limit} {--limit=500}';

    /**
     * Execute the console command.
     */
    public function handle(Database $database): void
    {
        $transactions = $this->getTransactions();

        foreach ($transactions as $transaction) {
            $vendorField = $transaction->vendorField;

            if (!$this->option('skip-vendor-field')) {
                if (empty($vendorField)) {
                    continue;
                }

                if ($vendorField !== config('ark.share.vendorField')) {
                    continue;
                }
            }

            $this->line('Polling Transaction: <info>'.$transaction->id.'</info>');

            $struct = [
                'transaction_id' => $transaction->id,
                'amount'         => $transaction->amount,
                'purpose'        => $vendorField,
                'signed_at'      => $transaction->timestamp_carbon,
                'transaction'    => standardise($transaction->deserialise()->toArray()),
            ];

            try {
                $wallet = Wallet::findByAddress($transaction->recipient_id);
            } catch (\Exception $e) {
                $response = $database->wallet($transaction->recipient_id);

                $wallet = User::first()->wallets()->firstOrCreate([
                    'address'    => $response->address,
                    'public_key' => $response->public_key,
                ]);

                $wallet->ban();
            }

            $wallet->disbursements()->firstOrCreate(
                ['transaction_id' => $transaction->id],
                $struct
            );
        }
    }

    private function getTransactions(): Collection
    {
        $query = Transaction::sendBy(config('ark.delegate.publicKey'));

        if (!$this->option('skip-limit')) {
            $query = $query->take($this->option('limit'));
        }

        return $query->orderByDesc('timestamp')->get();
    }
}
