<?php

namespace App\Services\Ark;

use GrahamCampbell\GuzzleFactory\GuzzleFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class Client
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
            'base_uri' => config('ark.relay'),
        ]);
    }

    /**
     * Get a list of well performing peers.
     *
     * @return \Illuminate\Support\Collection
     */
    public function peers(): Collection
    {
        $peers = $this->get('peers')['data'];
        $peers = collect($peers)->sortByDesc('height')->sortBy('latency');

        return $peers->filter(function ($peer) {
            return array_get($peer, 'latency', 1000) <= 300;
        })->reject(function ($peer) {
            return 200 !== array_get($peer, 'status', 500);
        });
    }

    /**
     * [broadcast description].
     *
     * @param string $uri
     * @param array  $transactions
     *
     * @return void
     */
    public function broadcast(string $uri, array $transactions): array
    {
        return $this->post('transactions', compact('transactions'));
    }

    /**
     * Send a HTTP GET request.
     *
     * @param string $path
     * @param array  $query
     *
     * @return array
     */
    public function get(string $path, array $query = []): array
    {
        try {
            $response = $this->client->get($path, compact('query'));

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            $response = json_decode($e->getResponse()->getBody());

            Log::critical(json_encode($response, JSON_PRETTY_PRINT));

            return [];
        }
    }

    /**
     * Send a HTTP POST request.
     *
     * @param string $path
     * @param array  $json
     *
     * @return array
     */
    public function post(string $path, array $json): array
    {
        try {
            $response = $this->client->post($path, compact('json'));

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            $response = json_decode($e->getResponse()->getBody());

            Log::critical(json_encode($response, JSON_PRETTY_PRINT));

            return [];
        }
    }
}
