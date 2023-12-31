<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        AccountingHandler.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        10:2
 *
 */

namespace fireapi\Handlers;

use fireapi\Exception\AssertNotImplemented;
use fireapi\fireapi;

class AccountingHandler {

    private $fireapi;
    public function __construct(fireapi $fireapi)
    {
        $this->fireapi = $fireapi;
    }

    /**
     * Get all invoices from your account
     *
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInvoices() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/invoices');
    }

    /**
     * get details of an invoice from your account
     *
     * @param $invoice_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInvoiceDetails($invoice_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/invoices/' . $invoice_id);
    }

    /**
     * Get current invoice calculation from your account
     *
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCurrentInvoices() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/invoices/current');
    }

    /**
     * Get all Prices from your account
     *
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPrices() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/pricings');
    }

    /**
     * Get all Sales-Pricings from your account
     *
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSales() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/sales');
    }

}