<?php

    /* checkin.php
     * Handles all check in related requests
     * Included Functions:
     * - locateVendor()
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

     function locateVendor2($mysqli, $json_data, $vid) {
        $o = array('status' => 'FAIL', 'code' => '');
        if($query = $mysqli->prepare("UPDATE vendor SET lastloggedlocation = ? WHERE uid = ?")) {
            $query->bind_param('si', $json_data, $vid);
            $query->execute();
            $o['code'] = 'Updated Vendor Location!';
            if($query = $mysqli->prepare("UPDATE resource SET resourceLocation = ? WHERE vendor_uid = ? AND resourceFollowsVendor = 1")) {
                $query->bind_param('si', $json_data, $vid);
                $query->execute();
                $o['status'] = "SUCC";
                $o['code'] = 'Updated Resource Locations!';
            }
        }
        echo(json_encode($o));
    }

    function checkin($mysqli, $hash, $lat, $lng, $time, $pin) {
        $o = array('status' => 'FAIL', 'code' => '');
        $loc = json_encode(array('lat'=>$lat, 'lng'=>$lng, 'time'=>$time));
        if($query = $mysqli->prepare('SELECT user.fobVeri, vendor.uid FROM user INNER JOIN vendor ON user.uid = vendor.user_uid WHERE fobHash = ?')) {
            $query->bind_param('s', $hash);
            $query->execute();
            $query->bind_result($code, $vid);
            $query->fetch();
            if(isset($code)) {
                $query->fetch();
                if($code == $pin) {
                    locateVendor2($mysqli, $loc, $vid);
                } else {
                    $o['code'] = 'Incorrect Pin: ' . $code;
                    echo(json_encode($o));
                }
            }
        }
    }

    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'locate':
                locateVendor($mysqli, json_encode($_POST['json']));
                break;
            case 'fob':
                checkin($mysqli, $_POST['hash'], $_POST['lat'], $_POST['lng'], time(), $_POST['pin']);
                break;
        }
    }

    $mysqli->close();

?>