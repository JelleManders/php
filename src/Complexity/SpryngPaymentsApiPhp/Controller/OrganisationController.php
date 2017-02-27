<?php

namespace SpryngPaymentsApiPhp\Controller;

use SpryngPaymentsApiPhp\Client;
use SpryngPaymentsApiPhp\Helpers\OrganisationHelper;
use SpryngPaymentsApiPhp\Utility\RequestHandler;

class OrganisationController extends BaseController
{
    const ORGANISATION_URI = "/organisation";

    public function __construct(Client $api)
    {
        parent::__construct($api);
    }

    public function getAll()
    {
        $http = new RequestHandler();
        $http->setHttpMethod("GET");
        $http->setBaseUrl($this->api->getApiEndpoint());
        $http->setQueryString(static::ORGANISATION_URI);
        $http->addHeader($this->api->getApiKey(), "X-APIKEY");
        $http->doRequest();

        $response = json_decode($http->getResponse());
        $organisations = array();

        foreach ($response as $organisation)
        {
            $organisationObj = OrganisationHelper::fill($organisation);
            array_push($organisations, $organisationObj);
        }

        return $organisations;
    }
}