<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can perform all actions.
     *
     * @param \App\Models\User $user
     * @param mixed            $ability
     *
     * @return mixed
     */
    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }
}
