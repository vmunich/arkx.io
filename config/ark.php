<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Relay
    |--------------------------------------------------------------------------
    |
    | Here you may specify which relay should be used to poll blocks, voters,
    | wallets and transactions and also broadcast transactions after signing.
    |
    */

    'relay' => env('ARK_RELAY', 'http://127.0.0.1:4003/api/v2/'),

    /*
    |--------------------------------------------------------------------------
    | Delegate
    |--------------------------------------------------------------------------
    |
    | Here you may specify the data of the forging delegate which will be
    | used to poll blocks, voters, transactions and use as a base for all data.
    |
    */

    'delegate' => [
        'username'  => env('ARK_DELEGATE_USERNAME'),
        'address'   => env('ARK_DELEGATE_ADDRESS'),
        'publicKey' => env('ARK_DELEGATE_PUBLIC_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Reward Share
    |--------------------------------------------------------------------------
    |
    | Here you may specify if you wish to share forged fees with your voters,
    | the percentage you share and what message the vendor field should be.
    |
    */

    'share' => [
        /*
        |--------------------------------------------------------------------------
        | Enabled
        |--------------------------------------------------------------------------
        |
        | Here you may specify if reward sharing is enabled. This can be useful
        | to be set to false if you are doing a migration of some sorts.
        |
        */

        'enabled' => env('ARK_SHARE_ENABLED', true),

        /*
        |--------------------------------------------------------------------------
        | Fees
        |--------------------------------------------------------------------------
        |
        | Here you may specify if forged fees should be shared or only the
        | block rewards which are 2 ARK by default per block.
        |
        */

        'fees' => env('ARK_SHARE_FEES', false),

        /*
        |--------------------------------------------------------------------------
        | Percentage
        |--------------------------------------------------------------------------
        |
        | Here you may specify which percentage of a block reward should be
        | shared with voters after receiving a new forged block.
        |
        */

        'percentage' => env('ARK_SHARE_PERCENTAGE', 80),

        /*
        |--------------------------------------------------------------------------
        | Threshold
        |--------------------------------------------------------------------------
        |
        | Here you may specify which threshold has to be met in order for a voter
        | to be eligible for a payout. This value should be adjusted as the price
        | of ARK goes up to avoid wasting ARK on fees.
        |
        */

        'threshold' => env('ARK_SHARE_THRESHOLD', 0.1),

        /*
        |--------------------------------------------------------------------------
        | Vendor Field
        |--------------------------------------------------------------------------
        |
        | Here you may specify the vendor field that should be used when
        | disbursements get created and signed which will indicate the purpose
        | of the transactions the voters after receiving the transactions.
        |
        */

        'vendorField' => env('ARK_SHARE_VENDOR_FIELD'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Trustee Passphrase
    |--------------------------------------------------------------------------
    |
    | Here you may specify the passphrases of the wallet that will be used to
    | sign transactions. Make sure that you encrypt passphrase!
    |
    */

    'trustee' => [
        'passphrase'       => env('ARK_TRUSTEE_PASSPHRASE'),
        'secondPassphrase' => env('ARK_TRUSTEE_SECOND_PASSPHRASE'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Broadcast
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of peers a transaction should be
    | broadcasted to and also the chunk size which can vary per node.
    |
    | The number of confirmations is the number of blocks that need to be
    | forged before a transaction gets ignored for the next broadcasting run.
    |
    */

    'broadcast' => [
        'peers'         => env('ARK_BROADCAST_PEERS', 10),
        'chunkSize'     => env('ARK_BROADCAST_CHUNK_SIZE', 40),
        'confirmations' => env('ARK_BROADCAST_CONFIRMATIONS', 51),
    ],

    /*
    |--------------------------------------------------------------------------
    | Wallets
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the wallets below you wish to handle
    | different for different scenarios like whitelisting and blacklisting
    | which will result in inclusion or exlusion for certain tasks.
    |
    */

    'wallets' => [
        /*
        |--------------------------------------------------------------------------
        | Wallet Whitelist
        |--------------------------------------------------------------------------
        |
        | Here you may specify which of the wallets below you wish to include
        | from public listings, calculations and all wallet operations. This only
        | impacts wallets that would normally be banned.
        |
        */

        'whitelist' => [],

        /*
        |--------------------------------------------------------------------------
        | Wallet Blacklist
        |--------------------------------------------------------------------------
        |
        | Here you may specify which of the wallets below you wish to exclude
        | from public listings, calculations and all wallet operations. Usually
        | this should only be your delegate and private wallets.
        |
        */

        'blacklist' => [
            env('ARK_DELEGATE_ADDRESS'),
            env('ARK_PRIVATE_ADDRESS'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Jobs
    |--------------------------------------------------------------------------
    |
    | Here you may specify jobs which will send specific shares out. This
    | should mainly be used for your private share as a delegate and things
    | like donations or maintenance cost to different wallets.
    |
    */

    'jobs' => [
        [
            'enabled'         => false,
            'address'         => env('ARK_PRIVATE_ADDRESS'),
            'vendorField'     => env('ARK_PRIVATE_VENDOR_FIELD'),
            'sharePercentage' => env('ARK_PRIVATE_SHARE_PERCENTAGE', 20),
        ],
    ],

];
