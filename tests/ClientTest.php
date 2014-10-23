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
     * All infos (login, userAccountKey) should be set first.
     */
    public function testLogInUsesRequester()
    {
        $requesterMock = $this->getMock('Requester', [
            'getSigningKey',
            'setUrl',
            'setPostData'
            ]
        );
        
        $requesterMock->expects($this->once())
            ->method('getSigningKey');

        $requesterMock->method('setUrl')
            ->will($this->returnSelf());

        $requesterMock->method('setPostData')
            ->will($this->returnSelf());

        $client = new Client("FAKE KEY", "FAKE SECRET KEY");

        $client->setUserCredentials("Login", "Fake user account key");
        $client->setRequester($requesterMock);

        $client->logIn();
    }

    /**
     * Ensure that login returns false when no credentials provided.
     */
    public function testLoginReturnsFalseWhenNoCredentials()
    {
        $requesterMock = $this->getMock('Requester', [
            'getSigningKey',
            'setUrl',
            'setPostData'
            ]
        );

        $requesterMock->method('setUrl')
            ->will($this->returnSelf());

        $requesterMock->method('setPostData')
            ->will($this->returnSelf());

        $client = new Client('FAKE KEY', 'FAKE SECRET KEY');
        $client->setRequester($requesterMock);

        $loginResult = $client->logIn();

        $this->assertFalse($loginResult);
    }

}
