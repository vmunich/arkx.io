<?php

namespace App\Repositories;

use App\Models\Disbursement;

class DisbursementRepository
{
    /**
     * Perform a basic disbursement search.
     *
     * @param string|int $term
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function searchAll($term)
    {
        return $this->search(new Disbursement(), $term);
    }

    /**
     * Perform a basic disbursement search on all disbursements of a user.
     *
     * @param string|int $term
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function searchByUser($term)
    {
        return $this->search(auth()->user()->disbursements(), $term);
    }

    /**
     * Perform a basic disbursement search.
     *
     * @param \Illuminate\Database\Eloquent\Collection $disbursements
     * @param string|int                               $term
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function search($disbursements, $term)
    {
        return $disbursements->where(function ($query) use ($term) {
            $query
                ->where('transaction_id', 'like', '%'.$term.'%')
                ->orWhere('purpose', 'like', '%'.$term.'%');

            if (is_numeric($term)) {
                $query->orWhere('amount', $term * 1e8);
            }
        });
    }
}
