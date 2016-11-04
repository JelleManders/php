<?php

namespace SpryngPaymentsApiPhp\Controller;

use SpryngPaymentsApiPhp\Client;
use SpryngPaymentsApiPhp\Helpers\iDealHelper;
use SpryngPaymentsApiPhp\Utility\RequestHandler;

class iDealController extends BaseController
{
    const IDEAL_INITIATE_URI = "/transaction/ideal/initiate";

    public function __construct(Client $api)
    {
        parent::__construct($api);
    }

    public function initiate(array $arguments)
    {
        iDealHelper::validateInitiateiDealArguments($arguments);

        $http = new RequestHandler();
        $http->setHttpMethod("POST");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString(static::IDEAL_INITIATE_URI);
        $http->addHeader($this->api->getApiKey(), "X-APIKEY");
        $http->setPostParameters($arguments);
        $http->doRequest();

        return json_decode($http->getResponse());
    }
}