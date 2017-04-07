<?php
    require('configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $telnum = $_POST['telnum'];
    $hash = password_hash($pword, PASSWORD_BCRYPT);
    $vhash = md5(rand(0,5000));
    if(password_verify($pword, $hash)) {
        if($query = $mysqli->prepare('INSERT INTO user VALUES (0, ?, ?, ?, ?, ?, ?, 0, ?, 1, 0);')) {
            $query->bind_param('sssssss', $uname, $email, $hash, $fname, $lname, $telnum, $vhash);
            $query->execute();
            if($query = $mysqli->prepare('SELECT uid FROM user WHERE username = ?;')) {
                $query->bind_param('s', $uname);
                $query->execute();
                $query->bind_result($uid);
                $query->fetch();
                if(isset($uid)) {
                    $query->fetch();
                    chdir('../userfiles');
                    mkdir($uid);
                }
            }
        }
    }
    $mysqli->close();
    require('verification.php');
    EVerify($email, $fname, $vhash);
?>
