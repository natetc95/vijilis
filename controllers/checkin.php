<?php

    /* profile.php
     * Handles all profile related requests
     * Included Functions:
     * - editProfile()
     * - editImage()
     * 
     * VIJILIS: Emergency Response System
     *
     * Senior Design Team 16040
     * University of Arizona
     * Nathaniel Christianson & Travis Roser
     */

    session_start();
    require('configurator.php');
    require('verification.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function locateVendor($mysqli, $json_data) {
        $o = array('status' => 'FAIL', 'code' => '');

        if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
            $query->bind_param('i', $_SESSION['uid']);
            $query->execute();
            $query->bind_result($vid);
            $query->fetch();
            $o['code'] = 'Found Vendor!';
            if(isset($vid)) {
                $query->fetch();
                if($query = $mysqli->prepare("UPDATE vendor SET lastloggedlocation = ? WHERE user_uid = ?")) {
                    $query->bind_param('si', $json_data, $_SESSION['uid']);
                    $query->execute();
                    $o['code'] = 'Updated Vendor Location!';
                    if($query = $mysqli->prepare("UPDATE resource SET resourceLocation = ? WHERE vendor_uid = ? AND resourceFollowsVendor = 1")) {
                        $query->bind_param('si', $json_data, $vid);
                        $query->execute();
                        $o['status'] = "SUCC";
                        $o['code'] = 'Updated Resource Locations!';
                    }
                }
            }
        }

        echo(json_encode($o));
    }

    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'locate':
                locateVendor($mysqli, $_POST['json']);
                break;
        }
    }

?>