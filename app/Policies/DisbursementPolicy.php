<?php

namespace App\Policies;

use App\Models\Disbursement;
use App\Models\User;

class DisbursementPolicy extends Policy
{
    /**
     * Determine whether the user can view the disbursement.
     *
     * @param \App\Models\User         $user
     * @param \App\Models\Disbursement $disbursement
     *
     * @return mixed
     */
    public function view(User $user, Disbursement $disbursement)
    {
        return (int) $disbursement->wallet->user_id === $user->id;
    }
}
