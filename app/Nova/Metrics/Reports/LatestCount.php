<?php

namespace App\Nova\Metrics\Reports;

use App\Models\Report;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class LatestCount extends Value
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
        $latest = Report::latest()->first();
        $previous = Report::latest()->where('id', '<', $latest->id)->first();

        return $this
            ->result($latest->count)
            ->previous($previous->count);
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
        return 'reports-latest-count';
    }
}
