<?php

namespace App\Nova\Metrics\Prices;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class Bitcoin extends Value
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
        return $this
            ->result(cache('prices.btc'))
            ->previous(cache('prices.btc.previous'))
            ->prefix('฿');
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'prices-btc';
    }
}
