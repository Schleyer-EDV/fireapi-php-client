<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        DomainContactHandler.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        17:52
 *
 */

namespace fireapi\Handlers;

use fireapi\fireapi;
use fireapi\Exception\AssertNotImplemented;

class DomainContactHandler {

    private $fireapi;

    public function __construct(fireapi $fireapi) {
        $this->fireapi = $fireapi;
    }

    /**
     * Get all available country codes for the creation of a new handle
     *
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCountryCodes() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('domain/handle/countries');
    }

    /**
     * Create a new handle
     *
     * @param $gender
     * @param $firstName
     * @param $lastName
     * @param $street
     * @param $number
     * @param $zipcode
     * @param $city
     * @param $region
     * @param $countryCode
     * @param $email
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createHandle($gender, $firstName, $lastName, $street, $number, $zipcode, $city, $region, $countryCode, $email) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->put('domain/handle/create', [
            'gender' => $gender,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'street' => $street,
            'number' => $number,
            'zipcode' => $zipcode,
            'city' => $city,
            'region' => $region,
            'countrycode' => $countryCode,
            'email' => $email
        ]);
    }

    /**
     * Get detailed information about a domain handle
     *
     * @param $handle_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHandleDetails($handle_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('domain/handle/' . $handle_id . '/info');

    }

    /**
     * Update a handle
     *
     * @param $handle_id
     * @param $street
     * @param $number
     * @param $zipcode
     * @param $city
     * @param $region
     * @param $countryCode
     * @param $email
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateHandle($handle_id, $street, $number, $zipcode, $city, $region, $countryCode, $email) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('domain/handle/' . $handle_id . '/update', [
            'street' => $street,
            'number' => $number,
            'zipcode' => $zipcode,
            'city' => $city,
            'region' => $region,
            'countrycode' => $countryCode,
            'email' => $email
        ]);
    }

}