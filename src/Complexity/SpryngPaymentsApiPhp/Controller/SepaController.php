<?php

namespace SpryngPaymentsApiPhp\Controller;

use SpryngPaymentsApiPhp\Client;
use SpryngPaymentsApiPhp\Helpers\SepaHelper;
use SpryngPaymentsApiPhp\Utility\RequestHandler;

class SepaController extends BaseController
{
    const SEPA_INITIATE_URI = "/transaction/sepa/initiate";

    public function __construct(Client $api)
    {
        parent::__construct($api);
    }

    public function initiate(array $arguments)
    {
        SepaHelper::validateInitializeSepaArguments($arguments);

        $http = new RequestHandler();
        $http->setHttpMethod("POST");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString(static::SEPA_INITIATE_URI);
        $http->addHeader($this->api->getApiKey(), "X-APIKEY");
        $http->setPostParameters($arguments);
        $http->doRequest();

        return json_decode($http->getResponse());
    }
}