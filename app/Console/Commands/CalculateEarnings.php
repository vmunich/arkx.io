<?php

namespace App\Console\Commands;

use App\Models\Block;
use App\Models\Wallet;
use App\Services\Calculator;
use Illuminate\Console\Command;

class CalculateEarnings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:calculate';

    /**
     * Execute the console command.
     */
    public function handle(Calculator $calculator): void
    {
        $wallets = Wallet::eligible();

        Block::notProcessed()->each(function ($block) use ($calculator, $wallets) {
            $this->line("Processing Block: <info>{$block->id}</info>");

            $wallets->each(function ($wallet) use ($calculator, $block) {
                $this->line("Processing Wallet: <info>{$wallet->address}</info>");

                $calculator->withBlock($block);

                $wallet->increment('earnings', $calculator->forWallet($wallet));
            });

            $block->markAsProcessed();
        });
    }
}
