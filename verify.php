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
  <script src="public/javascripts/loginpage.js"></script>
  <title>Login</title>
</head>
<body>
	<div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px"></a>
  </div>
	<div id="verifybox"></br>
    <h1>Account Verification</h1>
    <center>
    <br/><strong>
  	<?php
        require('controllers/configurator.php');
        $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
        if(isset($_GET['lnk'])) {
            if($query = $mysqli->prepare('SELECT verified, vhash FROM user WHERE vhash = ?;')) {
                $query->bind_param("s", $_GET['lnk']);
                $query->execute();
                $query->bind_result($ver, $hash);
                $query->fetch();
                if (isset($ver)) {
                    $nul = "NULL";
                    $query->fetch();
                    $query2 = $mysqli->prepare('UPDATE user SET verified = 1, vhash = NULL WHERE vhash = ?;');
                    if($query2) {
                        $query2->bind_param('s', $_GET['lnk']);
                        $query2->execute();
                        echo("Account Verified!<br/>Thanks!");
                    } else {
                        echo("Unable to verify at this time!<br/>");
                    }
                } else {
                    echo("Link has expired or is no longer valid.<br/>");
                }
            }
        } else {
            header('Location: index.php');
        }
        $mysqli->close();
    ?></strong><br/><br/>
    <button id="la" onClick="window.location='index.php'">Return to Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
    </center>
	</div>
</body>
</html>