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
use InvalidArgumentException;

class vmHandler
{

    private $fireapi;

    public function __construct(fireapi $fireapi)
    {
        $this->fireapi = $fireapi;
    }

    public function getStatus($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/status');
    }

    public function getInstallStatus($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/status/installation');
    }

    public function setPower($vm_id, $mode)
    {
        if ($mode != 'start' || 'stop' || 'restart') {
            throw new InvalidArgumentException('Invalid power mode specified! Example: start, stop, restart');
        }

        return $this->fireapi->post('vm/' . $vm_id . '/power', [
            'mode' => $mode,
        ]);
    }

    public function resetPassword($vm_id)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/password-reset');
    }

    public function deleteVM($vm_id)
    {
        return $this->fireapi->delete('vm/' . $vm_id . '/delete');
    }

    public function getNoVNC($vm_id)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/novnc');
    }

    public function setRdns($vm_id, $fqdn, $ip_address)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/rdns', [
            'domain' => $fqdn,
            'ip_address' => $ip_address
        ]);
    }

    public function getVMConfig($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/config');
    }

    public function changeVMConfig($vm_id, $cores, $mem, $disk, $backup_slots, $network_speed, $allowFallbackIPs = false)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/change', [
            'cores' => $cores,
            'mem' => $mem,
            'disk' => $disk,
            'backup_slots' => $backup_slots,
            'network_speed' => $network_speed,
            'allowFallbackIPs' => $allowFallbackIPs
        ]);
    }

    public function createVM($cores, $mem, $disk, $os, $hostsystem, $ips, $backup_slots, $network_speed, $allowFallbackIPs = false, $hostname = null)
    {
        return $this->fireapi->put('vm/create', [
            'cores' => $cores,
            'mem' => $mem,
            'disk' => $disk,
            'os' => $os,
            'hostsystem' => $hostsystem,
            'ips' => $ips,
            'backup_slots' => $backup_slots,
            'network_speed' => $network_speed,
            'allowFallbackIPs' => $allowFallbackIPs,
            'hostname' => $hostname
        ]);
    }

    public function reinstallVM($vm_id, $os)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/reinstall', [
            'os' => $os
        ]);
    }
}
