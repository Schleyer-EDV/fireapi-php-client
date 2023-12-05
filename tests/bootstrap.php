<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        bootstrap.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        9:53
 *
 */

$autoload = dirname(__DIR__) . '/vendor/autoload.php';
if(!fiel_exists($autoload)) {
    echo "Please install project runing:\n\tcomposer install\n\n";
    exit("Download composer at https://getcomposer.org/download/\n\n");
}

$loader = include $autoload;
$loader->addPsr4('fireapi\\', __DIR__);
$loader->addPsr4('CustomClasses\\', __DIR__ . '/CustomClasses');