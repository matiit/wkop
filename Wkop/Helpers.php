<?php

namespace Wkop;

class Helpers
{
    /**
     * @param $redirectUrl
     * @param $appKey
     * @param $appSecret
     *
     * @return string 
     */
    public static function getConnectUrl($redirectUrl, $appKey, $appSecret)
    {
        $redirectUrlEncoded = urlencode(base64_encode($redirectUrl));
        $secure = md5($appSecret . $redirectUrl);

        return "http://a.wykop.pl/user/connect/appkey," . $appKey . ",redirect," . $redirectUrlEncoded . ",secure," . $secure;
    }
}
