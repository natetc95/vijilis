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
	<div id="loginbox"></br>
    <h1>Login</h1>
    <center>
  	  <span class="fa fa-user-circle-o fa-entry fa2"></span><input id="_uname"  class="fa2 inputicon" type="text" name="name" placeholder="Username" onkeypress="handle(event)"/>
  	  <span class="fa fa-key fa-entry fa2"></span><input id="_pwd" class="fa2 inputicon" type="password" name="email" placeholder="Password" onkeypress="handle(event)"/><br/>
      <a class="pa" href="forgotpass.php">Forgot Password?</a>&nbsp;<a class="pa" href="register.php">Register</a><br/><br/>
      <button id="la" onClick="submitLogin()">Log In <i class="fa fa-sign-in" aria-hidden="true"></i></button>
    </center>
	</div>
</body>
</html>
