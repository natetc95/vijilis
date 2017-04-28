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
        $next = False;
        $o = array('status' => 'FAIL', 'code' => array());
        if($query = $mysqli->prepare('SELECT uid, vendor_uid, resourceType, resourceTitle, resourceDescription, vehicleMake, vehicleModel, vehicleYear, foodDate FROM resource WHERE uid = ?')) {
            $query->bind_param('i', $uid);
            $query->execute();
            $query->bind_result($u, $vid, $rType, $rTitle, $rDesc, $vma, $vmo, $vyr, $fd);
            $query->fetch();
            if(isset($u)) {
                $query->fetch();
                $o['code']['uid'] = $u;
                $o['code']['vid'] = $vid;
                $o['code']['rType'] = resourceType($rType);
                $o['code']['rTitle'] = $rTitle;
                $o['code']['rDesc'] = $rDesc;
                $o['code']['make'] = $vma;
                $o['code']['model'] = $vmo;
                $o['code']['year'] = $vyr;
                $o['code']['food'] = $fd;
                $next = True;
            }
        }
        if ($next) {
            $next = False;
            if($query = $mysqli->prepare('SELECT user_uid FROM vendor WHERE uid = ?')) {
                $query->bind_param('i', $vid);
                $query->execute();
                $query->bind_result($uuid);
                $query->fetch();
                if(isset($u)) {
                    $query->fetch();
                    $o['code']['uuid'] = $uuid;
                    $next = True;
                }
            }
        }
        if ($next) {
            $next = False;
            if ($query = $mysqli->prepare('SELECT username, fname, lname, uid, email, telnum FROM user WHERE uid = ?')) {
                $query->bind_param('s', $uuid);
                $query->execute();
                $query->bind_result($u, $f, $l, $u2, $e, $t);
                $query->fetch();
                if(isset($u)) {
                    $query->fetch();
                    $o['status'] = 'SUCC';
                    $o['code']['name'] = $f . ' ' . $l;
                    $o['code']['email'] = $e;
                    $o['code']['telnum'] = $t;
                }
            }
        }
        echo(json_encode($o));
    }

    function approveResource($mysqli, $uid, $notify, $msg, $email, $fname) {
        $o = array('status' => 'FAIL', 'code' => array());
        if ($query = $mysqli->prepare('UPDATE resource SET approved = 1 WHERE uid = ?')) {
            $query->bind_param('s', $uid);
            $query->execute();
            if ($notify == 'true') {
                $o['status'] = 'SUCC';
                resourceApprovalEmail($email, $fname, 'approved', $msg);
            }
        }
        echo(json_encode($o));
    }

    function declineResource($mysqli, $uid, $notify, $msg, $email, $fname) {
        $o = array('status' => 'FAIL', 'code' => array());
        if ($query = $mysqli->prepare('UPDATE resource SET approved = NULL WHERE uid = ?')) {
            $query->bind_param('s', $uid);
            $query->execute();
            if ($notify == 'true') {
                $o['status'] = 'SUCC';
                resourceApprovalEmail($email, $fname, 'declined', $msg);
            }
        }
        echo(json_encode($o));
    }

    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'getResource':
                getResourceInformation($mysqli, $_POST['uid']);
                break;
            case 'approveMe':
                approveResource($mysqli, $_POST['uid'], $_POST['notify'], $_POST['msg'], $_POST['email'], $_POST['fname']);
                break;
            case 'declineMe':
                declineResource($mysqli, $_POST['uid'], $_POST['notify'], $_POST['msg'], $_POST['email'], $_POST['fname']);
                break;
            default:
                echo(json_encode(array('status'=>'FAIL', 'code' => 'Invalid Action: ' . $_POST['action'])));
                break;
        }
    }

?>