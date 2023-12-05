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

    public function getInvoices() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/invoices');
    }

    public function getInvoiceDetails($invoice_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/invoices/' . $invoice_id);
    }

    public function getCurrentInvoices() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/invoices/current');
    }

    public function getPrices() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/pricings');
    }

    public function getSales() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('accounting/sales');
    }

}