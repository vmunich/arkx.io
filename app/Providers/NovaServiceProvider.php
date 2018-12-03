<?php

namespace App\Providers;

use App\Nova\Metrics\Delegate\Productivity;
use App\Nova\Metrics\Delegate\Rank;
use App\Nova\Metrics\Delegate\Votes;
use App\Nova\Metrics\Prices\Bitcoin;
use App\Nova\Metrics\Prices\Dollar;
use App\Nova\Metrics\Prices\Euro;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \Spatie\TailTool\TailTool(),
            new \Spatie\BackupTool\BackupTool(),
            new \OhDear\OhDearTool\OhDearTool(),
        ];
    }

    /**
     * Register the Nova routes.
     */
    protected function routes()
    {
        Nova::routes()->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return $user->hasRole('admin');
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            (new Bitcoin())->width('1/3'),
            (new Dollar())->width('1/3'),
            (new Euro())->width('1/3'),

            (new Votes())->width('1/3'),
            (new Rank())->width('1/3'),
            (new Productivity())->width('1/3'),
        ];
    }
}
