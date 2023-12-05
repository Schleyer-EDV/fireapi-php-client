<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        DomainHandler.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        10:37
 *
 */

namespace fireapi\Handlers;

use fireapi\Exception\AssertNotImplemented;
use fireapi\fireapi;

class DomainHandler {

    private $fireapi;

    public function __construct(fireapi $fireapi) {
        $this->fireapi = $fireapi;
    }

    /**
     * get all domains from account
     *
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllDomains() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('domain/list');
    }

    /**
     * Register a new domain
     *
     * @param string $domain
     * @param $handle_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function registerDomain($domain, $handle_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('domain/register', [
            'domain' => $domain,
            'handle' => $handle_id
        ]);
    }

    /**
     * Transfer a new domain
     *
     * @param string $domain
     * @param $handle_id
     * @param string $authcode
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function transferDomain($domain, $handle_id, $authcode) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('domain/register', [
            'domain' => $domain,
            'handle' => $handle_id,
            'authcode' => $authcode
        ]);
    }

    /**
     * Cancel a domain
     *
     * @param string $domain
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancelDomain($domain) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->delete('domain/' . $domain . '/cancel');
    }

    /**
     * Uncancel a domain
     *
     * @param string $domain
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uncancelDomain($domain) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('domain/' . $domain . '/undelete');
    }

    /**
     * Get the authcode for a given domain
     *
     * @param string $domain
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAuthcode($domain) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('domain/' . $domain . '/authcode');
    }

    /**
     * Get the pricelist to all tld
     *
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPricelist() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('domain/pricings');
    }

    /**
     * Get all informations about the given domain
     *
     * @param string $domain
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDomainInfo($domain) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('domain/' . $domain . '/info');
    }

    /**
     * check the availability of a domain
     *
     * @param string $domain
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkAvailable($domain) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('domain/' . $domain . '/check');
    }

    /**
     * Change the nameserver of the given domain
     *
     * @param string $domain
     * @param string $ns1
     * @param string $ns2
     * @param null|string $ns3
     * @param null|string $ns4
     * @param null|string $ns5
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function changeNameserver($domain, $ns1, $ns2, $ns3 = null, $ns4 = null, $ns5 = null) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('domain/' . $domain . '/nameserver', [
            'ns1' => $ns1,
            'ns2' => $ns2,
            'ns3' => $ns3,
            'ns4' => $ns4,
            'ns5' => $ns5
        ]);
    }
}