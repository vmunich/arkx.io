<?php

namespace App\Nova\Lenses\Reports;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;

class MostFees extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param \Laravel\Nova\Http\Requests\LensRequest $request
     * @param \Illuminate\Database\Eloquent\Builder   $query
     *
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->orderBy('fees', 'desc')
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Date::make('Date')
                ->sortable(),

            Number::make('Count')
                ->sortable(),

            Number::make('Amount')
                ->sortable()
                ->displayUsing(function ($amount) {
                    return format_arktoshi($amount, 8);
                }),

            Number::make('Fees')
                ->sortable()
                ->displayUsing(function ($fees) {
                    return format_arktoshi($fees, 8);
                }),
        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'most-fees';
    }
}
