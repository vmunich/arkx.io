<?php

namespace App\Nova\Metrics\Wallets;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Partition;

class Frequencies extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->result([
            'Daily'     => Wallet::notBanned()->frequency('daily')->count(),
            'Weekly'    => Wallet::notBanned()->frequency('weekly')->count(),
            'Monthly'   => Wallet::notBanned()->frequency('monthly')->count(),
            'Quarterly' => Wallet::notBanned()->frequency('quarterly')->count(),
            'Yearly'    => Wallet::notBanned()->frequency('yearly')->count(),
        ]);
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'wallets-per-frequency';
    }
}
