<?php

namespace App\Services;

class Warden
{
    /**
     * Determine if the address is whitelisted.
     *
     * @param string $address
     *
     * @return bool
     */
    public static function whitelisted(string $address): bool
    {
        return in_array($address, config('ark.wallets.whitelist'), true);
    }

    /**
     * Determine if the address is blacklisted.
     *
     * @param string $address
     *
     * @return bool
     */
    public static function blacklisted(string $address): bool
    {
        return in_array($address, config('ark.wallets.blacklist'), true);
    }
}
