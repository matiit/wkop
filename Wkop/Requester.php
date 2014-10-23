<?php

namespace Wkop;

use Wkop\Exceptions\UrlMissingException;

class Requester
{

    /**
     * @var string $accountKey
     */
    private $accountKey;

    /**
     * @var string $secretKey
     */
    private $secretKey;

    /**
     * @var array $postData
     */
    private $postData = null;

    /**
     * @var string $url
     */
    private $url = null;

    /**
     * @param string $accountKey Wykop app key.
     * @param string $secretKey Wykop app secret key.
     * @param string $url Url.
     * @param array $postData Data meant to be send as POST.
     *
     * @return Requester
     */
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

        return $this;
    }

    /**
     * @param string $url
     *
     * @return Requester
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param array $postData
     *
     * @return Requester
     */
    public function setPostData($postData)
    {
        $this->postData = $postData;

        return $this;
    }

    /**
     * Get checksum to sing requests.
     *
     * @return string
     */
    public function getSigningKey()
    {
        if (is_null($this->url)) {
            throw new UrlMissingException;
        }

        $signingKey = $this->generateSigningKey();
        $this->reset();

        return $signingKey;
    }

    /**
     * Get imploded Post data.
     * Comma separated post values, sorted alphabetically by key.
     *
     * @return string
     */
    private function implodePostDataOrNull()
    {
        if (is_null($this->postData)) {
            return '';
        }

        return implode(',', array_values($this->postData));
    }

    /**
     * @return string
     */
    private function generateSigningKey()
    {
        if (! is_null($this->postData)) {
            ksort($this->postData);
        }

        return md5($this->secretKey . $this->url . $this->implodePostDataOrNull());
    }

    private function reset()
    {
        $this->postData = null;
        $this->url      = null;
    }
}
