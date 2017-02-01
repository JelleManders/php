<?php

require_once('BaseTest.php');

class CustomerTest extends BaseTest
{

    const TEST_CREATE_ARGUMENTS = array(
        'account'           => self::TEST_ACCOUNT_ID,
        'title'             => 'mr',
        'first_name'        => 'Roemer',
        'last_name'         => 'Bakker',
        'email_address'     => 'roemer@spryngpayments.com',
        'country_code'      => 'NL',
        'city'              => 'Amsterdam',
        'street_address'    => 'Stationsplein 51b',
        'postal_code'       => '2521 VA',
        'phone_number'      => '+31612345678'
    );

    public function testGetAccountById()
    {
        $customer = $this->client->customer->getCustomerById(self::TEST_CUSTOMER_ID);

        $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Customer', $customer);
    }

    public function testCreateCustomer()
    {
        $customer = $this->client->customer->create(self::TEST_CREATE_ARGUMENTS);

        $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Customer', $customer);
    }
}