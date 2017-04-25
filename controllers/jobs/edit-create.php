<?php

    require('assign.php');
    require('../configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    
    function createJob($mysqli, $parent, $type, $latlng, $desc, $spec) {
        $o = array('status' => 'FAIL', 'code' => '');
        $time = time();
        $latlng =json_encode($latlng);
        if($query = $mysqli->prepare('INSERT INTO requests VALUES (0, ?, ?, NULL, ?, ?, ?, 0, ?, ?);')) {
            $query->bind_param('iissisi', $parent, $_SESSION['uid'], $latlng, $spec, $type, $desc, $time);
            $query->execute();
            if ($query = $mysqli->prepare('SELECT uid FROM requests WHERE concurrencyTimeout = ? AND incidentmanager_uid = ?')) {
                $query->bind_param('ii', $time, $_SESSION['uid']);
                $query->execute();
                $query->bind_result($req);
                $query->fetch();
                if (isset($req)) {
                    $query->fetch();
                    $o['status'] = 'SUCC';
                    $o['code'] = $req;
                    findVendorForJob($mysqli, $req, $latlng);
                }
            }

        }
        echo(json_encode($o));
    }

    createJob($mysqli, $_POST['parent'], $_POST['type'], $_POST['location'], $_POST['desc'], $_POST['spec']);

?>
