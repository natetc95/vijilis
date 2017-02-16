<?php
  if(isset($_POST["pw"]) && isset($_POST["un"])) {
    if($_POST["un"] == "natetc95" || $_POST["un"] == "troser") {
      echo('{
         "loginstat": "SUCC",
         "username": "natetc95"
      }');
    } else {
      echo('{
         "loginstat": "FAIL",
         "username": "natetc95",
         "error": "1"
      }');
    }
  }
?>
