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

    public function getMarketplace() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('dedicated/available');
    }

    public function checkState($identifier) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('dedicated/available/' . $identifier);
    }

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

    public function getInformations($identifier) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('dedicated/' . $identifier . '/info');
    }

    public function getList() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('dedicated/list');
    }

    public function cancel($identifier) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->delete('dedicated/' . $identifier . '/delete');
    }

    public function uncancel($identifier) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('dedicated/' . $identifier . '/undelete');
    }
}