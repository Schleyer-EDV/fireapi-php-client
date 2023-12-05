<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        dnsHandler.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        17:51
 *
 */

namespace fireapi\Handlers;

use fireapi\fireapi;
use fireapi\Exception\AssertNotImplemented;

class dnsHandler {

    private $fireapi;

    public function __construct(fireapi $fireapi) {
        $this->fireapi = $fireapi;
    }

    /**
     * Create a new dns record
     *
     * @param string $domain
     * @param $type
     * @param $name
     * @param $data
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addDNSRecords($domain, $type, $name, $data) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->put('domain/' . $domain . '/dns/add', [
            'type' => $type,
            'name' => $name,
            'data' => $data
        ]);
    }

    /**
     * Get all DNS records of a domain
     *
     * @param $domain
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDNSRecords($domain) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('domain/' . $domain . '/dns');
    }

    /**
     * Update a existing DNS record
     *
     * @param $domain
     * @param $record_id
     * @param $data
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateDNSRecords($domain, $record_id, $data) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('domain/' . $domain . '/dns/edit', [
            'record_id' => $record_id,
            'data' => $data
        ]);
    }

    /**
     * Delete an existing DNS record
     *
     * @param $domain
     * @param $record_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteDNSRecords($domain, $record_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->delete('domain/' . $domain . '/dns/remove', [
            'record_id' => $record_id
        ]);
    }

}