<?php

namespace App\Repositories;

use App\Models\Block;

class BlockRepository
{
    /**
     * Perform a basic block search.
     *
     * @param string|int $term
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($term)
    {
        return Block::where(function ($query) use ($term) {
            $query
                ->where('block_id', $term)
                ->orWhere('forged_at', 'like', '%'.$term.'%');

            if (is_numeric($term)) {
                $query->orWhere('height', $term);
                $query->orWhere('reward', $term * 1e8);
            }
        });
    }
}
