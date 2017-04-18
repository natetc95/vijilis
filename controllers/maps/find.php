<?php

    require('../configurator.php');
    require('../verification.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function find_inactive_resources($mysqli) {
        $o = array();
        $template = array('lat' => 0, 'lng' => 0, 'uid' => 0);
        if($query = $mysqli->prepare('SELECT resourceLocation, uid FROM resource WHERE active = 0')) {
            $query->execute();
            $query->bind_result($rL, $uid);
            while($query->fetch()) {
                $json = json_decode($rL, true);
                $template['lat'] = $json['lat'];
                $template['lng'] = $json['lon'];
                $template['uid'] = $uid;
                array_push($o, $template);
            }
        }
        echo(json_encode($o));
    }

    function find_active_resources($mysqli) {
        $o = array();
        $template = array('lat' => 0, 'lng' => 0, 'uid' => 0);
        if($query = $mysqli->prepare('SELECT resourceLocation, uid FROM resource WHERE active = 0')) {
            $query->execute();
            $query->bind_result($rL, $uid);
            while($query->fetch()) {
                $json = json_decode($rL, true);
                $template['lat'] = $json['lat'];
                $template['lng'] = $json['lon'];
                $template['uid'] = $uid;
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