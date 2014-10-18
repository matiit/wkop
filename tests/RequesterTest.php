<?php

namespace Wkop\Tests;

use Wkop\Requester;

/**
 * @covers Wkop\Requester
 */
class RequesterTest extends \PHPUnit_Framework_TestCase
{
    public function testSignUpBasicRequest()
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
}
