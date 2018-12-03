<?php

namespace App\Metrics\Charts;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Quarter extends Chart
{
    /**
     * Create the quarterly data for ChartJS.
     *
     * @param \Illuminate\Database\Eloquent\Relations\Relation $query
     *
     * @return \Illuminate\Support\Collection
     */
    public static function create(Relation $query): Collection
    {
        // range...
        $start = static::now()->firstOfQuarter();
        $end = static::now()->lastOfQuarter();

        // keys...
        $keys = Carbon::range($start, $end)->groupBy(function ($item) {
            return $item->format('F');
        })->toArray();

        // records...
        $disbursements = $query
            ->whereBetween('disbursements.signed_at', [$start, $end])
            ->get(['amount', 'signed_at']);

        return static::format('F', $keys, $disbursements);
    }
}
