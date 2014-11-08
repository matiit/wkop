<?php

namespace Wkop;

class Requester
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client - Client with set up credentials!
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
