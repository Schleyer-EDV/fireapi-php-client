<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        DedicatedHandler.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        10:37
 *
 */

namespace fireapi\Handlers;

use fireapi\Exception\AssertNotImplemented;
use fireapi\fireapi;

class DedicatedHandler {

    private $fireapi;

    public function __construct(fireapi $fireapi) {
        $this->fireapi = $fireapi;
    }

    /**
     * Check the availability of the dedicated marketplace
     *
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMarketplace() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('dedicated/available');
    }

    /**
     * Check the availability of the given dedicated identifier
     *
     * @param $identifier
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkState($identifier) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('dedicated/available/' . $identifier);
    }

    /**
     * Buy a server with the given identifier and configure a webhook
     *
     * @param $identifier
     * @param $webhook
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function buyServer($identifier, $webhook = null) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        if(!is_null($webhook)) {
            $webhook_place = $webhook;
        }

        return $this->fireapi->put('dedicated/' . $identifier . '/purchase', [
            $webhook_place,
            'connect' => $identifier,
        ]);
    }

    /**
     * Get informations about the dedicated with the given identifier
     *
     * @param $identifier
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInformations($identifier) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('dedicated/' . $identifier . '/info');
    }

    /**
     * Get your dedicated server list
     *
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getList() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('dedicated/list');
    }

    /**
     * Cancel a dedicated server
     *
     * @param $identifier
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancel($identifier) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->delete('dedicated/' . $identifier . '/delete');
    }

    /**
     * Uncancel a dedicated server
     *
     * @param $identifier
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uncancel($identifier) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('dedicated/' . $identifier . '/undelete');
    }
}