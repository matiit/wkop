<?php

namespace Wkop\Tests;

use Wkop\Client;
use Wkop\Exceptions\WykopAPIKeyMissingException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Subscriber\Mock;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Stream\Stream;

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
        $client = new Client("FAKE KEY", "FAKE SECRET KEY", new GuzzleClient());
        $this->assertInstanceOf('Wkop\Client', $client);
    }

    /**
     * Ensure Client will use requester to login
     * All infos (login, userAccountKey) should be set first.
     */
    public function testLogInUsesRequester()
    {
        $signerMock = $this->getSignerMock();

        $signerMock->expects($this->once())
            ->method('getSigningKey');

        $client = new Client("FAKE KEY", "FAKE SECRET KEY", new GuzzleClient());

        $client->setUserCredentials("Login", "Fake user account key");
        $client->setSigner($signerMock);

        $client->logIn();
    }

    /**
     * Ensure that login returns false when no credentials provided.
     */
    public function testLoginReturnsFalseWhenNoCredentials()
    {
        $signerMock = $this->getSignerMock();

        $client = new Client('FAKE KEY', 'FAKE SECRET KEY', new GuzzleClient());
        $client->setSigner($signerMock);

        $loginResult = $client->logIn();

        $this->assertFalse($loginResult);
    }

    public function testCanCheckLoginStatusAfterLoggingIn()
    {
        $signerMock = $this->getSignerMock();

        $guzzleClient = new GuzzleClient();

        $wykopApiReturn = '{"login":"matiit","email":"fff:795551508","public_email":"","name":"","www":"","jabber":"","gg":"","city":"","about":"","author_group":1,"links_added":53,"links_published":4,"comments":748,"rank":2606,"followers":14,"following":6,"entries":277,"entries_comments":2513,"diggs":930,"buries":343,"groups":0,"related_links":8,"signup_date":"2007-11-25 20:16:34","avatar":"http:\/\/xJ.cdn02.imgwykop.pl\/c3397992\/matiit_JMq2ooDOk7,q60.jpg","avatar_big":"http:\/\/xJ.cdn02.imgwykop.pl\/c3397992\/matiit_JMq2ooDOk7,q150.jpg","avatar_med":"http:\/\/xJ.cdn02.imgwykop.pl\/c3397992\/matiit_JMq2ooDOk7,q48.jpg","avatar_lo":"http:\/\/xJ.cdn02.imgwykop.pl\/c3397992\/matiit_JMq2ooDOk7,q30.jpg","is_observed":null,"is_blocked":null,"sex":"male","url":"http:\/\/www.wykop.pl\/ludzie\/matiit\/","violation_url":null,"userkey":"3fQGm:eOj7n:kA6y:bh9cY:i0mf2:zzzzz"}';

        $wykopApiReturnStream = Stream::factory($wykopApiReturn);

        $wykopApiResponseMock = new Mock([
            new Response(200, [], $wykopApiReturnStream)
        ]);

        $guzzleClient->getEmitter()->attach($wykopApiResponseMock);

        $client = new Client('FAKE KEY', 'FAKE SECRET KEY', $guzzleClient);
        $client->setSigner($signerMock);
        $client->setUserCredentials("login", "Fake user account key");

        $loginResult = $client->logIn();


        $this->assertEquals(true, $loginResult);

        $this->assertEquals(true, $client->getLoginStatus());
    }

    public function testCanSendNormalRequest()
    {
        $signerMock = $this->getSignerMock();
        // Ensure That request are signed twice (login and get)
        $signerMock->expects($this->exactly(2))
            ->method('getSigningKey');

        $guzzleClient = new GuzzleClient();
        $client = new Client('FAKE KEY', 'FAKE SECRET KEY', $guzzleClient);

        $client->setSigner($signerMock);

        $client->setUserCredentials('login', 'acc key');

        $client->login();

        $client->get('/observatory');

    }

    public function testCanSendPostRequest()
    {
        $signerMock = $this->getSignerMock();
        // Ensure That request are signed twice (login and post)
        $signerMock->expects($this->exactly(2))
            ->method('getSigningKey');

        $guzzleClient = new GuzzleClient();
        $client = new Client('FAKE KEY', 'FAKE SECRET KEY', $guzzleClient);

        $client->setSigner($signerMock);

        $client->setUserCredentials('login', 'acc key');

        $client->login();

        $client->post('/observatory', [], [], []);
    }

    private function getSignerMock()
    {
        $mock = $this->getMockBuilder('Wkop\Signer')
            ->disableOriginalConstructor()
            ->setMethods(
            [
            'getSigningKey',
            'setUrl',
            'setPostData'
            ]
        )->getMock();

        $mock->method('setUrl')
            ->will($this->returnSelf());

        $mock->method('setPostData')
            ->will($this->returnSelf());

        return $mock;
    }
}
