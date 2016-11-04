<?php

require_once('BaseTest.php');

class AccountTest extends BaseTest
{
    public function testGetAllAccounts()
    {
        $accounts = $this->client->account->getAll();
        foreach($accounts as $account)
        {
            $this->assertInstanceOf('SpryngPaymentsApiPhp\Object\Account', $account);
        }
    }
}