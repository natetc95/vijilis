<?php

    require('assign.php');
    require('../configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function createJob($mysqli, $parent, $type, $latlng, $desc, $spec, $i) {
        $o = array('status' => 'FAIL', 'code' => '', 'num' => $i);
        $time = time();
        $latlng =json_encode($latlng);
        if($query = $mysqli->prepare('INSERT INTO requests VALUES (0, ?, ?, NULL, ?, ?, ?, 0, ?, ?, 0)')) {
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
                  // findVendorForJob($mysqli, $req, $latlng);
                }
            }

        }
        echo(json_encode($o));
    }

    function createParent($mysqli, $type, $latlng, $desc, $spec) {
        $o = array('status' => 'FAIL', 'code' => '');
        $time = time();
        $latlng = json_encode($latlng);
        $o['code'] = '0';
        if($query = $mysqli->prepare('INSERT INTO requests VALUES (0, 0, ?, NULL, ?, ?, ?, 0, ?, ?, 0)')) {
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
                }
            }

        }
        echo(json_encode($o));
    }



    if (isset($_POST['action'])) {
        switch($_POST['action']) {
            default:
                createJob($mysqli, $_POST['parent'], $_POST['type'], $_POST['location'], $_POST['desc'], $_POST['spec'],  $_POST['i']);
                break;
            case 'create-parent':
                createParent($mysqli, $_POST['type'], $_POST['location'], $_POST['desc'], $_POST['spec']);
                break;
        }
    }

?>
