<?php

namespace App\Models;

use App\Models\Concerns\HasSiblings;
use Illuminate\Database\Eloquent\Model;
use Parsedown;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Announcement extends Model
{
    use HasSlug, HasSiblings;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'body'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['parsed_body'];

    /**
     * Get the number of the day the announcement was created.
     *
     * @return string
     */
    public function getDayAttribute(): string
    {
        return $this->created_at->format('d');
    }

    /**
     * Get the name of the month the announcement was created.
     *
     * @return string
     */
    public function getMonthAttribute(): string
    {
        return $this->created_at->format('M');
    }

    /**
     * Check if the announcement was created recently.
     *
     * @return bool
     */
    public function getIsRecentAttribute(): bool
    {
        return $this->created_at->diffInDays() <= 3;
    }

    /**
     * Get the parsed body of the announcement.
     *
     * @return string
     */
    public function getParsedBodyAttribute()
    {
        return (new Parsedown())->text(htmlspecialchars($this->attributes['body']));
    }

    /**
     * Get the options for generating the slug.
     *
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
