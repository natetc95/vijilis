<?php
    require('configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    $email = $_POST['email'];
    $fhash = md5(rand(0,5000));

    if($query = $mysqli->prepare('UPDATE user SET fhash = ? WHERE email = ?;')) {
        $query->bind_param('ss', $fhash, $email);
        $query->execute();
        if($query = $mysqli->prepare('SELECT fname FROM user WHERE email = ?;')) {
            $query->bind_param('s', $email);
            $query->execute();
            $query->bind_result($fname);
            $query->fetch();
        }
    }

    $mysqli->close();
    require('resetpass.php');
    EReset($email, $fname, $fhash);
?>
