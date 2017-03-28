<?php
  ob_start();
  session_start();
  ob_end_clean();
  
  if(isset($_SESSION['uid'])) {

    // A session exists! Lets make sure that it is valid!
    $uidS = $_SESSION['uid'];
    $name = $_SESSION['name'];
    $id = $_SESSION['acct'];

    require('configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    
    if($query = $mysqli->prepare('SELECT uid, acttype, username, tSession, hSession FROM user WHERE uid = ?;')) {
        $query->bind_param('i', $uidS);
        $query->execute();
        $query->bind_result($uid, $act, $uname, $tSession, $hSession);
        $query->fetch();
        if(isset($uid)) {
            $query->fetch();
            $newmd5 = md5($uidS . $name . $id . $tSession . session_id());
            if(strcmp($newmd5, $hSession) == 0) {
              if($tSession > time()) {
                $time = time() + 3600;
                $hSession = md5($uid . $name . $act . $time . session_id());
                if($query = $mysqli->prepare("UPDATE user SET tSession = ?, hSession = ? WHERE uid = ?")) {
                    $query->bind_param('isi', $time, $hSession, $uid);
                    $query->execute();
                }
              } else {
                header('Location: ../errors/403.php');
                die();
              }
            } else {
              header('Location: ../errors/403.php');
              die();
            }
        }
    }

    $mysqli->close();
  
  } else {

    // If the session is not set, then we want to throw a '403 Forbidden' error

    header('Location: ../errors/403.php');
    die();

  }  

?>
