<?php
    chdir(__DIR__);
    chdir('../');
    require('../controllers/jobs/assign.php');

    function getRequestData($mysqli, $From) {
        $o = array('status' => 'FAIL', 'data' => array());
        if ($query = $mysqli->prepare('SELECT uid, name, messageType, refNum, resNum FROM messages WHERE tel = ? AND stop = 0')) {
            $query->bind_param('s', $From);
            $query->execute();
            $query->bind_result($u, $n, $mt, $ref, $res);
            $query->fetch();
            if(isset($n)) {
                $query->fetch();
                $o['status'] = 'SUCC';  
                $o['data']['request'] = $u;
                $o['data']['name'] = $n;
                $o['data']['msgType'] = $mt;
                $o['data']['job#'] = $ref;   
                $o['data']['res#'] = $res;   
            }
        }
        return $o;
    }

    function removeRequestData($mysqli, $From) {
        $o = array('status' => 'FAIL', 'data' => array());
        if ($query = $mysqli->prepare('UPDATE messages SET stop = 1 WHERE tel = ? AND stop = 0')) {
            $query->bind_param('s', $From);
            $query->execute();
            $o['status'] = 'SUCC';
        }
    }

    function declineCall($mysqli, $data) {
        if ($query = $mysqli->prepare('UPDATE messages SET stop = 1 WHERE uid = ? AND stop = 0')) {
            $query->bind_param('s', $data['request']);
            $query->execute();
        }
        if ($query = $mysqli->prepare('UPDATE resource SET engaged = 0, active = 0 WHERE uid = ?')) {
            $query->bind_param('s', $data['res#']);
            $query->execute();
        }
        if ($query = $mysqli->prepare('SELECT locationCoords FROM requests WHERE uid = ?')) {
            $query->bind_param('s', $data['job#']);
            $query->execute();
            $query->bind_result($loc);
            $query->fetch();
            if(isset($loc)) {
                $query->fetch();
                findVendorForJob($mysqli, $data['job#'], $loc);
            }
        }
    }

    function acceptCall($mysqli, $data) {
        if ($query = $mysqli->prepare('UPDATE messages SET stop = 1 WHERE uid = ? AND stop = 0')) {
            $query->bind_param('s', $data['request']);
            $query->execute();
        }
        if ($query = $mysqli->prepare('UPDATE requests SET vendor_uid = ?, serviceStatus = 20 WHERE uid = ?')) {
            $query->bind_param('ii', $data['res#'], $data['job#']);
            $query->execute();
        }
    }

    function callInfo($mysqli, $data) {
        if($query = $mysqli->prepare('SELECT serviceDescription FROM requests WHERE uid = ?')) {
            $query->bind_param('i', $data['job#']);
            $query->execute();
            $query->bind_result($desc);
            $query->fetch();
            if(isset($desc)) {
                $query->fetch();
                return 'Job #' . $data['job#'] . ': ' . $desc;
            }
        }
    }

?>