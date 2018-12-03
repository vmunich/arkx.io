<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;

class WalletPolicy extends Policy
{
    /**
     * Determine whether the user can view the wallet.
     *
     * @param \App\Models\User   $user
     * @param \App\Models\Wallet $wallet
     *
     * @return mixed
     */
    public function view(User $user, Wallet $wallet)
    {
        return (int) $wallet->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the wallet.
     *
     * @param \App\Models\User   $user
     * @param \App\Models\Wallet $wallet
     *
     * @return mixed
     */
    public function update(User $user, Wallet $wallet)
    {
        return (int) $wallet->user_id === $user->id;
    }
}
