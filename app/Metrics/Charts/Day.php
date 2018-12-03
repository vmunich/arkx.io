<?php

namespace App\Metrics\Charts;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

class Day extends Chart
{
    /**
     * Create the daily data for ChartJS.
     *
     * @param \Illuminate\Database\Eloquent\Relations\Relation $query
     *
     * @return \Illuminate\Support\Collection
     */
    public static function create(Relation $query): Collection
    {
        // range...
        $start = static::now()->startOfDay();
        $end = static::now()->endOfDay();

        // keys...
        $keys = range($start->hour, $end->hour);

        // format keys...
        $keys = collect($keys)->map(function ($key) {
            return sprintf('%02d:00', $key, 0);
        })->flip()->toArray();

        // records...
        $disbursements = $query
            ->whereBetween('disbursements.signed_at', [$start, $end])
            ->get(['amount', 'signed_at']);

        return static::format('H', $keys, $disbursements);
    }
}
