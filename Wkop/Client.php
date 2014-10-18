<?php

namespace Wkop;

class Client
{

    /**
    * Application account key.
    *
    * @var string $key
    */
    private $accountKey;

    public function __construct($accountKey)
    {
        $this->accountKey = $accountKey;
    }
}
