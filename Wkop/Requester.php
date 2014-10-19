<?php

namespace Wkop;

class Requester
{

    private $accountKey;

    private $userKey;

    private $postData;

    private $url;

    public function __construct($accountKey, $userKey, $url = null, $postData = null)
    {
        $this->accountKey = $accountKey;
        $this->userKey = $userKey;

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
        return "c1048ea53bdf3d60383b033c5d97f8c1";
    }
}
