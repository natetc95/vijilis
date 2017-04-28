<?php

    function getRequestData($mysqli, $From) {
        $o = array('status' => 'FAIL', 'data' => array());
        if ($query = $mysqli->prepare('SELECT uid, name, messageType, refNum, resNum FROM messages WHERE tel = ?')) {
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
        if ($query = $mysqli->prepare('DELETE FROM messages WHERE tel = ?')) {
            $query->bind_param('s', $From);
            $query->execute();
            $o['status'] = 'SUCC';
        }
    }

?>