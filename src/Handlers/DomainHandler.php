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

use fireapi\fireapi;

class DomainHandler
{

    private $fireapi;

    public function __construct(fireapi $fireapi)
    {
        $this->fireapi = $fireapi;
    }


}