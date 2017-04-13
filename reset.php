<!DOCTYPE html>
<html lang="en">
<head>
  <base href="./">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type='text/css' href='public/stylesheets/styles.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="public/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel='icon' href='public/images/icon.ico'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="public/javascripts/resetpage.js"></script>
  <title>Reset Password</title>
</head>
<body>
	<div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px"></a>
  </div>
	<div id="resetbox"></br>
    <h1>Reset Your Password</h1>
    <center id="xxx">
    <br/>
  	<?php
        require('controllers/configurator.php');
        $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
        if(isset($_GET['lnk'])) {
            if($query = $mysqli->prepare('SELECT fname, lname, email, fhash FROM user WHERE fhash = ?;')) {
                $query->bind_param("s", $_GET['lnk']);
                $query->execute();
                $query->bind_result($fname, $lname, $email, $hash);
                $query->fetch();

                $nul = "NULL";
                $query->fetch();
                $query2 = $mysqli->prepare('UPDATE user SET fhash = NULL WHERE fhash = ?;');
                if($query2) {
                    $query2->bind_param('s', $_GET['lnk']);
                    $query2->execute();

                    echo ("Resetting password for: <br/>$fname $lname<br/>");
                    echo ("");
                    echo ('<span class="fa fa-envelope fa-entry fa2"></span><input require id="pw1" class="fa2 inputicon" type="password" placeholder="New Password" onkeyup="strengthTestPassword()"/>');
                    echo ('<span class="fa fa-envelope fa-entry fa2"></span><input require id="pw2" class="fa2 inputicon" type="password" placeholder="Re-Enter New Password " onkeyup="validatePasswords()"/>');

                } else {
                    echo("Link has expired or is no longer valid.<br/>");
                }
            }
        } else {
            header('Location: index.php');
        }
        $mysqli->close();
    ?><br/><br/>
    </center>
    <button id="la" style="float: left; margin-left: 10px;" onClick="window.location='index.php'"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Cancel</button>
    <button id="la" style="float: right; margin-right: 10px;" onClick="resetPassword()">Reset&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
	</div>
</body>
</html>
<!-- TODO: verify fhash, fix how updates resetbox size, insert password (how to get name), send email-->
