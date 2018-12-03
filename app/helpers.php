<?php

use Illuminate\Support\Carbon;

/**
 * Divide the specified value by arktoshi and format it.
 *
 * @param int $value
 * @param int $decimals
 *
 * @return string
 */
function format_arktoshi(int $value, int $decimals = 8)
{
    return number_format($value / 1e8, $decimals);
}

/**
 * Transform a transfer into its generic representation.
 *
 * @param array $transaction
 *
 * @return array
 */
function standardise(array $transaction): array
{
    return array_only($transaction, [
        'type', 'amount', 'fee', 'recipientId', 'timestamp', 'vendorField',
        'senderPublicKey', 'signature', 'secondSignature', 'signSignature', 'id',
    ]);
}

/**
 * Make an Ark epoch human readable.
 *
 * @param int $value
 *
 * @return string
 */
function humanize_epoch(int $value)
{
    return Carbon::parse('2017-03-21T13:00:00.000Z')->addSeconds($value);
}
