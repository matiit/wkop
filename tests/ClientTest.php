<?php

namespace Wkop\Tests;

use Wkop\Client;
use Wkop\Exceptions\WykopAPIKeyMissingException;

/**
 * @covers Wkop\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
  /**
   * Test initializing Client class
   */
  public function testCantInitializeWithoutKey()
  {
    $client = new Client("FAKE KEY", "FAKE SECRET KEY");
    $this->assertInstanceOf('Wkop\Client', $client);
  }
}
