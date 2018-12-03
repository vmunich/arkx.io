<?php

namespace App\Services;

use GrahamCampbell\GuzzleFactory\GuzzleFactory;

class CryptoCompare
{
    /**
     * The Guzzle client.
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Create a new Client instance.
     */
    public function __construct()
    {
        $this->client = GuzzleFactory::make([
            'base_uri' => 'https://min-api.cryptocompare.com/',
        ]);
    }

    /**
     * Get the wallet for the given id.
     *
     * @param array $currencies
     *
     * @return array
     */
    public function price(array $currencies): array
    {
        return $this->get('data/price', [
            'fsym'  => 'ARK',
            'tsyms' => implode(',', $currencies),
        ]);
    }

    /**
     * Send a HTTP GET request.
     *
     * @param string $path
     * @param array  $query
     *
     * @return array
     */
    public function get(string $path, array $query): array
    {
        $response = $this->client->get($path, compact('query'));

        return json_decode($response->getBody(), true);
    }
}
