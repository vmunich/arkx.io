<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Perform a basic wallet search.
     *
     * @param string|int $term
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($term)
    {
        return User::where(function ($query) use ($term) {
            $query
                ->where('email', 'like', '%'.$term.'%')
                ->orWhere('authy_id', 'like', '%'.$term.'%');
        });
    }
}
