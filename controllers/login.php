<?php
  session_start();
  if(isset($_POST["pw"]) && isset($_POST["un"])) {
    if($_POST["un"] == "natetc95" || $_POST["un"] == "troser") {
      echo('{
         "loginstat": "SUCC",
         "username": "natetc95"
      }');
      $_SESSION['name'] = $_POST["un"];
      $_SESSION['acct'] = 4;
    } else {
      echo('{
         "loginstat": "FAIL",
         "username": "natetc95",
         "error": "1"
      }');
    }
  }
?>
