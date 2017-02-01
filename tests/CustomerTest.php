<?php

require_once('BaseTest.php');

class CustomerTest extends BaseTest
{
    public function testGetAccountById()
    {
        $customer = $this->client->customer->getCustomerById(self::TEST_CUSTOMER_ID);

        $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Customer', $customer);
    }
}