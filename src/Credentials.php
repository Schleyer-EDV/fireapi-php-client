<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        Credentials.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        9:10
 *
 */
namespace fireapi;

use fireapi\Exception\ParameterException;

class Credentials {

    private $token;
    private $sandbox;
    private $url;

    /**
     * Credentials constructor
     *
     * @param string $token
     * @param bool $sandbox
     */
    public function __construct(string $token, bool $sandbox = false) {

        if(!is_string($token)) {
            throw new ParameterException('invalid token');
        }

        $this->token = $token;

        switch ($sandbox) {
            case false:
                $this->sandbox = false;
                $this->url = 'https://live.fireapi.de/';
                break;
            case true:
                $this->sandbox = true;
                $this->url = '';
                break;
            default:
                $this->sandbox = false;
                $this->url = 'https://live.fireapi.de/';
                break;
        }
    }

    public function __toString() {
        return sprintf(
            '[Host: %s], [Token: %s]',
            $this->url,
            $this->token
        );
    }

    /**
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

    /**
     * @return bool
     */
    public function isSandbox(): bool {
        return $this->sandbox;
    }

}
