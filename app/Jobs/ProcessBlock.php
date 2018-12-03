<?php

namespace App\Jobs;

use App\Models\Block;
use App\Models\Wallet;
use App\Services\Calculator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessBlock implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The block instance.
     *
     * @var \App\Models\Block
     */
    public $block;

    /**
     * Create a new job instance.
     */
    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    /**
     * Execute the job.
     */
    public function handle(Calculator $calculator)
    {
        Wallet::eligible()->each(function ($wallet) use ($calculator) {
            $calculator->withBlock($this->block);

            $wallet->increment('earnings', $calculator->forWallet($wallet));
        });

        $this->block->markAsProcessed();
    }

    /**
     * Get the tags that should be assigned to the job.
     *
     * @return array
     */
    public function tags()
    {
        return [
            'process',
            'block:'.$this->block->id,
        ];
    }
}
