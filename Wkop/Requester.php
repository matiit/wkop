<?php

namespace Wkop;

class Requester
{

    private $accountKey;


    private $secretKey;

    private $postData = null;

    private $url;

    public function __construct($accountKey, $secretKey, $url = null, $postData = null)
    {
        $this->accountKey = $accountKey;
        $this->secretKey = $secretKey;

        if (! is_null($url)) {
            $this->setUrl($url);
        }

        if (! is_null($postData)) {
            $this->setPostData($postData);
        }
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function setPostData($postData)
    {
        $this->postData = $postData;

        return $this;
    }

    public function getSigningKey()
    {
        if (! is_null($this->postData)) {
            ksort($this->postData);
        }

        return md5($this->secretKey . $this->url . $this->implodePostDataOrNull());
    }

    private function implodePostDataOrNull()
    {
        if (is_null($this->postData)) {
            return '';
        }

        return implode(',', array_values($this->postData));
    }
}
