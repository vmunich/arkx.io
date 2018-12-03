<?php

namespace App\Services\Navigation\Menus;

use Spatie\Menu\Laravel\Menu;

class Dashboard
{
    /**
     * Register a new menu.
     */
    public function register(): void
    {
        Menu::macro('dashboard', function () {
            return $this
                ->icon()
                ->iconRoute('dashboard.home', 'tachometer', 'Dashboard')
                ->iconBadge('dashboard.notifications', 'bell', 'Notifications', auth()->user()->unreadNotifications->count())
                ->iconRoute('dashboard.lost-and-found', 'fingerprint', 'Lost & Found')
                ->iconRoute('dashboard.wallets', 'wallet', 'Wallets')
                ->iconRoute('dashboard.disbursements', 'money-check', 'Disbursements')
                ->iconRoute('dashboard.metrics', 'chart-line', 'Metrics')
                ->iconRoute('dashboard.api', 'laptop-code', 'API');
        });
    }
}
