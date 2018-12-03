<?php

namespace App\Nova\Lenses\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;

class MostValuable extends Lens
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
            $query->select(static::columns())
                  ->join('wallets', 'users.id', '=', 'wallets.user_id')
                  ->orderBy('balance', 'desc')
                  ->groupBy('users.id', 'wallets.address')
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
            Text::make('E-Mail', 'email')
                ->sortable(),

            Number::make('Balance', 'formatted_balance')
                ->onlyOnIndex()
                ->sortable(),

            Number::make('Earnings', 'formatted_earnings')
                ->onlyOnIndex()
                ->sortable(),
        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'most-valuable';
    }

    /**
     * Get the columns that should be selected.
     *
     * @return array
     */
    protected static function columns()
    {
        return [
            'users.id',
            'users.email',
            'wallets.address',
            DB::raw('sum(wallets.balance) as balance'),
            DB::raw('count(wallets.id) as count'),
        ];
    }
}
