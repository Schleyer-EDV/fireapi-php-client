<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        AccountHandler.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        10:5
 *
 */

namespace fireapi\Handlers;

use fireapi\Exception\AssertNotImplemented;
use fireapi\fireapi;

class AccountHandler {

    private $fireapi;

    public function __construct(fireapi $fireapi) {
        $this->fireapi = $fireapi;
    }

    public function getRequests() {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('account/requests');
    }
}