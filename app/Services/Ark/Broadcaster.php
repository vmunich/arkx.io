<?php

namespace App\Services\Ark;

use Exception;

class Broadcaster
{
    /**
     * The Ark client.
     *
     * @var \App\Services\Ark\Client
     */
    private $client;

    /**
     * Create a new Broadcaster instance.
     *
     * @param \App\Services\Ark\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Broadcast the given transactions to the main peer.
     *
     * @param array $transactions
     */
    public function broadcast(array $transactions): void
    {
        $this->client->broadcast(config('ark.relay'), $transactions);
    }

    /**
     * Broadcast the given transactions to many peers.
     *
     * @param array $transactions
     */
    public function spread(array $transactions): void
    {
        $peers = $this->client->peers()->take(config('ark.broadcast.peers'));

        $peers->each(function ($peer) use ($transactions) {
            try {
                $this->client->broadcast(
                    sprintf('http://%s:%s', $peer['ip'], $peer['port']),
                    $transactions
                );
            } catch (Exception $e) {
                // ...
            }
        });
    }
}
