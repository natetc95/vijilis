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

    function find_inactive_resources($mysqli) {
        $o = array();
        $template = array('lat' => 0, 'lng' => 0, 'uid' => 0);
        if($query = $mysqli->prepare('SELECT resourceLocation, resourceType, uid FROM resource WHERE active = 0 AND resourceWasDeleted = 0')) {
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
        if($query = $mysqli->prepare('SELECT resourceLocation, resourceType, uid FROM resource WHERE active = 1 AND resourceWasDeleted = 0')) {
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
            case 'active':
                find_active_resources($mysqli);
                break;
        }
    }

    $mysqli->close();

?>