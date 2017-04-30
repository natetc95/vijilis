<?php

    require('../configurator.php');
    require('../verification.php');
    session_start();
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

    function find_inactive_resources($mysqli) {
        $o = array();
        $template = array('lat' => 0, 'lng' => 0, 'uid' => 0);
        if($query = $mysqli->prepare('SELECT resourceLocation, resourceType, uid FROM resource WHERE active = 0 AND resourceWasDeleted = 0 AND approved = 1 AND engaged = 0')) {
            $query->execute();
            $query->bind_result($rL, $rT, $uid);
            while($query->fetch()) {
                $json = json_decode($rL, true);
                $template['lat'] = $json['lat'];
                $template['lng'] = $json['lon'];
                $template['uid'] = $uid;
                $template['type'] = resourceType($rT);
                array_push($o, $template);
            }
        }
        echo(json_encode($o));
    }

    function find_active_resources($mysqli) {
        $o = array();
        $template = array('lat' => 0, 'lng' => 0, 'uid' => 0);
        if($query = $mysqli->prepare('SELECT resourceLocation, resourceType, uid FROM resource WHERE active = 1 AND resourceWasDeleted = 0 AND approved = 1 AND engaged = 0')) {
            $query->execute();
            $query->bind_result($rL, $rT, $uid);
            while($query->fetch()) {
                $json = json_decode($rL, true);
                $template['lat'] = $json['lat'];
                $template['lng'] = $json['lon'];
                $template['uid'] = $uid;
                $template['type'] = resourceType($rT);
                array_push($o, $template);
            }
        }
        echo(json_encode($o));
    }

    function find_jobs($mysqli) {
        $o = array();
        $template = array('lat' => 0, 'lng' => 0, 'uid' => 0);
        if($query = $mysqli->prepare('SELECT locationCoords, incidentmanager_uid, uid FROM requests WHERE serviceStatus != 99 and uid = parent_uid')) {
            $query->execute();
            $query->bind_result($rL, $iid, $uid);
            while($query->fetch()) {
                $json = json_decode($rL, true);
                $template['lat'] = $json['lat'];
                $template['lng'] = $json['lng'];
                $template['uid'] = $uid;
                $template['type'] = $iid;
                array_push($o, $template);
            }
        }
        echo(json_encode($o));
    }

    function getDistrict($mysqli) {
        $o = array('status' => 'FAIL', 'code' => '');
        if($query = $mysqli->prepare('SELECT district FROM user WHERE uid = ?')) {
            $query->bind_param('i', $_SESSION['uid']);
            $query->execute();
            $query->bind_result($d);
            $query->fetch();
            $o['code'] = $_SESSION['uid'];
            if (isset($d)) {
                $o['code'] = 'STAGE 1';
                $query->fetch();
                if($query = $mysqli->prepare('SELECT boudingInformation, color FROM districts WHERE uid = ?')) {
                    $query->bind_param('i', $d);
                    $query->execute();
                    $query->bind_result($b, $c);
                    $query->fetch();
                    $o['code'] = 'STAGE 2';
                    if (isset($b)) {
                        $query->fetch();
                        $o['data'] = json_decode($b, true);
                        $o['color'] = $c;
                        $o['status'] = 'SUCC';
                    }    
                }
            }    
        }
        echo(json_encode($o));
    }

    function find_engaged_resources($mysqli) {
        $o = array();
        $template = array('lat' => 0, 'lng' => 0, 'uid' => 0);
        if($query = $mysqli->prepare('SELECT resourceLocation, resourceType, uid FROM resource WHERE resourceWasDeleted = 0 AND approved = 1 AND engaged = 1')) {
            $query->execute();
            $query->bind_result($rL, $rT, $uid);
            while($query->fetch()) {
                $json = json_decode($rL, true);
                $template['lat'] = $json['lat'];
                $template['lng'] = $json['lon'];
                $template['uid'] = $uid;
                $template['type'] = resourceType($rT);
                array_push($o, $template);
            }
        }
        echo(json_encode($o));
    }

    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'inactive':
                find_inactive_resources($mysqli);
                break;
            case 'jobs':
                find_jobs($mysqli);
                break;
            case 'active':
                find_active_resources($mysqli);
                break;
            case 'district':
                getDistrict($mysqli);
                break;
            case 'engaged':
                find_engaged_resources($mysqli);
                break;
        }
    }

    $mysqli->close();

?>