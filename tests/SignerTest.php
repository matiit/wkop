<?php

namespace Wkop\Tests;

use Wkop\Signer;

/**
 * @covers Wkop\Signer
 */
class SignerTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneratingSigKeyBasicRequest()
    {
        $signer = new Signer('abcdefgh', 'MNOPQRST');
        $signer
            ->setUrl('http://a.wykop.pl/entries/add/appkey/abcdefgh/userkey/klucz_zalogowanego_użytkownika/')
            ->setPostData([
                'embed' => 'http://serwer/plik.jpg',
                'body' => 'przykładowy komentarz',
                ]);

        $this->assertEquals($signer->getSigningKey(), 'c1048ea53bdf3d60383b033c5d97f8c1');
    }

    public function testGeneratingSigKeyWithBiggerPostRequest()
    {
        $signer = new Signer('abcdefgh', 'MNOPQRST');
        $signer
            ->setUrl('http://a.wykop.pl/entries/add/appkey/abcdefgh/userkey/klucz_zalogowanego_użytkownika/')
            ->setPostData([
                'embed' => 'http://serwer/plik.jpg',
                'body' => 'przykładowy komentarz',
                'd' => 'z',
                'a' => 'c',
                'z' => 'z',
                ]);

        $this->assertEquals($signer->getSigningKey(), '7b21d329ed5a4ce5e741bcc794975a54');
    }

    public function testGeneratingSigKeyWithoutPostRequest()
    {
        $signer = new Signer('abcdefgh', 'MNOPQRST');
        $signer
            ->setUrl('http://a.wykop.pl/entries/add/appkey/abcdefgh/userkey/klucz_zalogowanego_użytkownika/');

        $this->assertEquals($signer->getSigningKey(), '80d255965eff5bd36a7385bfcf14d0c2');
    }

    /**
     * @expectedException \Wkop\Exceptions\UrlMissingException
     */
    public function testExpectingExceptionWithoutUrlProvided()
    {
        $signer = new Signer('abcdefgh', 'MNOPQRST');

        $signer->getSigningKey();
    }

    /**
     * @expectedException \Wkop\Exceptions\UrlMissingException
     */
    public function testResetsAfterGetKey()
    {
        $signer = new Signer('a', 'b');
        $signer
            ->setUrl('http://a.wykop.pl');

        $signer->getSigningKey();

        $signer->getSigningKey();
    }
}
