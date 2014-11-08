<?php

namespace Wkop;

class Factory
{
    public static function get($appKey, $secretKey)
    {
        $signer = new Signer($appKey, $secretKey);
        return new Client($appKey, $secretKey, $signer);
    }
}
