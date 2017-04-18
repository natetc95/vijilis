<?php

    require('../configurator.php');
    require('../verification.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function createVendor($mysqli, $username, $password, $email, $first, $last, $telnum) {
        $o = array('status' => 'FAIL', 'code' => '', 'email' => '');

        $hash = password_hash($password, PASSWORD_BCRYPT);
        if(password_verify($password, $hash)) {
            if($query = $mysqli->prepare('INSERT INTO user VALUES (0, ?, ?, ?, ?, ?, ?, 1, 0, NULL, 1, 0, 0, 0, 0, 0);')) {
                $query->bind_param('ssssss', $username, $email, $hash, $fname, $lname, $telnum);
                $query->execute();
                if($query = $mysqli->prepare('SELECT uid FROM user WHERE username = ?;')) {
                    $query->bind_param('s', $username);
                    $query->execute();
                    $query->bind_result($uid);
                    $query->fetch();
                    if(isset($uid)) {
                        $query->fetch();
                        $o['code'] = $uid;
                        $o['email'] = adminCreatedEmail($email, $first, $username, $password, 'Vendor');
                        $o['status'] = 'SUCC';
                        chdir('../../userfiles');
                        mkdir('u' . $uid);
                        mkdir('u' . $uid . '/oldprofiles');
                    }
                }
            }
        }
        echo(json_encode($o));
    }

    function createIncidentManager($mysqli, $username, $password, $email, $first, $last, $telnum) {
        $o = array('status' => 'FAIL', 'code' => '', 'email' => '');

        $hash = password_hash($password, PASSWORD_BCRYPT);
        if(password_verify($password, $hash)) {
            if($query = $mysqli->prepare('INSERT INTO user VALUES (0, ?, ?, ?, ?, ?, ?, 1, 0, NULL, 2, 0, 0, 0, 0, 0);')) {
                $query->bind_param('ssssss', $username, $email, $hash, $fname, $lname, $telnum);
                $query->execute();
                if($query = $mysqli->prepare('SELECT uid FROM user WHERE username = ?;')) {
                    $query->bind_param('s', $username);
                    $query->execute();
                    $query->bind_result($uid);
                    $query->fetch();
                    if(isset($uid)) {
                        $query->fetch();
                        $o['code'] = $uid;
                        $o['email'] = adminCreatedEmail($email, $first, $username, $password, 'Incident Manager');
                        $o['status'] = 'SUCC';
                        chdir('../../userfiles');
                        mkdir('u' . $uid);
                        mkdir('u' . $uid . '/oldprofiles');
                    }
                }
            }
        }
        echo(json_encode($o));
    }

    if(isset($_POST['action'])) {
        $a = $_POST['action'];
        switch($a) {
            case 'createVendor':
                createVendor($mysqli, $_POST['uname'], $_POST['pword'], $_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['telnum']);
                break;
            case 'createIncidentManager':
                createIncidentManager($mysqli, $_POST['uname'], $_POST['pword'], $_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['telnum']);
                break;
            default:
                echo(json_encode(array('status' => 'FAIL', 'code' => "You didn't send a proper request! Your action request: $a")));
        }
    }

    $mysqli->close();

?>