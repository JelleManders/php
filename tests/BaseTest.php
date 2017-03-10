<?php

use PHPUnit\Framework\TestCase;
use SpryngPaymentsApiPhp\Client;

date_default_timezone_set('Europe/Amsterdam');

require_once(dirname(__FILE__) .'/../vendor/autoload.php');

class BaseTest extends TestCase
{
    const TEST_API_KEY = "";

    const TEST_ACCOUNT_ID = "";

    const TEST_CUSTOMER_ID = "";

    protected $client;

    public function setUp()
    {
        $this->client = new Client(static::TEST_API_KEY, true);
    }

    public function testExceptionIsRaisedOnContruction()
    {
        $this->assertInstanceOf('SpryngPaymentsApiPhp\Client', $this->client);
    }
}