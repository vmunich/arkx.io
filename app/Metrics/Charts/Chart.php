<?php

namespace App\Metrics\Charts;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

abstract class Chart
{
    /**
     * Create a set of ChartJS data.
     *
     * @param \Illuminate\Database\Eloquent\Relations\Relation $query
     *
     * @return \Illuminate\Support\Collection
     */
    abstract public static function create(Relation $query): Collection;

    /**
     * Get an instance of the current date & time.
     *
     * @return \Illuminate\Support\Carbon
     */
    protected static function now(): Carbon
    {
        return Carbon::now();
    }

    /**
     * Format the specified disbursements.
     *
     * @param string                         $format
     * @param array                          $keys
     * @param \Illuminate\Support\Collection $disbursements
     *
     * @return \Illuminate\Support\Collection
     */
    protected static function format(string $format, array $keys, Collection $disbursements): Collection
    {
        return new Collection(static::merge($keys, static::map($disbursements, $format)));
    }

    /**
     * Map the specified disbursements using the specified date format.
     *
     * @param \Illuminate\Support\Collection $disbursements
     * @param string                         $format
     *
     * @return \Illuminate\Support\Collection
     */
    protected static function map(Collection $disbursements, string $format): Collection
    {
        return $disbursements->groupBy(function ($item) use ($format) {
            return $item->signed_at->format($format);
        })->mapWithKeys(function ($value, $key) {
            return [$key => $value->sum('amount') / 1e8];
        });
    }

    /**
     * Merge the specified keys and values.
     *
     * @param array $keys
     * @param array $values
     *
     * @return array
     */
    protected static function merge(array $keys, $values): array
    {
        foreach ($keys as $key => $value) {
            $keys[$key] = $values->get($key, 0);
        }

        return $keys;
    }
}
