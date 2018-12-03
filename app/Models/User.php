<?php

namespace App\Models;

use App\Models\Concerns\CanBeBanned;
use App\Models\Concerns\HasSchemalessAttributes;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmail, Notifiable;
    use CanBeBanned, HasRoles, HasSchemalessAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'api_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['banned_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['extra_attributes' => 'array'];

    /**
     * A user owns many wallets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * A user owns many disbursements through wallets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function disbursements(): HasManyThrough
    {
        return $this->hasManyThrough(Disbursement::class, Wallet::class);
    }

    /**
     * Get a user by the given e-mail address.
     *
     * @return \App\Models\User
     */
    public static function findByEmail(string $value): self
    {
        return static::whereEmail($value)->firstOrFail();
    }

    /**
     * Get the total sum of balance (vote power).
     *
     * @return float
     */
    public function getBalanceAttribute(): float
    {
        return $this->wallets->sum('balance');
    }

    /**
     * Get the total sum of earnings.
     *
     * @return float
     */
    public function getEarningsAttribute(): float
    {
        return $this->wallets->sum('earnings');
    }

    /**
     * Get the balance divided by arktoshi and formatted.
     *
     * @return string
     */
    public function getFormattedBalanceAttribute(): string
    {
        return format_arktoshi($this->balance);
    }

    /**
     * Get the earnings divided by arktoshi and formatted.
     *
     * @return string
     */
    public function getFormattedEarningsAttribute(): string
    {
        return format_arktoshi($this->earnings);
    }
}
