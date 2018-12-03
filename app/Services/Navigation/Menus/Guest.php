<?php

namespace App\Services\Navigation\Menus;

use Spatie\Menu\Laravel\Menu;

class Guest
{
    /**
     * Register a new menu.
     */
    public function register(): void
    {
        Menu::macro('guest', function () {
            return $this
                ->icon()
                ->iconRoute('blocks', 'gavel', 'Blocks')
                ->iconRoute('wallets', 'wallet', 'Wallets')
                ->iconRoute('disbursements', 'money-check', 'Disbursements')
                ->iconRoute('reports', 'file-invoice-dollar', 'Reports');
        });
    }
}
