<?php

namespace App\Models;

use App\Models\Concerns\HasSiblings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasSiblings;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'count', 'amount', 'fees'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date'];

    /**
     * A report has many disbursements.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function disbursements(): Builder
    {
        return Disbursement::whereBetween('signed_at', [
            $this->date->startOfDay(),
            $this->date->endOfDay(),
        ]);
    }

    /**
     * Get a formatted amount of the arktoshi.
     *
     * @return string
     */
    public function getFormattedAmountAttribute(): string
    {
        return format_arktoshi($this->amount);
    }

    /**
     * Get a formatted amount of the arktoshi.
     *
     * @return string
     */
    public function getFormattedFeesAttribute(): string
    {
        return format_arktoshi($this->fees);
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->date->format('Y-m-d');
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->formatted_date;
    }
}
