<?php

    require('../configurator.php');
    require('assign.php');

    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function createJob($mysqli, $parent, $type, $latlng, $desc, $spec, $resreq, $i) {
        $o = array('status' => 'FAIL', 'code' => '', 'num' => $i);
        $time = time();
        $latlng =json_encode($latlng);
        if($query = $mysqli->prepare('INSERT INTO requests VALUES (0, ?, ?, 0, ?, ?, ?, 0, ?, ?, 0)')) {
            $query->bind_param('iissisi', $parent, $_SESSION['uid'], $latlng, $spec, $type, $desc, $time);
            $query->execute();
            if ($query = $mysqli->prepare('SELECT uid FROM requests WHERE uid = last_insert_id()')) {
                $query->execute();
                $query->bind_result($req);
                $query->fetch();
                if (isset($req)) {
                    $query->fetch();
                    $o['status'] = 'SUCC';
                    $o['code'] = $req;
                  findVendorForJob($mysqli, $req, $latlng, $resreq);
                }
            }

        }
        echo(json_encode($o));
    }

    function createParent($mysqli, $type, $latlng, $desc, $spec, $resreq) {
        $o = array('status' => 'FAIL', 'code' => '');
        $time = time();
        $latlng = json_encode($latlng);
        $o['code'] = '0';
        if($query = $mysqli->prepare('INSERT INTO requests VALUES (0, 0, ?, 0, ?, ?, ?, 0, ?, ?, 0)')) {
            $query->bind_param('issisi', $_SESSION['uid'], $latlng, $spec, $type, $desc, $time);
            $query->execute();
            $o['code'] = '1';
            if ($query = $mysqli->prepare('SELECT uid FROM requests WHERE uid = last_insert_id()')) {
                $query->execute();
                $query->bind_result($req);
                $query->fetch();
                $o['code'] = '2';
                if (isset($req)) {
                    $query->fetch();
                    if($query = $mysqli->prepare('UPDATE requests SET parent_uid = last_insert_id() WHERE uid = last_insert_id()')) {
                        $query->execute();
                    }
                    $o['status'] = 'SUCC';
                    $o['code'] = $req;
                    $o['assign'] = findVendorForJob($mysqli, $req, $latlng, $resreq);
                }
            }

        }
        echo(json_encode($o));
    }

    function editJob($mysqli, $uid, $stat, $prio, $serv, $spec, $desc, $time) {
        $o = array('status' => 'FAIL', 'code' => '');
        if($query = $mysqli->prepare('SELECT concurrencyTimeout FROM requests WHERE uid = ? LIMIT 1')) {
            $query->bind_param('i', $uid);
            $query->execute();
            $query->bind_result($cTime);
            $query->fetch();
            if (isset($cTime)) {
                $query->fetch();
                if ($time != $cTime) {
                    $o['code'] = '<br/>Concurrency Error!<br/><br/>';
                    $o['status'] = "CONC";
                } else {
                    $time = time();
                    if($query = $mysqli->prepare('UPDATE requests SET locationDescription = ?, serviceCode = ?,  serviceStatus = ?, serviceDescription = ?, priorityCode = ?, concurrencyTimeout = ? WHERE uid = ?')) {
                        $query->bind_param('siisiii', $spec, $serv, $stat, $desc, $prio, $time, $uid);
                        $query->execute();
                        $o['status'] = "SUCC";
                        $o['code'] = '<br/>Successfully Updated!<br/><br/>';
                    }
                }
            }
        }

        echo(json_encode($o));
    }

    if (isset($_POST['action'])) {
        switch($_POST['action']) {
            default:
                createJob($mysqli, $_POST['parent'], $_POST['type'], $_POST['location'], $_POST['desc'], $_POST['spec'],  $_POST['res'],  $_POST['i']);
                break;
            case 'create-parent':
                createParent($mysqli, $_POST['type'], $_POST['location'], $_POST['desc'], $_POST['spec'],  $_POST['res']);
                break;
            case 'edit':
                editJob($mysqli, $_POST['uid'], $_POST['status'], $_POST['prio'], $_POST['service'], $_POST['spec'], $_POST['desc'], $_POST['time']);
                break;
        }
    }

?>
