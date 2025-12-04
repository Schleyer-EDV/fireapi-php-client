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
use fireapi\Exception\AssertNotImplemented;

class vmToolsHandler
{

    private $fireapi;

    public function __construct(fireapi $fireapi)
    {
        $this->fireapi = $fireapi;
    }

    /*
     * ISO section
     */
    public function setIso($vm_id, $iso)
    {
        return $this->fireapi->put('vm/' . $vm_id . '/iso', [
            'iso' => $iso
        ]);
    }

    public function removeISO($vm_id)
    {
        return $this->fireapi->delete('vm/' . $vm_id . '/iso');
    }

    /*
     * DDOS section
     */
    public function getDDOS($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/ddos');
    }

    public function setDDOS($vm_id, $layer4, $layer7, $ip_address)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/ddos', [
            'layer4' => $layer4,
            'layer7' => $layer7,
            'ip_address' => $ip_address
        ]);
    }

    /*
     * Backup section
     */
    public function getBackupList($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/backup/list');
    }

    public function createBackup($vm_id, $description)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/backup/create', [
            'description' => $description
        ]);
    }

    public function getBackupStatus($vm_id, $backup_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/backup/create/status', [
            'backup_id' => $backup_id
        ]);
    }

    public function restoreBackup($vm_id, $backup_id)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/backup/restore', [
            'backup_id' => $backup_id
        ]);
    }

    public function restoreBackupStatus($vm_id, $backup_id)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/backup/restore/status', [
            'backup_id' => $backup_id
        ]);
    }

    public function deleteBackup($vm_id, $backup_id)
    {
        return $this->fireapi->delete('vm/' . $vm_id . '/backup/delete', [
            'backup_id' => $backup_id
        ]);
    }

    /*
     * List section
     */
    public function getAllVMs()
    {
        return $this->fireapi->get('vm/list');
    }

    public function getHosts()
    {
        return $this->fireapi->get('vm/list/hosts');
    }

    public function getOSList()
    {
        return $this->fireapi->get('vm/list/os');
    }

    public function getISOList()
    {
        return $this->fireapi->get('vm/list/iso');
    }

    /*
     * Monitoring section
     */

    public function changeMonitoring($vm_id, $enabled, $port)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/monitoring/change', ['enabled' => $enabled, 'port' => $port]);
    }

    public function getTimings($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/monitoring/timings');
    }

    public function getIncidents($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/monitoring/incidences');
    }

    /*
     * Abuse section
     */
    public function getAbuses($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/abuses');
    }

    /*
     * Traffic section
     */
    public function getTrafficUsage($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/traffic/current');
    }

    public function getTrafficLog($vm_id)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/traffic/current/log');
    }

    public function getTrafficLogChart($vm_id, array $parameter, $size = '900x300')
    {
        return $this->fireapi->post('vm/' . $vm_id . '/traffic/chart', [
            'type' => $parameter['type'],
            'summary' => $parameter['summery'],
            'output' => $parameter['output'],
            'dataset_in_label' => (string) $parameter['dataset_in_label'],
            'dataset_out_label' => (string)  $parameter['dataset_out_label'],
            'dataset_in_color' => (string) $parameter['dataset_in_color'],
            'dataset_out_color' => (string) $parameter['dataset_out_color'],
            'axes_y_label' => (string) $parameter['axes_y_label'],
            'datapoints' => (int) $parameter['datapoints'],
            'size' => (string) $size
        ]);
    }

    public function getTrafficAddons($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/traffic/addons');
    }

    public function buyTrafficAddon($vm_id, $addon)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/traffic/addons/buy', [
            'addon' => $addon
        ]);
    }

    /*
     * SSH-key section
     */
    public function getAllSSHKeys($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/sshkey/list');
    }

    public function generateSSHKey($vm_id, $displayname)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/sshkey/generate', [
            'displayname' => $displayname
        ]);
    }

    public function loadSSHKey($vm_id, $public_key, $displayname)
    {
        return $this->fireapi->post('vm/' . $vm_id . '/sshkey/upload', [
            'public_key' => $public_key,
            'displayname' => $displayname
        ]);
    }

    public function removeSSHKey($vm_id, $key_id)
    {
        return $this->fireapi->delete('vm/' . $vm_id . '/sshkey/remove', [
            'key_id' => $key_id
        ]);
    }

    /*
     * rDNS section
     */
    public function getAllRDNS($vm_id)
    {
        return $this->fireapi->get('vm/' . $vm_id . '/rdns/list');
    }

    public function setRDNS($vm_id, $ip_address, $ptr, $note = null)
    {
        return $this->fireapi->put('vm/' . $vm_id . '/rdns/create', [
            'ip_address' => $ip_address,
            'ptr' => $ptr,
            'note' => $note
        ]);
    }

    public function deleteRDNS($vm_id, $ip_address) {
        return $this->fireapi->delete('vm/' . $vm_id . '/rdns/delete', [
            'ip_address' => $ip_address
        ]);
    }
}
