<?php

    error_reporting(E_ALL);
	ini_set("display_errors","On");
    chdir(__DIR__);
    require(getcwd() . '/../configurator.php');
    require(getcwd() . '/../verification.php');
    require(getcwd() . '/../twilio/messaging.php');
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

    function findVendorForJob($mysqli, $jobNumber, $j, $resreq) {
        $o = array();
        if($query = $mysqli->prepare('SELECT uid, vendor_uid, resourceTitle, resourceLocation FROM resource WHERE resourceType = ? AND approved = 1 AND active = 1 AND engaged = 0 AND resourceWasDeleted = 0')) {
            $query->bind_param('i', $resreq);
            $query->execute();
            $query->bind_result($uid, $vid, $rti, $rlo);
            while($query->fetch()) {
                $v = array();
                $v['uid'] = $uid;
                $v['vid'] = $vid;
                $v['title'] = $rti;
                $v['dist'] = distance($j, $rlo);
                array_push($o, $v);
            }
        }
        if (count($o) > 0) {
            usort($o, function ($item1, $item2) {
                return $item1['dist'] >= $item2['dist'];
            });
            if ($query = $mysqli->prepare('UPDATE requests SET serviceStatus = 10 WHERE uid = ?')) {
                $query->bind_param('i', $jobNumber);
                $query->execute();
            }
            return messageVendor($mysqli, $o[0], $jobNumber);
        } else {
            if ($query = $mysqli->prepare('UPDATE requests SET serviceStatus = 1 WHERE uid = ?')) {
                $query->bind_param('i', $jobNumber);
                $query->execute();
            }
            return 'No Available Vendors!';
        }
        
    }

    function messageVendor($mysqli, $v, $j) {
        $o = array('vendor' => $v);
        if($query = $mysqli->prepare('SELECT user_uid FROM vendor WHERE uid = ?')) {
            $query->bind_param('i', $v['vid']);
            $query->execute();
            $query->bind_result($uid);
            $query->fetch();
            if(isset($uid)) {
                $query->fetch();
                $o['uid'] = $uid;
                if($query = $mysqli->prepare('SELECT telnum, fname FROM user WHERE uid = ?')) {
                    $query->bind_param('i', $uid);
                    $query->execute();
                    $query->bind_result($t, $f);
                    $query->fetch();
                    if(isset($uid)) {
                        $query->fetch();
                        $t = str_ireplace('-', '', str_ireplace(' ', '', $t));
                        $t = '+1' . $t;
                        $o['tel'] = $t;
                        $o['msg'] = "Hi " . $f . "! Job #" . $j . " is available for your resource: " . $v['title'] . " (" . $v['uid'] . "). Approximately " . sprintf('%.1f',$v['dist']) . " miles away from your last check in. Please text back 'accept' or 'decline'.";
                        $o['err'] = sendMessage($t, $o['msg']);
                        if($query = $mysqli->prepare('INSERT INTO messages VALUES (0, ?, ?, 1, ?, ?, 0, ?)')) {
                            $query->bind_param('ssiid', $t, $f, $j, $v['uid'], $v['dist']);
                            $query->execute();
                        }
                        if($query = $mysqli->prepare('UPDATE resource SET engaged = ? WHERE uid = ?')) {
                            $query->bind_param('ii', $j, $v['uid']);
                            $query->execute();
                        }
                    }
                }
            }
        }
        return $o;
    }


?>
