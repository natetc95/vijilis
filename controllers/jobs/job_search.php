<?php

    require('../configurator.php');
    require('assign.php');

    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function search($mysqli, $uid, $ctime, $code, $status, $desc, $im, $res, $parent) {
        $search = "SELECT 
            uid,
            serviceStatus,
            serviceDescription,
            vendor_uid,
            concurrencyTimeout
        FROM requests 
        WHERE 
            uid LIKE COALESCE(?, '%') AND
            parent_uid LIKE COALESCE(?, '%') AND
            concurrencyTimeout > COALESCE(?, 0) AND
            serviceCode LIKE COALESCE(?, '%') AND
            serviceStatus LIKE COALESCE(?, '%') AND
            serviceDescription LIKE COALESCE(?, '%') AND
            incidentmanager_uid LIKE COALESCE(?, '%') AND
            vendor_uid LIKE COALESCE(?, '%')";

        $o = array('arr' => array(), 'code' => '');
        $uid = (isset($uid) && $uid != '') ? $uid : NULL;
        $parent = (isset($parent) && $parent != '') ? $parent : NULL;
        $ctime = (isset($ctime) && $ctime != '') ? $ctime : NULL;
        $status = (isset($status) && $status != "-1") ? "$status" : NULL;
        $code = (isset($code) && $code != "-1") ? $code : NULL;
        $desc = (isset($desc) && $desc != "") ? '%' . $desc . '%' : NULL;
        if(isset($im) && $im != "") {
            if($query = $mysqli->prepare('SELECT uid FROM user WHERE username = ? LIMIT 1')) {
                $query->bind_param('s', $im);
                $query->execute();
                $query->bind_result($imuid);
                $query->fetch();
                if(isset($imuid)) {
                    $query->fetch();
                    $im = $imuid;
                } elseif ($imuid == False) {
                    $im = NULL;
                }
            } else {
                $im == NULL;
            }
        } else {
            $im=NULL;
        }
        $res = (isset($res) && $res != "") ? $res : NULL;
        $huh = NULL;
        if($query = $mysqli->prepare($search)) {
            $query->bind_param('iiiiisii', $uid, $parent, $ctime, $code, $status, $desc, $im, $res);
            $query->execute();
            $query->bind_result($uid, $ss, $sd, $vid, $ct);
            while($query->fetch()) {
                array_push($o['arr'], array($uid, $ss, $sd, $vid, $ct));
            }
            $o['code'] = 'ayy';
        } else {
            $o['code'] = $mysqli->errno . ': ' . $mysqli->error;
        }
        echo(json_encode($o));
    }

    search($mysqli, $_POST['job'], $_POST['cc'], $_POST['code'], $_POST['status'], $_POST['desc'], $_POST['user'], $_POST['vendor'], $_POST['parent']);

?>