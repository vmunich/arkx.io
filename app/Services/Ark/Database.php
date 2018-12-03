<?php

namespace App\Services\Ark;

use ArkX\Eloquent\Models\Transaction;
use ArkX\Eloquent\Models\Wallet;
use Illuminate\Support\Collection;

class Database
{
    /**
     * Get the wallet for the given id.
     *
     * @param string $address
     *
     * @return Wallet
     */
    public function wallet(string $address): Wallet
    {
        return Wallet::findByAddress($address);
    }

    /**
     * Get the transaction for the given id.
     *
     * @param string $id
     *
     * @return Transaction
     */
    public function transaction(string $id): Transaction
    {
        return Transaction::findById($id);
    }

    /**
     * Get voters for the configured delegate.
     *
     * @return Collection
     */
    public function voters(): Collection
    {
        return Wallet::vote(config('ark.delegate.publicKey'))->get();
    }

    /**
     * Get information about the configured delegate.
     *
     * @return Wallet
     */
    public function delegate(): Wallet
    {
        return Wallet::findByUsername(config('ark.delegate.username'));
    }
}
