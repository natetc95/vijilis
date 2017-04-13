<?php
    require('configurator.php');
    require('resetpass.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    $email = $_POST['email'];
    $fhash = md5($email . rand(0,5000));

    $o = array('status' => 'FAIL', 'code' => '');

    if($query = $mysqli->prepare('UPDATE user SET fhash = ? WHERE email = ?')) {
        $query->bind_param('ss', $fhash, $email);
        $query->execute();
        $o['code'] = 'Updated fhash successful.';
        if($query = $mysqli->prepare('SELECT fname FROM user WHERE email = ?')) {
            $query->bind_param('s', $email);
            $query->execute();
            $query->bind_result($fname);
            $query->fetch();
            $o['status'] = 'SUCC';
            $o['code'] = 'Reset validation successful, sending email.';
            EReset($email, $fname, $fhash);
        }
    }
    echo (json_encode($o));
    $mysqli->close();
?>
