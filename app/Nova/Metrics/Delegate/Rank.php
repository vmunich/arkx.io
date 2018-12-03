<?php

namespace App\Nova\Metrics\Delegate;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class Rank extends Value
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
            ->result(cache('delegate.rank'))
            ->previous(cache('delegate.rank.previous', 0));
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'delegate-rank';
    }
}
