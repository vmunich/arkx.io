<?php

namespace App\Services;

use App\Models\Block;
use App\Models\Wallet;
use ArkX\Calculus\Calculator as BaseCalculator;

class Calculator extends BaseCalculator
{
    /**
     * Create a new calculator instance.
     *
     * @param int $votingPool
     * @param int $profitShare
     */
    public function __construct()
    {
        $this->votingPool = Wallet::eligible()->sum('balance');
        $this->profitShare = config('ark.share.percentage');
    }

    public function withBlock(Block $block): void
    {
        config('ark.share.fees')
            ? $this->setReward($block->reward + $block->total_fee)
            : $this->setReward($block->reward);
    }

    public function forWallet(Wallet $wallet): int
    {
        $this->setProfitShare($wallet->percentage);

        return $this->perBlock($wallet->stake)->toInteger();
    }
}
