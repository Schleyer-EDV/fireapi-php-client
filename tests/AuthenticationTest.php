<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        AuthenticationTest.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        9:51
 *
 */

use CustomClasses\TestClass;
use fireapi\fireapi;

class AuthenticationTest extends PHPUnit_Framework_TestCase {
    /**
     * @expectedException \fireapi\Exception\ParameterException
     */
    public function testExceptionIsThrownIfBadParamsPassed() {
        $fireapi = new fireapi('', false, null);
    }

    public function testgetStatus() {
        $fireapi = new fireapi('', false, null);
        return $fireapi->vm()->getStatus('')
    }
}