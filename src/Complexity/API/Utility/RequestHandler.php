<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp\Utility;

use GuzzleHttp\Client;

/**
 * Class Spryng_Api_Utilities_RequestHandler
 * @package SpryngApiHttpPhp\Utilities
 */
class Spryng_Payments_Api_Utility_RequestHandler
{

    /**
     * GuzzleHttp Client
     *
     * @var Client
     */
    protected $httpClient;

    /**
     * The HTTP method used for this request
     *
     * @var string
     */
    protected $httpMethod;

    /**
     * The base URL for the requests
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * The query string, basically everything after baseUrl
     *
     * @var string
     */
    protected $queryString;

    /**
     * Array of GET parameters
     *
     * @var array
     */
    protected $getParameters = array();

    /**
     * Array of HTTP Headers
     *
     * @var array
     */
    protected $headers = array();

    /**
     * Response from the request
     *
     * @var mixed
     */
    protected $response;

    /**
     * Spryng_Payments_Api_Utility_RequestHandler constructor.
     * Creates instance of GuzzleHttp\Client
     */
    public function __construct()
    {
        $this->httpClient = new Client();
    }

    /**
     * Formats the URL and executes the request
     */
    public function doRequest ()
    {
        $url = $this->getBaseUrl() . $this->getQueryString();

        if ( count( $this->getGetParameters () ) > 0 )
        {
            $url .= '?';

            $iterator = 0;
            foreach ( $this->getGetParameters() as $key => $parameter )
            {
                $iterator++;
                $url .= $key . '=' . $parameter;

                if ( $iterator != count ( $this->getGetParameters() ) )
                {
                    $url .= '&';
                }
            }

            $req = $this->httpClient->request($this->getHttpMethod(), $url);

            $this->setResponse( (string) $req->getBody() );
        }
    }

    /**
     * Returns HTTP method
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Sets HTTP method
     *
     * @param string $httpMethod
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * Returns baseUrl
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Sets baseUrl
     *
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Returns the Query String
     *
     * @return string
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Sets the Query String
     *
     * @param string $queryString
     */
    public function setQueryString($queryString)
    {
        $this->queryString = $queryString;
    }

    /**
     * Returns array of all GET parameters
     *
     * @return array
     */
    public function getGetParameters()
    {
        return $this->getParameters;
    }

    /**
     * Reset $this->getParameters to $getParameters. Parses as url if $parse is true.
     *
     * @param $getParameters
     * @param bool|false $parse
     */
    public function setGetParameters($getParameters, $parse = false)
    {
        $this->getParameters = array();
        if ($parse) {
            foreach ($getParameters as $key => $parameter)
            {
                $this->getParameters[$key] = urlencode($parameter);
            }
        }
        else {
            $this->getParameters = $getParameters;
        }
    }

    /**
     * Adds a new parameter to the GET parameter array
     *
     * @param $value
     * @param null $key
     * @param bool|false $parse
     */
    public function addGetParameter($value, $key = null, $parse = false)
    {
        if ($parse)
        {
            $value = urlencode($value);
        }

        if ($key === null)
        {
            array_push($this->getParameters, $value);
        }
        else
        {
            $this->getParameters[$key] = $value;
        }
    }

    /**
     * Returns array of all Http Headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set all headers at once
     *
     * @param $headers
     * @param bool|false $parse
     */
    public function setHeaders($headers, $parse = false)
    {
        $this->getParameters = array();
        if ($parse) {
            foreach ($headers as $key => $parameter)
            {
                $this->getParameters[$key] = urlencode($parameter);
            }
        }
        else {
            $this->getParameters = $headers;
        }
    }

    /**
     * Set a single header
     *
     * @param $value
     * @param null $key
     * @param bool|false $parse
     */
    public function addHeader($value, $key = null, $parse = false)
    {
        if ($parse)
        {
            $value = urlencode($value);
        }

        if ($key === null)
        {
            array_push($this->headers, $value);
        }
        else
        {
            $this->headers[$key] = $value;
        }
    }

    /**
     * Returns the response
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the response
     *
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}