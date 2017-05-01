<?php

    require('configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function checkin($mysqli, $lat, $lng) {
        $json_data = json_encode(array('lat' => $lat, 'lng' => $lng, 'time' => time() * 1000));
        if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
            $query->bind_param('i', $_SESSION['uid']);
            $query->execute();
            $query->bind_result($vid);
            $query->fetch();
            if(isset($vid)) {
                $query->fetch();
                if($query = $mysqli->prepare("UPDATE vendor SET lastloggedlocation = ? WHERE user_uid = ?")) {
                    $query->bind_param('si', $json_data, $_SESSION['uid']);
                    $query->execute();
                    if($query = $mysqli->prepare("UPDATE resource SET resourceLocation = ? WHERE vendor_uid = ? AND resourceFollowsVendor = 1")) {
                        $query->bind_param('si', $json_data, $vid);
                        $query->execute();
                        return True;
                    }
                }
            }
        }
        return False;
    }

    function getDirections($mysqli) {
        if(isset($_POST['n'])) {
            $o = array('status' => 'FAIL', 'link' => '');
            if($query = $mysqli->prepare('SELECT locationCoords FROM requests WHERE uid = ?')) {
                $query->bind_param('i', $_POST['n']);
                $query->execute();
                $query->bind_result($desc);
                $query->fetch();
                if(isset($desc)) {
                    $query->fetch();
                    $json = json_decode($desc, true);
                    $link = 'https://maps.google.com?saddr=Current+Location&daddr=' . $json['lat'] . ',' . $json['lng'];
                    $o['link'] = $link;
                    if(isset($_POST['who'])) {
                        if($query = $mysqli->prepare('UPDATE requests SET serviceStatus = 21 WHERE uid = ?')) {
                            $query->bind_param('i', $_POST['n']);
                            $query->execute();
                            $o['status'] = checkin($mysqli, $_POST['geo_lat'], $_POST['geo_lng']) ? 'SUCC' : 'FAIL';
                        }
                    }
                }
            }
            echo(json_encode($o));
        }
    }

    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'dir':
                getDirections($mysqli);
                break;
        }
    }
?>