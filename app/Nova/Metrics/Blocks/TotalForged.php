<?php

namespace App\Nova\Metrics\Blocks;

use App\Models\Block;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class TotalForged extends Value
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
        return $this->result(Block::sum('reward') / 1e8)->suffix('Ѧ');
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
        return 'total-forged';
    }
}
