<?php
/*
 * *************************************************************************
 *  * Copyright 2006-2023 (C) Björn Schleyer, Schleyer-EDV - All rights reserved.
 *  *
 *  * Made in Gelsenkirchen with-&hearts; by Björn Schleyer
 *  *
 *  * @project     fireapi-php-client
 *  * @file        vmToolsHandler.php
 *  * @author      BSchleyer
 *  * @site        www.schleyer-edv.de
 *  * @date        5.12.2023
 *  * @time        10:30
 *
 */

namespace fireapi\Handlers;

use fireapi\fireapi;

class vmToolsHandler {

    private $fireapi;

    public function __construct(fireapi $fireapi) {
        $this->fireapi = $fireapi;
    }

    /*
     * ISO section
     */

    /**
     * Set the vm a specified iso
     *
     * @param int $vm_id
     * @param $iso
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setIso($vm_id, $iso) {
        return $this->fireapi->put('vm/' . $vm_id . '/iso', [
            'iso' => $iso
        ]);
    }

    /**
     * Remove the vm a specified iso
     *
     * @param int $vm_id
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeISO($vm_id) {
        return $this->fireapi->delete('vm/' . $vm_id . '/iso');
    }

    /*
     * DDOS section
     */

    /**
     * get the ddos settings
     *
     * @param int $vm_id
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDDOS($vm_id) {
        return $this->fireapi->get('vm/' . $vm_id . '/ddos');
    }

    /**
     * set the ddos settings
     *
     * @param int $vm_id
     * @param $layer4
     * @param $layer7
     * @param $ip_address
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setDDOS($vm_id, $layer4, $layer7, $ip_address) {
        return $this->fireapi->post('vm/' . $vm_id . '/ddos', [
            'layer4' => $layer4,
            'layer7' => $layer7,
            'ip_address' => $ip_address
        ]);
    }

    /*
     * Backup section
     */

    /**
     * get all backups of the vm
     *
     * @param int $vm_id
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBackupList($vm_id) {
        return $this->fireapi->get('vm/' . $vm_id . '/backup/list');
    }

    /**
     * create a new backup of the given vm
     *
     * @param int $vm_id
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createBackup($vm_id) {
        return $this->fireapi->post('vm/' . $vm_id . '/backup/create');
    }

    /**
     * get the status of the backup, where creating from a given vm
     *
     * @param int $vm_id
     * @param $backup_id
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBackupStatus($vm_id, $backup_id) {
        return $this->fireapi->get('vm/' . $vm_id . '/backup/create/status', [
            'backup_id' => $backup_id
        ]);
    }

    /**
     * restore a backup for the given vm
     *
     * @param int $vm_id
     * @param $backup_id
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function restoreBackup($vm_id, $backup_id) {
        return $this->fireapi->post('vm/' . $vm_id . '/backup/restore', [
            'backup_id' => $backup_id
        ]);
    }

    /**
     * status of a restore backup
     *
     * @param int $vm_id
     * @param $backup_id
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function restoreBackupStatus($vm_id, $backup_id) {
        return $this->fireapi->post('vm/' . $vm_id . '/backup/restore/status', [
            'backup_id' => $backup_id
        ]);
    }

    /**
     * Delete a backup from the given vm
     *
     * @param int $vm_id
     * @param $backup_id
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteBackup($vm_id, $backup_id) {
        return $this->fireapi->delete('vm/' . $vm_id . '/backup/delete', [
            'backup_id' => $backup_id
        ]);
    }

    /*
     * List section
     */

    /**
     * get all vms from your account
     *
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAllVMs() {
        return $this->fireapi->get('vm/list');
    }

    /**
     * Get all Hostsystems available for vm creation
     * (with information, example hardware, etc.)
     *
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHosts() {
        return $this->fireapi->get('vm/list/hosts');
    }

    /**
     * Get a List of all available os
     *
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOSList() {
        return $this->fireapi->get('vm/list/os');
    }

    /**
     * Get a List of all available iso files
     *
     * @return array|string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getISOList() {
        return $this->fireapi->get('vm/list/iso');
    }

}