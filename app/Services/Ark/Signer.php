<?php

namespace App\Services\Ark;

use ArkEcosystem\Crypto\Transactions\Builder\Transfer;

class Signer
{
    /**
     * Sign a transfer transaction.
     *
     * @param string $recipient
     * @param int    $amount
     * @param string $purpose
     *
     * @return \ArkEcosystem\Crypto\Transactions\Builder\Transfer
     */
    public function sign(string $recipient, int $amount, string $purpose): Transfer
    {
        $transfer = Transfer::new()
            ->recipient($recipient)
            ->amount($amount)
            ->vendorField($purpose)
            ->sign(decrypt(config('ark.trustee.passphrase')));

        if ($secondPassphrase = config('ark.trustee.secondPassphrase')) {
            $transfer = $transfer->secondSign(decrypt($secondPassphrase));
        }

        return $transfer;
    }
}
