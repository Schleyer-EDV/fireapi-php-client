<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        AssertNotImplemented.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        9:28
 *
 */

namespace fireapi\Exception;

use Exception;
use Throwable;

class AssertNotImplemented extends Exception {
    public function __construct() {
        parent::__construct('This function does not exists in the Sandbox! It will be added soon.', 0, null);
    }
}