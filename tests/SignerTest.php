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
            ->setUrl('https://a.wykop.pl/entries/add/appkey/abcdefgh/userkey/klucz_zalogowanego_użytkownika/')
            ->setPostData([
                'embed' => 'http://serwer/plik.jpg',
                'body' => 'przykładowy komentarz',
                ]);

        $this->assertEquals($signer->getSigningKey(), '29a7d686a55373358cc6c9220217556a');
    }

    public function testGeneratingSigKeyWithBiggerPostRequest()
    {
        $signer = new Signer('abcdefgh', 'MNOPQRST');
        $signer
            ->setUrl('https://a.wykop.pl/entries/add/appkey/abcdefgh/userkey/klucz_zalogowanego_użytkownika/')
            ->setPostData([
                'embed' => 'http://serwer/plik.jpg',
                'body' => 'przykładowy komentarz',
                'd' => 'z',
                'a' => 'c',
                'z' => 'z',
                ]);

        $this->assertEquals($signer->getSigningKey(), 'd62c51da69f01c15d4c0b9eae663f082');
    }

    public function testGeneratingSigKeyWithoutPostRequest()
    {
        $signer = new Signer('abcdefgh', 'MNOPQRST');
        $signer
            ->setUrl('https://a.wykop.pl/entries/add/appkey/abcdefgh/userkey/klucz_zalogowanego_użytkownika/');

        $this->assertEquals($signer->getSigningKey(), 'bb512372d34497c6bc6def07a48a4900');
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
            ->setUrl('https://a.wykop.pl');

        $signer->getSigningKey();

        $signer->getSigningKey();
    }
}
