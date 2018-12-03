<?php

namespace App\Nova\Metrics\Delegate;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class Votes extends Value
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
            ->result((int) cache('delegate.votes') / 1e8)
            ->previous((int) cache('delegate.votes.previous', 0) / 1e8)
            ->suffix('Ѧ');
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'delegate-votes';
    }
}
