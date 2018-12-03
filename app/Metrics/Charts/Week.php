<?php

namespace App\Metrics\Charts;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Week extends Chart
{
    /**
     * Create the weekly data for ChartJS.
     *
     * @param \Illuminate\Database\Eloquent\Relations\Relation $query
     *
     * @return \Illuminate\Support\Collection
     */
    public static function create(Relation $query): Collection
    {
        // range...
        $start = static::now()->startOfWeek();
        $end = static::now()->endOfWeek();

        // keys...
        $keys = array_flip(range($start->day, $end->day));

        // format keys...
        $keys = Carbon::range($start, $end)->map(function ($date) {
            return $date->format('d.m');
        })->flip()->toArray();

        // records...
        $disbursements = $query
            ->whereBetween('disbursements.signed_at', [$start, $end])
            ->get(['amount', 'signed_at']);

        return static::format('d.m', $keys, $disbursements);
    }
}
