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
  <title>418 I'm a Teapot</title>
</head>
<body>
	<div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px"></a>
  </div>
	<div id="loginbox" style="height: 400px;"></br>
    <h1>418</h1>
    <center><br/>
        <b>418</b> I'm A Teapot.<br/><br/>
        The requested entity body is short and stout.<br/>
        Tip me over and pour me out.<br/><br/>
        It appears that something has gone awry.<br/>
        You should never have reached this page!<br/>
        Please report this to the Webmaster immediately!<br/><br/>
        <a href="mailto:webmaster@vijilis.mobi?Subject=418%20Error%20Page%20Reached">webmaster@vijilis.mobi</a><br/><br/>
        <button id="la" onClick="window.location='index.php'">Return to Login <i class="fa fa-sign-in" aria-hidden="true"></i></button>
    </center>
	</div>
</body>
</html>

<?php

    session_start();
    session_unset();
    session_destroy();
    header("HTTP/1.1 418 I'm a teapot.");
    header("Status: 418 I'm a teapot.");
    die();

?>