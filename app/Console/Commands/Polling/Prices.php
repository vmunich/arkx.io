<?php

namespace App\Console\Commands\Polling;

use App\Services\CryptoCompare;
use Illuminate\Console\Command;

class Prices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:poll:prices';

    /**
     * Execute the console command.
     */
    public function handle(CryptoCompare $client)
    {
        $response = $client->price(['BTC', 'USD', 'EUR']);

        // Bitcoin
        if (cache('prices.btc') !== $response['BTC']) {
            cache()->forget('prices.btc.previous');
            cache()->forever('prices.btc.previous', cache('prices.btc'));
        }

        cache()->put('prices.btc', $response['BTC'], 60);

        // US Dollar
        if (cache('prices.usd') !== $response['USD']) {
            cache()->forget('prices.usd.previous');
            cache()->forever('prices.usd.previous', cache('prices.usd'));
        }

        cache()->put('prices.usd', $response['USD'], 60);

        // Euro
        if (cache('prices.eur') !== $response['EUR']) {
            cache()->forget('prices.eur.previous');
            cache()->forever('prices.eur.previous', cache('prices.eur'));
        }

        cache()->put('prices.eur', $response['EUR'], 60);
    }
}
