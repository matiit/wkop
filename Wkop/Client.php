<?php

namespace Wkop;

class Client
{

    /**
    * Application account key.
    *
    * @var string $appKey
    */
    private $appKey;

    /**
     * User key.
     * It is returned by server when singing in.
     *
     * @var string $userKey
     */
    private $userKey;

    /**
     * Secret key.
     *
     * @var string $secretKey
     */
    private $secretKey;

    /**
     * Http client used by this class.
     *
     * @var \GuzzleHttp\Client $httpClient
     */
    private $httpClient;

    public function __construct($accountKey, $secretKey)
    {
        $this->accountKey = $accountKey;
        $this->secretKey = $secretKey;

        $this->httpClient = new \GuzzleHttp\Client;
    }
}
