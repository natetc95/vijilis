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
  <script src="public/javascripts/registerpage.js"></script>
  <title>Login</title>
</head>
<body>
	<div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="80%" style="padding-top: 8px; padding-left: 5px;"></a>
    <br/>
    <div id="bar"></div>
  </div>
	<div id="registerbox"></br>
    <h1>Account Registry</h1>
    <center>
      <span class="fa fa-user-circle-o fa-entry fa2"></span><input require id="fname" class="fa2" type="text" placeholder="Username" onkeypress="handle(event)"/>
  	  <span class="fa fa-user-circle-o fa-entry fa2"></span><input require id="fname" class="fa2" type="text" placeholder="First Name" onkeypress="handle(event)"/>
  	  <span class="fa fa-users fa-entry fa2"></span><input id="lname" type="text" class="fa2" placeholder="Last Name" onkeypress="handle(event)"/>
      <span class="fa fa-envelope fa-entry fa2"></span><input id="email" type="text" class="fa2" placeholder="Email" onkeypress="handle(event)"/>
      <span class="fa fa-phone fa-entry fa2"></span><input id="tel" type="tel" class="fa2" placeholder="Mobile Phone Number" onkeyup="handle(event, 2)"/>
      <span class="fa fa-key fa-entry fa2"></span><input id="pw1" type="password" class="fa2" placeholder="Password" onkeyup="handle(event, 3)"/>
      <span class="fa fa-key fa-entry fa2"></span><input id="pw2" type="password" class="fa2" placeholder="Re-Enter Password" onkeyup="handle(event, 3)"/>
    </center>
    <button style="float: left; margin: 10px;" onclick="Logout()"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button>
    <button id="relevant" style="float: right; margin: 10px;" onClick="submitLogin()">Register&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
	</div>
</body>
</html>
