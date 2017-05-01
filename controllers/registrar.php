<?php

    require('configurator.php');
    require('verification.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function base_user_register($mysqli, $uname, $pword, $fname, $lname, $email, $telnum) {
        $hash = password_hash($pword, PASSWORD_BCRYPT);
        $vhash = md5($uname . rand(0,5000));
        if(password_verify($pword, $hash)) {
            if($query = $mysqli->prepare('INSERT INTO user VALUES (0, ?, ?, ?, ?, ?, ?, 0, 0, ?, 1, 0, 0, 0, 0, 0, 3);')) {
                $query->bind_param('sssssss', $uname, $email, $hash, $fname, $lname, $telnum, $vhash);
                $query->execute();
                if($query = $mysqli->prepare('SELECT uid FROM user WHERE username = ?;')) {
                    $query->bind_param('s', $uname);
                    $query->execute();
                    $query->bind_result($uid);
                    $query->execute();
                    if(isset($uid)) {
                        $query->fetch();
                        chdir('../userfiles');
                        mkdir('u' . $uid, 0777, true);
                    }
                }
            }
        }
        $mysqli->close();
        EVerify($email, $fname, $vhash);
    }

    function create_vendor_profile($mysqli, $userid) {
        if($query = $mysqli->prepare('INSERT INTO vendor VALUES (0, ?, 0, 0, "{}", "{}", 0, "PAYPAL");')) {
            $query->bind_param('i', $userid);
            $query->execute();
            if($query = $mysqli->prepare('SELECT uid FROM vendor WHERE user_uid = ?;')) {
                $query->bind_param('i', $userid);
                $query->execute();
                $query->bind_result($uid);
                $query->fetch();
                if(isset($uid)) {
                    $query->fetch();
                    chdir('../userfiles/u' . $userid);
                    mkdir('v' . $uid, 0777, true);
                }
            }
        }
        $mysqli->close();
    }

    if (isset($_POST['action'])) {
        switch($_POST['action']) {
        case 'registrationPage':
            base_user_register($mysqli, $_POST['uname'], $_POST['pword'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['telnum']);
            break;
        case 'vendorRegistration':
            create_vendor_profile($mysqli, $_POST['uuid']);
            break;
        }
    }

?>
