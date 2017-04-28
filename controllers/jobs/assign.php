<?php

    require('../twilio/messaging.php');
    require('../configurator.php');
    require('../verification.php');
    session_start();
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function distance($j, $r) {

        $json_j = json_decode($j, true);
        $json_r = json_decode($r, true);

        $jlat = $json_j['lat'];
        $jlng = $json_j['lng'];
        $rlat = $json_r['lat'];
        $rlng = $json_r['lon'];

        $theta = $jlng - $rlng;
        $dist = sin(deg2rad($jlat)) * sin(deg2rad($rlat)) +  cos(deg2rad($jlat)) * cos(deg2rad($rlat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        return $miles;
    }

    function findVendorForJob($mysqli, $jobNumber, $j) {
        $o = array();
        $v = array();
        $vendors = array();
        if($query = $mysqli->prepare('SELECT resourceLocation, uid, vendor_uid, resourceTitle FROM resource WHERE active = 1 AND resourceWasDeleted = 0 AND resourceType = 0')) {
            $query->execute();
            $query->bind_result($rL, $uid, $vid, $rT);
            while($query->fetch()) {
                $v['dist'] = distance($j, $rL);
                $v['uid'] = $uid;
                $v['vid'] = $vid;
                $v['title'] = $rT;
                array_push($vendors, $v);
            }
        }
        usort($vendors, function ($item1, $item2) {
            return $item1['dist'] <= $item2['dist'];
        });
        messageSelectedVendor($mysqli, $jobNumber, $vendors[0]);
        return $vendors[0];
    }

    function messageSelectedVendor($mysqli, $job, $vendor) {
        if($query = $mysqli->prepare('SELECT user_uid FROM vendor WHERE uid = ?')) {
            $query->bind_param('i', $vendor['vid']);
            $query->execute();
            $query->bind_result($uid);
            $query->fetch();
            if (isset($uid)) {
                $query->fetch();
                if($query = $mysqli->prepare('SELECT telnum, fname FROM user WHERE uid = ?')) {
                    $query->bind_param('i', $uid);
                    $query->execute();
                    $query->bind_result($telnum, $fname);
                    $query->fetch();
                    if (isset($uid)) {
                        $query->fetch();
                        $telnum = str_ireplace('-', '', str_ireplace(' ', '', $telnum));
                        $telnum = '+1' . $telnum;
                        $str = 'Hi ' . $fname . '! Job #' . $job . ' is availabe for your resource: ' . $vendor['title'] . '. Approximately ' . sprintf('%.1f',$vendor['dist']) . ' miles away from your last check in. Text back to accept or decline.';
                        sendMessage($telnum, $str);
                    }
                }
            }
        }
    }

?>
