<?php

namespace App\Repositories;

use App\Models\Announcement;

class AnnouncementRepository
{
    /**
     * Perform a basic announcement search.
     *
     * @param string $term
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($term)
    {
        return Announcement::where(function ($query) use ($term) {
            $query
                ->where('title', 'like', '%'.$term.'%')
                ->orWhere('body', 'like', '%'.$term.'%');
        });
    }
}
