<?php

namespace App\Http\ViewComposers\Shared;

use App\Services\Version;
use Exception;
use Illuminate\View\View;

class GlobalViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     */
    public function compose(View $view): void
    {
        $view->with('currentUser', auth()->user());

        if (auth()->check()) {
            $view->with('unreadNotifications', auth()->user()->unreadNotifications->count());
        }

        $view->with('walletFrequencies', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly']);

        try {
            $view->with('appVersion', Version::get());
        } catch (Exception $e) {
            $view->with('appVersion', null);
        }
    }
}
