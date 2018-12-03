<?php

namespace App\Console\Commands\Polling;

use App\Models\Block;
use App\Models\Disbursement;
use App\Services\Ark\Database;
use ArkX\Eloquent\Models\Wallet;
use Illuminate\Console\Command;

class Delegate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:delegate';

    /**
     * Execute the console command.
     */
    public function handle(Database $database)
    {
        $delegate = $database->delegate();

        cache()->put('delegate.rank', $this->getRank(), 60);
        cache()->put('delegate.productivity', $this->getProductivity($delegate), 60);
        cache()->put('delegate.votes', $delegate->vote_balance, 60);

        // Disbursed
        cache()->rememberForever('delegate.disbursed', function () {
            return Disbursement::sum('amount');
        });

        // Forged
        cache()->rememberForever('delegate.blocks', function () {
            return Block::count();
        });
    }

    public function getRank(): int
    {
        return Wallet::whereNotNull('username')
            ->orderByDesc('vote_balance')
            ->take(51)
            ->get()
            ->pluck('username')
            ->search(config('ark.delegate.username'));
    }

    public function getProductivity(Wallet $delegate): float
    {
        $missedBlocks = $delegate->missed_blocks;
        $producedBlocks = $delegate->produced_blocks;

        return round((1 - $missedBlocks / $producedBlocks) * 100, 2);
    }
}
