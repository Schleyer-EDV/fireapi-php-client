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
    public function setIso($vm_id, $iso) {
        return $this->fireapi->put('vm/' . $vm_id . '/iso', [
            'iso' => $iso
        ]);
    }

    public function removeISO($vm_id) {
        return $this->fireapi->delete('vm/' . $vm_id . '/iso');
    }

    /*
     * DDOS section
     */
    public function getDDOS($vm_id) {
        return $this->fireapi->get('vm/' . $vm_id . '/ddos');
    }

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
    public function getBackupList($vm_id) {
        return $this->fireapi->get('vm/' . $vm_id . '/backup/list');
    }

    public function createBackup($vm_id) {
        return $this->fireapi->post('vm/' . $vm_id . '/backup/create');
    }

    public function getBackupStatus($vm_id, $backup_id) {
        return $this->fireapi->get('vm/' . $vm_id . '/backup/create/status', [
            'backup_id' => $backup_id
        ]);
    }

    public function restoreBackup($vm_id, $backup_id) {
        return $this->fireapi->post('vm/' . $vm_id . '/backup/restore', [
            'backup_id' => $backup_id
        ]);
    }

    public function restoreBackupStatus($vm_id, $backup_id) {
        return $this->fireapi->post('vm/' . $vm_id . '/backup/restore/status', [
            'backup_id' => $backup_id
        ]);
    }

    public function deleteBackup($vm_id, $backup_id) {
        return $this->fireapi->delete('vm/' . $vm_id . '/backup/delete', [
            'backup_id' => $backup_id
        ]);
    }

    /*
     * List section
     */
    public function getAllVMs() {
        return $this->fireapi->get('vm/list');
    }

    public function getHosts() {
        return $this->fireapi->get('vm/list/hosts');
    }

    public function getOSList() {
        return $this->fireapi->get('vm/list/os');
    }

    public function getISOList() {
        return $this->fireapi->get('vm/list/iso');
    }

}