<?php

namespace App\Models;

use App\Events\DisbursementCreated;
use App\Models\Concerns\HasSiblings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disbursement extends Model
{
    use HasSiblings;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['transaction_id', 'amount', 'purpose', 'signed_at', 'transaction', 'confirmations'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['signed_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['transaction' => 'array'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => DisbursementCreated::class,
    ];

    /**
     * A disbursement is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->wallet->user();
    }

    /**
     * A disbursement is owned by a wallet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    /**
     * Get a disbursement by the given transaction id.
     *
     * @return \App\Models\Disbursement
     */
    public static function findByTransactionId(string $value): self
    {
        return static::whereTransactionId($value)->firstOrFail();
    }

    /**
     * Get a formatted amount of the arktoshi.
     *
     * @return string
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount / 1e8, 8);
    }

    /**
     * Get the previous disbursement.
     *
     * @return null|\Illuminate\Database\Eloquent\Model
     */
    public function previous(): ?Model
    {
        return $this
            ->user
            ->disbursements()
            ->where('disbursements.id', '<', $this->id)
            ->orderBy('disbursements.id', 'desc')
            ->first();
    }

    /**
     * Get the next disbursement.
     *
     * @return null|\Illuminate\Database\Eloquent\Model
     */
    public function next(): ?Model
    {
        return $this
            ->user
            ->disbursements()
            ->where('disbursements.id', '>', $this->id)
            ->orderBy('disbursements.id')
            ->first();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'transaction_id';
    }

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('signed', function (Builder $builder) {
            $builder->orderBy('signed_at', 'DESC');
        });
    }
}
