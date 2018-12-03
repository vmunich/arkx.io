<?php

return [

    'ark:maintain:wallets'                      => env('APP_HEARTBEAT'),
    'ark:maintain:voters'                       => env('APP_HEARTBEAT'),
    'ark:poll:prices'                           => env('APP_HEARTBEAT'),
    'ark:poll:delegate'                         => env('APP_HEARTBEAT'),
    'ark:poll:voters'                           => env('APP_HEARTBEAT'),
    'ark:poll:blocks'                           => env('APP_HEARTBEAT'),
    'ark:poll:transactions'                     => env('APP_HEARTBEAT'),
    'ark:disburse:jobs'                         => env('APP_HEARTBEAT'),
    'ark:disburse:voters --frequency=daily'     => env('APP_HEARTBEAT'),
    'ark:disburse:voters --frequency=weekly'    => env('APP_HEARTBEAT'),
    'ark:disburse:voters --frequency=monthly'   => env('APP_HEARTBEAT'),
    'ark:disburse:voters --frequency=quarterly' => env('APP_HEARTBEAT'),
    'ark:disburse:voters --frequency=yearly'    => env('APP_HEARTBEAT'),
    'ark:broadcast:disbursements --unconfirmed' => env('APP_HEARTBEAT'),
    'ark:poll:confirmations'                    => env('APP_HEARTBEAT'),
    'ark:generate:reports'                      => env('APP_HEARTBEAT'),
    'backup:clean'                              => env('APP_HEARTBEAT'),
    'backup:run'                                => env('APP_HEARTBEAT'),
    'backup:monitor'                            => env('APP_HEARTBEAT'),
    'telescope:prune'                           => env('APP_HEARTBEAT'),

];
