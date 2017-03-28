<!DOCTYPE html>
<html lang="en">
<head>
  <base href="../">
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
  <title>404 Page Not Found</title>
</head>
<body>
	<div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px"></a>
  </div>
	<div id="loginbox"></br>
    <h1>404</h1>
    <center><br/>
        <b>404</b> Page Not Found<br/><br/>
        We're sorry!<br/>
        We can't find the page you are looking for!<br/><br/>
        <button id="la" onClick="window.location='index.php'">Return to Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
    </center>
	</div>
</body>
</html>

<?php

    header("HTTP/1.1 404 Page Not Found");
    header("Status: 403 Page Not Found");
    die();

?>