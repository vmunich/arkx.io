<?php

namespace App\Models;

use App\Models\Concerns\CanBeBanned;
use App\Models\Concerns\CanBeVerified;
use App\Models\Concerns\HasSchemalessAttributes;
use App\Notifications\WalletVerified;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

class Wallet extends Authenticatable
{
    use CanBeBanned, CanBeVerified, HasSchemalessAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'public_key', 'balance', 'earnings',
        'verification_token', 'claimed_at', 'verified_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['claimed_at', 'verified_at', 'banned_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['extra_attributes' => 'array'];

    /**
     * A wallet is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A wallet owns many disbursements.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disbursements(): HasMany
    {
        return $this->hasMany(Disbursement::class);
    }

    /**
     * Get a wallet by the given address.
     *
     * @return \App\Models\Wallet
     */
    public static function findByAddress(string $value): self
    {
        return static::whereAddress($value)->firstOrFail();
    }

    /**
     * Get the latest disbursement of the wallet.
     *
     * @return \App\Models\Disbursement
     */
    public function latestDisbursement(): Disbursement
    {
        return $this->disbursements()->latest()->first();
    }

    /**
     * Get the total balance of the wallet. Sum of balance and earnings.
     *
     * @return int
     */
    public function getStakeAttribute(): int
    {
        return $this->balance + $this->earnings;
    }

    /**
     * Get the total earnings of the wallet.
     *
     * @return string
     */
    public function getTotalEarningsAttribute(): string
    {
        return $this->disbursements()->sum('amount');
    }

    /**
     * Get a string representation of the total earnings.
     *
     * @return string
     */
    public function getFormattedStakeAttribute(): string
    {
        return format_arktoshi($this->stake);
    }

    /**
     * Get a string representation of the total earnings.
     *
     * @return string
     */
    public function getFormattedTotalEarningsAttribute(): string
    {
        return format_arktoshi($this->total_earnings);
    }

    /**
     * Get a string representation of the earnings.
     *
     * @return string
     */
    public function getFormattedEarningsAttribute(): string
    {
        return format_arktoshi($this->earnings);
    }

    /**
     * Get a string representation of the balance.
     *
     * @return string
     */
    public function getFormattedBalanceAttribute(): string
    {
        return format_arktoshi($this->balance);
    }

    /**
     * Get the share frequency of the wallet.
     *
     * @return string
     */
    public function getFrequencyAttribute(): string
    {
        return $this->extra_attributes->get('settings.share.frequency');
    }

    /**
     * Get the share percentage of the wallet.
     *
     * @return int
     */
    public function getPercentageAttribute(): int
    {
        return $this->extra_attributes->get('settings.share.percentage');
    }

    /**
     * Check if the wallet is private.
     *
     * @return bool
     */
    public function getIsPrivateAttribute(): bool
    {
        return in_array($this->address, config('ark.wallets.blacklist'), true);
    }

    /**
     * Check if the wallet is pending.
     *
     * @return bool
     */
    public function getIsPendingAttribute(): bool
    {
        return 1 !== $this->user_id && $this->claimed_at;
    }

    /**
     * Check if the wallet has been claimed.
     *
     * @return bool
     */
    public function getIsClaimedAttribute(): bool
    {
        return 1 !== $this->user_id && $this->verified_at;
    }

    /**
     * Scope a query to only include wallets with the given frequency.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFrequency(Builder $query, string $value): Builder
    {
        return $query->where('extra_attributes->settings->share->frequency', $value);
    }

    /**
     * Scope a query to only include eligible wallets.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEligible(Builder $query): Builder
    {
        return $query
            ->notBanned()
            ->whereNotIn('address', config('ark.wallets.blacklist'));
    }

    /**
     * Scope a query to only include verified wallets.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->notBanned()->verified();
    }

    /**
     * Scope a query to only include claimed wallets.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClaimed(Builder $query): Builder
    {
        return $query
            ->notBanned()
            ->whereNotNull('claimed_at')
            ->whereNotNull('verified_at');
    }

    /**
     * Scope a query to only include unclaimed wallets.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnclaimed(Builder $query): Builder
    {
        return $query
            ->notBanned()
            ->whereNull('claimed_at')
            ->whereNull('verified_at');
    }

    /**
     * Scope a query to only include lost pending.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending(Builder $query): Builder
    {
        return $query
            ->notBanned()
            ->whereNotNull('claimed_at')
            ->whereNull('verified_at');
    }

    /**
     * Scope a query to only include lost wallets.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLost(Builder $query): Builder
    {
        return $query
            ->notBanned()
            ->orderBy('balance', 'DESC')
            ->where('user_id', 1)
            ->whereNull('verified_at');
    }

    /**
     * Check if the claim session has expired.
     *
     * @return bool
     */
    public function claimHasExpired(): bool
    {
        if (!$this->claimed_at && !$this->verified_at) {
            return true;
        }

        if ($this->verified_at) {
            return true;
        }

        return $this->claimed_at && $this->claimed_at->diffInMinutes() >= 5;
    }

    /**
     * Activate the wallet.
     */
    public function activate(): void
    {
        $this->forceFill([
            'verification_token' => null,
            'verified_at'        => Carbon::now(),
        ])->save();

        $this->user->notify(new WalletVerified($this));
    }

    /**
     * Reset the wallet.
     */
    public function reset(): void
    {
        $this->forceFill([
            'user_id'            => 1,
            'claimed_at'         => null,
            'verification_token' => null,
        ])->save();
    }

    /**
     * Determine if the wallet should be paid.
     */
    public function shouldBePaid(): bool
    {
        if (in_array($this->address, config('ark.wallets.blacklist'), true)) {
            return false;
        }

        return $this->earnings >= (config('ark.share.threshold') * 1e8);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'address';
    }

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function (Model $wallet) {
            $wallet->extra_attributes->set('settings.share.frequency', 'daily');
            $wallet->extra_attributes->set('settings.share.percentage', config('ark.share.percentage'));
            $wallet->save();
        });

        static::addGlobalScope('wealth', function (Builder $builder) {
            $builder->orderBy('balance', 'DESC');
        });
    }
}
