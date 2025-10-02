<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        fireapi.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        9:1
 *
 */

namespace fireapi;

use fireapi\Credentials;
use fireapi\Exception\AssertNotImplemented;
use fireapi\Handlers\AccountHandler;
use fireapi\Handlers\AccountingHandler;
use fireapi\Handlers\DedicatedHandler;
use fireapi\Handlers\DomainHandler;
use fireapi\Handlers\ipHandler;
use fireapi\Handlers\vmHandler;
use fireapi\Handlers\vmToolsHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use fireapi\Exception\ParameterException;

class fireapi
{

    private $httpClient;
    private $credentials;
    private $apiToken;
    private $sandbox;

    /**
     * fireapi constructor
     *
     * @param string $token API-Token for all requests
     * @param bool $sandbox Enables the sandbox mode
     * @param null|string $httpClient Set the http client
     */
    public function __construct(string $token, bool $sandbox = false, $httpClient = null)
    {
        $this->apiToken = $token;
        $this->sandbox = $sandbox;
        $this->setHttpClient($httpClient);
        $this->setCredentials($token, $sandbox);
    }

    /**
     * @param $httpClient Client|null
     */
    public function setHttpClient(Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new Client([
            'allow_redirects' => false,
            'follow_redirects' => false,
            'timeout' => 120,
            'http_errors' => false
        ]);
    }

    public function setCredentials($credentials, $sandbox)
    {
        if (!$credentials instanceof Credentials) {
            $credentials = new Credentials($credentials, $sandbox);
        }

        $this->credentials = $credentials;
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->apiToken;
    }

    /**
     * @return bool
     */
    public function isSandbox(): bool
    {
        return $this->sandbox;
    }

    /**
     * @return Credentials
     */
    private function getCredentials(): Credentials
    {
        return $this->credentials;
    }

    /**
     * @param string $actionPath The resource path you want to request, see more at the documentation.
     * @param array $params Array filled with request params
     * @param string $method HTTP method used in the request
     *
     * @return  ResponseInterface
     * @throws  GuzzleException
     *
     * @throws  ParameterException          If the given field in params is not an array
     */
    private function request(string $actionPath, array $params = [], string $method = 'GET'): ResponseInterface
    {
        $url = $this->getCredentials()->getUrl() . $actionPath;

        if (!is_array($params)) {
            throw new ParameterException();
        }

        switch ($method) {
            case 'GET':
                return $this->getHttpClient()->get($url, [
                    'verify' => false,
                    'headers' => [
                        'Accept' => 'application/json',
                        'User-Agent' => 'fireapi-php-Client',
                        'X-FIRE-APIKEY' => $this->apiToken,
                    ],
                    'query' => $params,
                ]);
            case 'POST':
                return $this->getHttpClient()->post($url, [
                    'verify' => false,
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Accept' => 'application/json',
                        'User-Agent' => 'fireapi-php-Client',
                        'X-FIRE-APIKEY' => $this->apiToken,
                    ],
                    'form_params' => $params,
                ]);
            case 'PUT':
                return $this->getHttpClient()->put($url, [
                    'verify' => false,
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Accept' => 'application/json',
                        'User-Agent' => 'fireapi-php-Client',
                        'X-FIRE-APIKEY' => $this->apiToken,
                    ],
                    'form_params' => $params,
                ]);
            case 'DELETE':
                return $this->getHttpClient()->delete($url, [
                    'verify' => false,
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Accept' => 'application/json',
                        'User-Agent' => 'fireapi-php-Client',
                        'X-FIRE-APIKEY' => $this->apiToken,
                    ],
                    'form_params' => $params,
                ]);
            default:
                throw new ParameterException('Wrong HTTP method passed');
        }
    }

    /**
     * @param $response ResponseInterface
     *
     * @return array|string
     */
    private function processRequest(ResponseInterface $response)
    {
        if(!is_string($response)) {
            $response = $response->getBody()->__toString();
        }

        $result = json_decode($response);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $result;
        } else {
            return $response;
        }
    }

    /**
     * @throws GuzzleException
     */
    public function get($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'GET');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function put($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'PUT');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function post($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'POST');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function delete($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'DELETE');

        return $this->processRequest($response);
    }


    /*
     * Action Handler
     */
    private $accountingHandler;
    private $accountHandler;
    private $vmHandler;
    private $vmToolsHandler;
    private $dedicatedHandler;
    private $domainHandler;
    private $ipHandler;

    /**
     * @return $accountingHandler
     */
    public function accounting(): AccountingHandler
    {
        if (!$this->accountingHandler) {
            $this->accountingHandler = new AccountingHandler($this);
        }

        return $this->accountingHandler;
    }

    /**
     * @return $accountHandler
     */
    public function account(): AccountHandler
    {
        if (!$this->accountHandler) {
            $this->accountHandler = new AccountHandler($this);
        }

        return $this->accountHandler;
    }

    /**
     * @return $vmHandler
     */
    public function vm(): vmHandler
    {
        if (!$this->vmHandler) {
            $this->vmHandler = new vmHandler($this);
        }

        return $this->vmHandler;
    }

    /**
     * @return $vmToolsHandler
     */
    public function vmTools(): vmToolsHandler
    {
        if (!$this->vmToolsHandler) {
            $this->vmToolsHandler = new vmToolsHandler($this);
        }

        return $this->vmToolsHandler;
    }

    /**
     * @return $domainHandler
     */
    public function domain(): DomainHandler
    {
        throw new AssertNotImplemented();
        /*if(!$this->domainHandler) {
            $this->domainHandler = new DomainHandler($this);
        }

        return $this->domainHandler;*/
    }

    /**
     * @return $dedicatedHandler
     */
    public function dedicated(): DedicatedHandler
    {
        if (!$this->dedicatedHandler) {
            $this->dedicatedHandler = new DedicatedHandler($this);
        }

        return $this->dedicatedHandler;
    }

    /**
     * @return $ipHandler
     */
    public function ip(): ipHandler
    {
        if (!$this->ipHandler) {
            $this->ipHandler = new ipHandler($this);
        }

        return $this->ipHandler;
    }




}
