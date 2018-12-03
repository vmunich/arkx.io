<?php

namespace App\Services\Navigation\Menus;

use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Menu;

class Tools
{
    /**
     * Register a new menu.
     */
    public function register(): void
    {
        Menu::macro('tools', function () {
            return $this
                ->icon()
                ->iconLink('https://ark.delegates.io/', 'server', 'Delegates')
                ->registerFilter(function (Link $link) {
                    $link->addClass('mb-5');
                })
                ->iconLink('https://ark.delegates.io/calculator', 'calculator', 'Calculator');
        });
    }
}
