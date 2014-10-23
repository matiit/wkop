<?php

namespace Wkop\Tests;

use Wkop\Client;
use Wkop\Requester;
use Wkop\Exceptions\WykopAPIKeyMissingException;

/**
 * @covers Wkop\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
    * Test initializing Client class
    */
    public function canInit()
    {
        $client = new Client("FAKE KEY", "FAKE SECRET KEY");
        $this->assertInstanceOf('Wkop\Client', $client);
    }

    /**
     * Ensure Client will use requester to login
     */
    public function testLogInUsesRequester()
    {
        $requesterMock = $this->getMock('Requester', ['getSigningKey']);
        $requesterMock->expects($this->once())
            ->method('getSigningKey');

        $client = new Client("FAKE KEY", "FAKE SECRET KEY");
        $client->setRequester($requesterMock);

        $client->login('fake user account key');
    }
}
