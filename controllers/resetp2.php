<?php
session_start();
require('configurator.php');
require('passResetEmail.php');
if(isset($_SESSION['action'])){
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    $email = $_SESSION['email'];
    $pword = $_POST['pword'];
    if($query = $mysqli->prepare('SELECT fname FROM user WHERE email = ?')) {
        $query->bind_param('s', $email);
        $query->execute();
        $query->bind_result($fname);
        $query->fetch();

        if(isset($fname)){
          $hash = password_hash($pword, PASSWORD_BCRYPT);
          $query->fetch();
          if(password_verify($pword, $hash)) {
            if($query = $mysqli->prepare('UPDATE user SET password = ? WHERE email = ?')) {
              $query->bind_param('ss', $hash, $email);
              $query->execute();
              EReset2( $email, $fname );
            }
          }
        }
    }
    $mysqli->close();
  }

?>
