<?php
session_start();
$o = array('status' => 'FAIL', 'code' => '');
if(isset($_SESSION['action'])){
    require('configurator.php');
    require('resetpass.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    $email = $_SESSION['email'];

    // if($query = $mysqli->prepare('UPDATE user SET fhash = ? WHERE email = ?;')) {
    //     $query->bind_param('ss', $fhash, $email);
    //     $query->execute();
    //     if($query = $mysqli->prepare('SELECT fname FROM user WHERE email = ?;')) {
    //         $query->bind_param('s', $email);
    //         $query->execute();
    //         $query->bind_result($fname);
    //         $query->fetch();
    //     }
    // }
    $o['code'] = $email;

    $mysqli->close();
    //EReset($email, $fname, $fhash);
  } else{
    $o['code'] = 'Failed to gather email from session.';
  }
  echo (json_encode($o));
?>
