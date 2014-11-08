<?php

namespace Wkop;

use Wkop\Client;
use GuzzleHttp\Client as GuzzleClient;

class Factory
{
    public static function get($appKey, $secretKey)
    {
        $signer = new Signer($appKey, $secretKey);
        $client = new Client($appKey, $secretKey, new GuzzleClient());

        $client->setSigner($signer);
        return $client;
    }
}
