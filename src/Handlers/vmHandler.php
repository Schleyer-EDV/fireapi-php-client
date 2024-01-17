<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        vmHandler.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        10:7
 *
 */

namespace fireapi\Handlers;

use fireapi\Exception\AssertNotImplemented;
use fireapi\fireapi;

class vmHandler {

    private $fireapi;

    public function __construct(fireapi $fireapi) {
        $this->fireapi = $fireapi;
    }

    /**
     * Get the status of a given vm
     *
     * @param int $vm_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStatus($vm_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('vm/' . $vm_id . '/status');
    }

    /**
     * Get installation status of the given vm
     *
     * @param int $vm_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getInstallStatus($vm_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('vm/' . $vm_id . '/status/installation');
    }

    /**
     * Set the power mode of the given vm
     *
     * @param int $vm_id
     * @param string $mode
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setPower($vm_id, $mode) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        if($mode != 'start' || 'stop' || 'restart') {
            throw new InvalidArgumentException('Invalid power mode specified! Example: start, stop, restart');
        }

        return $this->fireapi->post('vm/' . $vm_id . '/power', [
            'mode' => $mode,
        ]);
    }

    /**
     * Reset the password for the specified vm
     *
     * @param int $vm_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function resetPassword($vm_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('vm/' . $vm_id . '/password-reset');
    }

    /**
     * Delete a vm
     *
     * @param int $vm_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteVM($vm_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->delete('vm/' . $vm_id . '/delete');
    }

    /**
     * Get the link of the noVNC-Console
     *
     * @param int $vm_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getNoVNC($vm_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('vm/' . $vm_id . '/novnc');
    }

    /**
     * Set the rDNS for a specified ip_address for a given vm
     *
     * @param int $vm_id
     * @param $fqdn
     * @param $ip_address
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setRdns($vm_id, $fqdn, $ip_address) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('vm/' . $vm_id . '/rdns', [
            'domain' => $fqdn,
            'ip_address' => $ip_address
        ]);
    }

    /**
     * Get the current vm config
     *
     * @param int $vm_id
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getVMConfig($vm_id) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->get('vm/' . $vm_id . '/config');
    }

    /**
     * Update the current VM configuration
     *
     * @param int $vm_id
     * @param int $cores
     * @param int $mem
     * @param int $disk
     * @param int $backup_slots
     * @param int $network_speed
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function changeVMConfig($vm_id, $cores, $mem, $disk, $backup_slots, $network_speed) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('vm/' . $vm_id . '/change', [
            'cores' => $cores,
            'mem' => $mem,
            'disk' => $disk,
            'backup_slots' => $backup_slots,
            'network_speed' => $network_speed
        ]);
    }

    /**
     * Create a new vm
     *
     * @param int $cores
     * @param int $mem
     * @param int $disk
     * @param string $os
     * @param string $hostsystem
     * @param int $ips
     * @param int $backup_slots
     * @param int $network_speed
     * @param null|string $hostname
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createVM($cores, $mem, $disk, $os, $hostsystem, $ips, $backup_slots, $network_speed, $hostname = null) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->put('vm/create', [
            'cores' => $cores,
            'mem' => $mem,
            'disk' => $disk,
            'os' => $os,
            'hostsystem' => $hostsystem,
            'ips' => $ips,
            'backup_slots' => $backup_slots,
            'network_speed' => $network_speed,
            'hostname' => $hostname
        ]);
    }

    /**
     * Reinstall a vm
     *
     * @param int $vm_id
     * @param string $os
     * @return array|string
     * @throws AssertNotImplemented
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reinstallVM($vm_id, $os) {
        if($this->fireapi->isSandbox() === true) {
            throw new AssertNotImplemented();
        }

        return $this->fireapi->post('vm/' . $vm_id . '/reinstall', [
            'os' => $os,
        ]);
    }
}