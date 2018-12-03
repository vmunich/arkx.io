<?php

namespace App\Services\Navigation\Tabs;

use Spatie\Menu\Laravel\Menu;

class Settings
{
    /**
     * Register a new menu.
     */
    public function register(): void
    {
        Menu::macro('settingTabs', function () {
            return $this
                ->tabs()
                ->route('account.settings.profile', 'Profile')
                ->route('account.settings.security.password', 'Password')
                ->route('account.settings.security.two-factor', 'Two-Factor Authentication');
        });
    }
}
