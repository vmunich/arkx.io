<?php

namespace App\Repositories;

use App\Models\Report;
use Illuminate\Support\Carbon;

class ReportRepository
{
    /**
     * Perform a basic disbursement search.
     *
     * @param \Illuminate\Database\Eloquent\Collection $disbursements
     * @param string|int                               $term
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($term)
    {
        return Report::where(function ($query) use ($term) {
            if (is_numeric($term)) {
                $query->orWhere('amount', $term * 1e8);
                $query->orWhere('fees', $term * 1e8);
            } else {
                $date = Carbon::parse($term);

                $query->whereBetween('date', [
                    $date->copy()->startOfDay(),
                    $date->copy()->endOfDay(),
                ]);
            }
        });
    }
}
