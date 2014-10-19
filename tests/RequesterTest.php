<?php

namespace Wkop\Tests;

use Wkop\Requester;

/**
 * @covers Wkop\Requester
 */
class RequesterTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneratingSigKeyBasicRequest()
    {
        $requester = new Requester('abcdefgh', 'MNOPQRST');
        $requester
            ->setUrl('http://a.wykop.pl/entries/add/appkey/abcdefgh/userkey/klucz_zalogowanego_użytkownika/')
            ->setPostData([
                'embed' => 'http://serwer/plik.jpg',
                'body' => 'przykładowy komentarz',
                ]);

        $this->assertEquals($requester->getSigningKey(), 'c1048ea53bdf3d60383b033c5d97f8c1');
    }

    public function testGeneratingSigKeyWithBiggerPostRequest()
    {
        $requester = new Requester('abcdefgh', 'MNOPQRST');
        $requester
            ->setUrl('http://a.wykop.pl/entries/add/appkey/abcdefgh/userkey/klucz_zalogowanego_użytkownika/')
            ->setPostData([
                'embed' => 'http://serwer/plik.jpg',
                'body' => 'przykładowy komentarz',
                'd' => 'z',
                'a' => 'c',
                'z' => 'z',
                ]);

        $this->assertEquals($requester->getSigningKey(), '7b21d329ed5a4ce5e741bcc794975a54');
    }

    public function testGeneratingSigKeyWithoutPostRequest()
    {
        $requester = new Requester('abcdefgh', 'MNOPQRST');
        $requester
            ->setUrl('http://a.wykop.pl/entries/add/appkey/abcdefgh/userkey/klucz_zalogowanego_użytkownika/');

        $this->assertEquals($requester->getSigningKey(), '80d255965eff5bd36a7385bfcf14d0c2');
    }

    /**
     * @expectedException Wkop\Exceptions\UrlMissingException
     */
    public function testExpectingExceptionWithoutUrlProvided()
    {
        $requester = new Requester('abcdefgh', 'MNOPQRST');

        $requester->getSigningKey();
    }
}
