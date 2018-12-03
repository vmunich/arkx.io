<?php

namespace App\Metrics\Charts;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

class Year extends Chart
{
    /**
     * Create the yearly data for ChartJS.
     *
     * @param \Illuminate\Database\Eloquent\Relations\Relation $query
     *
     * @return \Illuminate\Support\Collection
     */
    public static function create(Relation $query): Collection
    {
        // range...
        $start = static::now()->firstOfYear();
        $end = static::now()->lastOfYear();

        // keys...
        $keys = array_flip([
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',
        ]);

        // records...
        $disbursements = $query
            ->whereBetween('signed_at', [$start, $end])
            ->get(['amount', 'signed_at']);

        return static::format('M', $keys, $disbursements);
    }
}
