<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Wallet extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Wallet::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'user_id', 'address', 'public_key', 'balance', 'earnings',
        'verification_token', 'claimed_at', 'verified_at', 'banned_at',
    ];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['user'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()
                ->sortable(),

            BelongsTo::make('User')
                ->onlyOnForms()
                ->searchable(),

            Text::make('Address')
                ->sortable(),

            Number::make('Balance')
                ->exceptOnForms()
                ->sortable()
                ->displayUsing(function ($amount) {
                    return format_arktoshi($amount, 8);
                }),

            Number::make('Earnings')
                ->exceptOnForms()
                ->sortable()
                ->displayUsing(function ($amount) {
                    return format_arktoshi($amount, 8);
                }),

            Date::make('Banned at')
                ->sortable()
                ->rules('nullable', 'date'),

            Code::make('Extra Attributes', 'extra_attributes')->resolveUsing(function ($name) {
                return json_encode($name->all(), JSON_PRETTY_PRINT);
            })->json()->onlyOnForms(),

            HasMany::make('Disbursements'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new Metrics\Wallets\Growth(),
            new Metrics\Wallets\State(),
            new Metrics\Wallets\Frequencies(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new Lenses\Wallets\MostValuable(),
            new Lenses\Wallets\Banned(),
            new Lenses\Wallets\Verified(),
            new Lenses\Wallets\Unverified(),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new Actions\Ban(),
            new Actions\Unban(),
            new DownloadExcel(),
        ];
    }
}
