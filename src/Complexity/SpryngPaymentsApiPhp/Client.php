<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp;

use SpryngPaymentsApiPhp\Controller\CustomerController;
use SpryngPaymentsApiPhp\Controller\AccountController;
use SpryngPaymentsApiPhp\Controller\CardController;
use SpryngPaymentsApiPhp\Controller\iDealController;
use SpryngPaymentsApiPhp\Controller\PaypalController;
use SpryngPaymentsApiPhp\Controller\SepaController;
use SpryngPaymentsApiPhp\Controller\TransactionController;

class Client
{
    const CLIENT_VERSION = "1.0";

    const API_ENDPOINT_PRODUCTION   = "https://api.spryngpayments.com/v1";
    const API_ENDPOINT_SANDBOX      = "https://sandbox.spryngpayments.com/v1";

    /**
     * @var string
     */
    protected $apiEndpoint;

    /**
     * Public instance of the Transaction Controller
     *
     * @var TransactionController
     */
    public $transaction;

    /**
     * Public instance of the Card Controller
     *
     * @var CardController
     */
    public $card;

    /**
     * Public instance of the Account Controller
     *
     * @var AccountController
     */
    public $account;

    /**
     * Public instance of the Customer Controller
     *
     * @var CustomerController
     */
    public $customer;

    /**
     * Public instance of the iDeal Controller
     *
     * @var iDealController
     */
    public $iDeal;

    /**
     * Public instance of the Paypal Controller
     *
     * @var PaypalController
     */
    public $Paypal;

    /**
     * Public instance of the Sepa Controller
     *
     * @var SepaController
     */
    public $Sepa;

    /**
     * API key to authenticate user
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Spryng_Payments_Api_Client constructor.
     * @param $apiKey
     */
    public function __construct($apiKey, $sandbox = false)
    {
        $this->setApiKey($apiKey);

        if ( $sandbox )
        {
            $this->setApiEndpoint(self::API_ENDPOINT_SANDBOX);
        }
        else
        {
            $this->setApiEndpoint(self::API_ENDPOINT_PRODUCTION);
        }

        $this->transaction  = new TransactionController($this);
        $this->card         = new CardController($this);
        $this->account      = new AccountController($this);
        $this->customer     = new CustomerController($this);
        $this->iDeal        = new iDealController($this);
        $this->Paypal       = new PaypalController($this);
        $this->Sepa         = new SepaController($this);
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    /**
     * @param string $apiEndpoint
     */
    public function setApiEndpoint($apiEndpoint)
    {
        $this->apiEndpoint = $apiEndpoint;
    }
}