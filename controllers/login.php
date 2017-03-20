<?php
  session_start();
  require('configurator.php');
  $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
  if(isset($_POST["pw"]) && isset($_POST["un"])) {
    if($query = $mysqli->prepare("SELECT uid, username, password, verified, acttype FROM user WHERE username = ?")) {
      $query->bind_param("s", $_POST["un"]);
      $query->execute();
      $query->bind_result($uid, $uname, $pw, $ver, $act);
      $query->fetch();
      if($uname == $_POST["un"] && password_verify($_POST["pw"], $pw) && $ver == 1) {
        echo('{
         "loginstat": "SUCC",
         "username": "natetc95",
         "error": "USER EXISTS, IS VERIFIED, AND PASSWORD IS CORRECT"
        }');
        $_SESSION['name'] = $_POST["un"];
        $_SESSION['uid'] = $uid;
        $_SESSION['acct'] = $act;
      } else if ($uname == $_POST["un"] && password_verify($_POST["pw"], $pw)) {
        echo('{
          "loginstat": "FAIL",
          "username": "natetc95",
          "error": "USER EXISTS AND PASSWORD IS CORRECT"
        }');
      }
      else if($ver == 1 && !password_verify($_POST["pw"], $pw)) {
        echo('{
          "loginstat": "FAIL",
          "username": "natetc95",
          "error": "USER EXISTS AND IS VERIFIED BUT PW IS NOT CORRECT"
        }');
      }
      else {
        echo('{
          "loginstat": "FAIL",
          "username": "natetc95",
          "error": ' . $uname . " " . $_POST["un"] . '
        }');
      }
    } else {
      $s = $mysqli->error;
      echo('{
         "loginstat": "FAIL",
         "username": "natetc95",
         "error": "2"
      }');
    }
  }
  $mysqli->close();
?>
