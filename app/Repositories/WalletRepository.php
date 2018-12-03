<?php

namespace App\Repositories;

use App\Models\Wallet;

class WalletRepository
{
    /**
     * Perform a basic wallet search.
     *
     * @param string|int $term
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function searchAll($term)
    {
        return $this->search(new Wallet(), $term);
    }

    /**
     * Perform a basic wallet search on all wallets of a user.
     *
     * @param string|int $term
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function searchByUser($term)
    {
        return $this->search(auth()->user()->wallets(), $term);
    }

    /**
     * Perform a basic wallet search.
     *
     * @param \Illuminate\Database\Eloquent\Collection $wallets
     * @param string                                   $term
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function search($wallets, $term)
    {
        return $wallets->notBanned()->where(function ($query) use ($term) {
            $query->where('address', 'like', '%'.$term.'%');

            if (is_numeric($term)) {
                $query->orWhere('balance', $term * 1e8);
            }
        });
    }
}
