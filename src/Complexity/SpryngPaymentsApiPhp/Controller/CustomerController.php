<?php

namespace SpryngPaymentsApiPhp\Controller;

use SpryngPaymentsApiPhp\Client;
use SpryngPaymentsApiPhp\Exception\CustomerException;
use SpryngPaymentsApiPhp\Exception\RequestException;
use SpryngPaymentsApiPhp\Helpers\CustomerHelper;
use SpryngPaymentsApiPhp\Utility\RequestHandler;

class CustomerController extends BaseController
{
    const CUSTOMER_URI = "/customer";

    public function __construct(Client $api)
    {
        parent::__construct($api);
    }

    public function getCustomerById($id)
    {
        $http = new RequestHandler();
        $http->setHttpMethod("GET");
        $http->setBaseUrl($this->api->getApiEndpoint() . self::CUSTOMER_URI . '/' . $id);
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $http->doRequest();

        $response = $http->getResponse();
        $jsonResponse = json_decode($response);

        if (count($jsonResponse))
        {
            $customer = CustomerHelper::fillCustomerObject($jsonResponse);
        }
        else
        {
            throw new CustomerException("Customer not found", 501);
        }

        return $customer;
    }

    public function create($arguments)
    {
        CustomerHelper::validateNewCustomerArguments($arguments);

        $http = new RequestHandler();
        $http->setHttpMethod("POST");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString(static::CUSTOMER_URI);
        $http->addHeader($this->api->getApiKey(), 'X-APIKEY');
        $http->setPostParameters($arguments, false);
        try
        {
            $http->doRequest();
        }
        catch(RequestException $ex)
        {
            var_dump($ex->getMessage());
        }

        $response = $http->getResponse();
        $json = json_decode($response);
        $newCustomer = CustomerHelper::fillCustomerObject($json);

        return $newCustomer;
    }
}