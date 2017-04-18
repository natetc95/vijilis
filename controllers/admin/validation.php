<?php

    require('../configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function confirmEmail($mysqli, $em) {
        $o = array('status' => 'FAIL', 'code' => '');
        if($query = $mysqli->prepare("SELECT count(*) FROM user WHERE email = ?")) {
            $query->bind_param("s", $em);
            $query->execute();
            $query->bind_result($cnt);
            $query->fetch();
            if(isset($cnt)) {
                $query->fetch();
                if ($cnt == 0) {
                    $o['status'] = 'SUCC';
                }
                $o['code'] = $cnt;
            }
        }
        echo(json_encode($o));
    }

    function confirmPhone($mysqli, $telnum) {
        $o = array('status' => 'FAIL', 'code' => '');
        $tel2 = str_replace('-', '', $telnum);
        if($query = $mysqli->prepare("SELECT count(*) FROM user WHERE telnum = ? OR telnum = ?")) {
            $query->bind_param("ss", $telnum, $tel2);
            $query->execute();
            $query->bind_result($cnt);
            $query->fetch();
            if(isset($cnt)) {
                $query->fetch();
                if ($cnt == 0) {
                    $o['status'] = 'SUCC';
                }
                $o['code'] = $cnt;
            }
        }
        echo(json_encode($o));
    }

    if(isset($_POST['action'])) {
        $a = $_POST['action'];
        switch($a) {
            case 'confirmEmail':
                confirmEmail($mysqli, $_POST['email']);
                break;
            default:
                echo(json_encode(array('status' => 'FAIL', 'code' => "You didn't send a proper request! Your action request: $a")));
        }
    }

    $mysqli->close();

?>