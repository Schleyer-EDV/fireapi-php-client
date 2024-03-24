<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2024 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     24fire-php-client
 *  * @file        ipHandler.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        24.3.2024
 *  * @time        9:57
 *  **************************************************************************
 */


namespace fireapi\Handlers;

use fireapi\Exception\AssertNotImplemented;
use fireapi\fireapi;

class ipHandler
{

    private $fireapi;

    public function __construct(fireapi $fireapi)
    {
        $this->fireapi = $fireapi;
    }

    public function availableSubnet()
    {
        if ($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('ip/available');
    }

    public function buySubnet($net_id)
    {
        if ($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('ip/purchase', ['netID' => $net_id]);
    }

    public function listSubnet()
    {
        if ($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('ip/list');
    }

    public function cancelSubnet($net_id)
    {
        if ($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->delete('ip/delete', ['netID' => $net_id]);
    }

}