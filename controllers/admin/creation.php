<?php

    require('../configurator.php');
    require('../verification.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function createVendor($mysqli, $username, $password, $email, $first, $last, $telnum) {
        $o = array('status' => 'FAIL', 'code' => '', 'email' => '');

        $hash = password_hash($password, PASSWORD_BCRYPT);
        if(password_verify($password, $hash)) {
            if($query = $mysqli->prepare('INSERT INTO user VALUES (0, ?, ?, ?, ?, ?, ?, 1, 0, NULL, 1, 0, 0, 0, 0, 0, 3);')) {
                $query->bind_param('ssssss', $username, $email, $hash, $first, $last, $telnum);
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
                        mkdir('u' . $uid, 0777, true);
                        mkdir('u' . $uid . '/oldprofiles', 0777, true);
                    }
                }
            }
        }
        echo(json_encode($o));
    }

    function createAdmin($mysqli, $username, $password, $email, $first, $last, $telnum) {
        $o = array('status' => 'FAIL', 'code' => '', 'email' => '');

        $hash = password_hash($password, PASSWORD_BCRYPT);
        if(password_verify($password, $hash)) {
            if($query = $mysqli->prepare('INSERT INTO user VALUES (0, ?, ?, ?, ?, ?, ?, 1, 0, NULL, 7, 0, 0, 0, 0, 0, 3);')) {
                $query->bind_param('ssssss', $username, $email, $hash, $first, $last, $telnum);
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
                        mkdir('u' . $uid, 0777, true);
                        mkdir('u' . $uid . '/oldprofiles', 0777, true);
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
            if($query = $mysqli->prepare('INSERT INTO user VALUES (0, ?, ?, ?, ?, ?, ?, 1, 0, NULL, 2, 0, 0, 0, 0, 0, 3);')) {
                $query->bind_param('ssssss', $username, $email, $hash, $first, $last, $telnum);
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
                        mkdir('u' . $uid, 0777, true);
                        mkdir('u' . $uid . '/oldprofiles', 0777, true);
                    }
                }
            }
        }
        echo(json_encode($o));
    }

    function createDistrict($mysqli, $bounding, $cname, $email, $telnum, $dname, $color, $city, $state) {
        $o = array('status' => 'FAIL', 'code' => '');
        if($query = $mysqli->prepare('INSERT INTO districts VALUES (0, ?, "AZ", ?, ?, ?, ?, ?, ?, ?);')) {
            $query->bind_param('ssssss', $dname, $cname, $email, $telnum, $bounding, $color, $city, $state);
            $query->execute();
            if($query = $mysqli->prepare('SELECT uid FROM districts WHERE name = ?;')) {
                $query->bind_param('s', $dname);
                $query->execute();
                $query->bind_result($uid);
                $query->fetch();
                if(isset($uid)) {
                    $query->fetch();
                    $o['code'] = $uid;
                    $o['status'] = 'SUCC';
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
            case 'createAdmin':
                createAdmin($mysqli, $_POST['uname'], $_POST['pword'], $_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['telnum']);
                break;
            case 'createIncidentManager':
                createIncidentManager($mysqli, $_POST['uname'], $_POST['pword'], $_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['telnum']);
                break;
            case 'createDistrict':
                createDistrict($mysqli, json_encode($_POST['data']), $_POST['cname'], $_POST['email'], $_POST['telnum'], $_POST['dname'], $_POST['color'], $_POST['city'], $_POST['state']);
                break;
            default:
                echo(json_encode(array('status' => 'FAIL', 'code' => "You didn't send a proper request! Your action request: $a")));
        }
    }

    $mysqli->close();

?>
