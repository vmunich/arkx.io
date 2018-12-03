<?php

namespace App\Metrics\Charts;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Month extends Chart
{
    /**
     * Create the monthly data for ChartJS.
     *
     * @param \Illuminate\Database\Eloquent\Relations\Relation $query
     *
     * @return \Illuminate\Support\Collection
     */
    public static function create(Relation $query): Collection
    {
        // range...
        $start = static::now()->startOfMonth();
        $end = static::now()->endOfMonth();

        // keys...
        $keys = array_flip(range(1, static::now()->daysInMonth));

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
