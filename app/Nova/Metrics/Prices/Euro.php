<?php

namespace App\Nova\Metrics\Prices;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class Euro extends Value
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
            ->result(cache('prices.eur'))
            ->previous(cache('prices.eur.previous'))
            ->prefix('€');
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'prices-eur';
    }
}
