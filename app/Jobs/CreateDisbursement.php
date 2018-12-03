<?php

namespace App\Jobs;

use App\Models\Wallet;
use App\Services\Ark\Signer;
use ArkX\Eloquent\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use RuntimeException;

class CreateDisbursement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The wallet instance.
     *
     * @var \App\Models\Wallet
     */
    public $wallet;

    /**
     * Create a new job instance.
     */
    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    /**
     * Execute the job.
     *
     * @params \App\Services\Ark\Signer $signer
     */
    public function handle(Signer $signer)
    {
        $transaction = $signer->sign(
            $this->wallet->address,
            $this->wallet->earnings,
            config('ark.share.vendorField')
        );

        if (!$transaction->verify()) {
            throw new RuntimeException('Invalid transaction: '.json_encode($transaction));
        }

        $transaction = $transaction->toArray();

        $disbursement = $this->wallet->disbursements()->create([
            'transaction_id' => $transaction['id'],
            'amount'         => $transaction['amount'],
            'purpose'        => $transaction['vendorField'],
            'signed_at'      => humanize_epoch($transaction['timestamp']),
            'transaction'    => standardise($transaction),
        ]);

        $this->wallet->update(['earnings' => 0]);
    }

    /**
     * Get the tags that should be assigned to the job.
     *
     * @return array
     */
    public function tags()
    {
        return ['disburse', 'wallet:'.$this->wallet->id];
    }
}
