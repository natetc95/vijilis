<?php

    require('../configurator.php');
    require('../verification.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    if(isset($_POST['uid'])) {
        $uid = $_POST['uid'];
        $o = array('status' => 'FAIL', 'code' => '');
        $o['code'] = $uid;
        if ($query = $mysqli->prepare('UPDATE user SET fobVeri = ?, fobHash = ? WHERE uid = ?')) {
            $query->bind_param('isi', $_POST['pin'], $_POST['hsh'], $uid);
            $query->execute();
            $o['code'] = '<br/>Updated user ' . $uid . '!<br/>';
            $o['status'] = 'SUCC';
        }
        echo(json_encode($o));
    } else {
        echo('NOOOOOOO');
    }

?>