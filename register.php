<!DOCTYPE html>
<html lang="en">
<head>
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
  <title>Register</title>
</head>
<body>
  <div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px"></a>
  </div>
  <br></br>
	<div id="registerbox"></br>
    <h1>Account Registry</h1>
    <center id="xxx">
      <span class="fa fa-user-circle-o fa-entry fa2"></span><input require id="uname" class="fa2 inputicon" type="text" placeholder="Username" onkeyup="validateUsername()"/>
  	  <span class="fa fa-user-circle-o fa-entry fa2"></span><input require id="fname" class="fa2 inputicon" type="text" placeholder="First Name"/>
  	  <span class="fa fa-users fa-entry fa2"></span><input id="lname" type="text" class="fa2 inputicon" placeholder="Last Name"/>
      <span class="fa fa-envelope fa-entry fa2"></span><input id="email" type="text" class="fa2 inputicon" placeholder="Email" onkeyup="validateEmail()"/>
      <span class="fa fa-phone fa-entry fa2"></span><input id="tel" type="text" class="fa2 inputicon" placeholder="Mobile Phone Number" onkeyup="validatePhoneNumber()"/>
      <span class="fa fa-key fa-entry fa2"></span><input id="pw1" type="password" class="fa2 inputicon" placeholder="Password" onkeyup="validatePasswords(); strengthTestPassword();"/>
      <span class="fa fa-key fa-entry fa2"></span><input id="pw2" type="password" class="fa2 inputicon" placeholder="Re-Enter Password" onkeyup="validatePasswords(); strengthTestPassword();"/>
    </center>
    <button style="float: left; margin: 10px;" onclick="window.location='index.php'"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button>
    <button id="relevant" style="float: right; margin: 10px;" onClick="submitToRegistrar()">Register&nbsp;</i></button>
	</div>
</body>
</html>
