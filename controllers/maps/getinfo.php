<?php

    require('../configurator.php');
    require('../verification.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function resourceType($x) {
        switch($x) {
            case 0:
                return 'Tow Truck';
                break;
            case 1:
                return 'Ambulance';
                break;
            case 2:
                return 'Snow Plow';
                break;
            case 3:
                return 'Food Stuffs';
                break;
        }
    }

    function getResourceInformation($mysqli, $uid) {
        $o = array();
        $r = array();
        if($query = $mysqli->prepare('SELECT uid, vendor_uid, resourceLocation, resourceType, resourceTitle, resourceDescription, approved, active FROM resource WHERE uid = ?')) {
            $query->bind_param('i', $uid);
            $query->execute();
            $query->bind_result($rid, $vid, $rL, $rT, $rTi, $rD, $appr, $act);
            $query->fetch();
            if (isset($rid)) {
                $query->fetch();
                $r['uid'] = $rid;
                $r['location'] = json_decode($rL, true);
                $r['type'] = resourceType($rT);
                $r['title'] = $rTi;
                $r['description'] = $rD;
                $r['approved'] = ($appr == 1 ? true : false);
                $r['active'] = ($act == 1 ? true : false);
                $o['resource'] = $r;
                $o['vendor'] = getVendorInformation($mysqli, $vid);
            }
        }
        echo(json_encode($o));
    }

    function getVendorInformation($mysqli, $uid) {
        $o = array();
        $template = array('lat' => 0, 'lng' => 0, 'uid' => 0);
        if($query = $mysqli->prepare('SELECT user_uid FROM vendor WHERE uid = ?')) {
            $query->bind_param('i', $uid);
            $query->execute();
            $query->bind_result($uuid);
            $query->fetch();
            $o['uid'] = $uid;
            if (isset($uuid)) {
                $query->fetch();
                if($query = $mysqli->prepare('SELECT fname, lname FROM user WHERE uid = ?')) {
                    $query->bind_param('i', $uuid);
                    $query->execute();
                    $query->bind_result($fn, $ln);
                    $query->fetch();
                    if (isset($fn)) {
                        $query->fetch();
                        $o['uuid'] = $uuid;
                        $o['name'] = $fn . ' ' . $ln;
                    }
                }
            }
        }
        return $o;
    }

    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'resource':
                getResourceInformation($mysqli, $_POST['uid']);
                break;
            case 'active':
                find_active_resources($mysqli);
                break;
        }
    }

    $mysqli->close();

?>