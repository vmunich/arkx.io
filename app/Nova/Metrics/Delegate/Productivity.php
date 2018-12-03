<?php

namespace App\Nova\Metrics\Delegate;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class Productivity extends Value
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
            ->result(cache('delegate.productivity'))
            ->previous(cache('delegate.productivity.previous', 0))
            ->suffix('%');
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'delegate-productivity';
    }
}
