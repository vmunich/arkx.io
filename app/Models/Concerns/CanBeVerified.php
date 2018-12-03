<?php

namespace App\Models\Concerns;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait CanBeVerified
{
    /**
     * Verify the entity.
     *
     * @return bool
     */
    public function verify(): bool
    {
        return $this->forceFill(['verified_at' => Carbon::now()])->save();
    }

    /**
     * Unverify the entity.
     *
     * @return bool
     */
    public function unverify(): bool
    {
        return $this->forceFill(['verified_at' => null])->save();
    }

    /**
     * Check if the entity is verified.
     *
     * @return bool
     */
    public function getIsVerifiedAttribute(): bool
    {
        return !empty($this->verified_at);
    }

    /**
     * Scope a query to only include not verified entities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerified(Builder $query): Builder
    {
        return $query->whereNotNull('verified_at');
    }

    /**
     * Scope a query to only include unverified entities.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnverified(Builder $query): Builder
    {
        return $query->whereNull('verified_at');
    }
}
