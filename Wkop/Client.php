<?php

namespace Wkop;

use Requester;

class Client
{
    /**
     * Array of rights.
     *
     * @var array
     */
    private $rights;

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

    /**
     * Requester class.
     *
     * @var Requester $requester
     */
    private $requester;

    public function __construct($accountKey, $secretKey)
    {
        $this->accountKey = $accountKey;
        $this->secretKey = $secretKey;

        $this->httpClient = new \GuzzleHttp\Client;
    }

    public function setRequester($requester)
    {
        $this->requester = $requester;
    }

    public function logIn($userAccountKey)
    {
        return false;
    }
}
