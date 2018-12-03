<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\SchemalessAttributes;

trait HasSchemalessAttributes
{
    /**
     * Get the extra attributes.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getExtraAttributesAttribute(): SchemalessAttributes
    {
        return SchemalessAttributes::createForModel($this, 'extra_attributes');
    }

    /**
     * Scope a query to include extra attributes.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithExtraAttributes(): Builder
    {
        return SchemalessAttributes::scopeWithSchemalessAttributes('extra_attributes');
    }
}
