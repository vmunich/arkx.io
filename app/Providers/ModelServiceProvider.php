<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Block;
use App\Models\Scopes\LatestScope;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        Announcement::addGlobalScope(new LatestScope());
        Block::addGlobalScope(new LatestScope());
    }
}
