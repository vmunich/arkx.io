<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Disbursement;
use App\Models\Report;
use App\Models\Wallet;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();

        $this->registerRouteBindings();
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapAuthRoutes();

        $this->mapAccountRoutes();

        $this->mapDashboardRoutes();

        $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace("{$this->namespace}\\Front")
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "authentication" routes for the application.
     */
    protected function mapAuthRoutes()
    {
        Route::prefix('auth')
             ->middleware('web')
             ->namespace("{$this->namespace}\\Auth")
             ->group(base_path('routes/auth.php'));
    }

    /**
     * Define the "account" routes for the application.
     */
    protected function mapAccountRoutes()
    {
        Route::prefix('account')
             ->as('account.')
             ->middleware(['web', 'auth', 'verified', 'forbidden'])
             ->namespace("{$this->namespace}\\Account")
             ->group(base_path('routes/account.php'));
    }

    /**
     * Define the "dashboard" routes for the application.
     */
    protected function mapDashboardRoutes()
    {
        Route::prefix('dashboard')
             ->as('dashboard.')
             ->middleware(['web', 'auth', 'verified', 'role:voter', 'forbidden'])
             ->namespace("{$this->namespace}\\Dashboard")
             ->group(base_path('routes/dashboard.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->as('api.')
             ->middleware('api')
             ->namespace($this->namespace.'\\API')
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the route model bindings for the application.
     */
    private function registerRouteBindings()
    {
        Route::bind('report', function ($value, $route) {
            $date = Carbon::parse($value);

            return Report::whereBetween('date', [
                $date->copy()->startOfDay(),
                $date->copy()->endOfDay(),
            ])->firstOrFail();
        });

        Route::bind('announcement', function ($value, $route) {
            return Announcement::whereSlug($value)->firstOrFail();
        });

        Route::bind('wallet', function ($value, $route) {
            $wallet = Wallet::findByAddress($value);

            if ($wallet->is_private) {
                abort(404);
            }

            return $wallet;
        });

        Route::bind('disbursement', function ($value, $route) {
            return Disbursement::findByTransactionId($value);
        });
    }
}
