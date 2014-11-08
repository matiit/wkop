<?php

namespace Wkop\Tests;

use GuzzleHttp\Client as GuzzleClient;
use Wkop\Client;
use Wkop\Signer;
use Wkop\Requester;

/**
 * @covers Wkop\Requester
 */
class RequesterTest extends \PHPUnit_Framework_TestCase
{
    public function testRequesterReturnsResponse()
    {
        $client = $this->getMockedClient();

        $requester = new Requester($client);

        $requester->get('profile/index', ['USERNAME']);

        // Figure out if good request is build.
    }

    private function getMockedClient()
    {
//        $signerMock = $this->getMockedSigner();
//
//        $guzzleClient = new GuzzleClient();

        $clientMock = $this->getMockBuilder('Wkop\Client')
            ->disableOriginalConstructor()
            ->getMock();

        return $clientMock;
    }

    private function getMockedSigner()
    {
        $mock = $this->getMock('Signer', [
                'getSigningKey',
                'setUrl',
                'setPostData'
            ]
        );

        $mock->method('setUrl')
            ->will($this->returnSelf());

        $mock->method('setPostData')
            ->will($this->returnSelf());

        return $mock;
    }
}
