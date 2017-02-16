<!DOCTYPE html>
<html lang="en">
<head>
  <base href="./">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type='text/css' href='public/stylesheets/styles.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel='icon' href='public/images/icon.ico'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="public/javascripts/loginpage.js"></script>
  <title>Login</title>
</head>
<body>
	<div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="80%" style="padding-top: 8px; padding-left: 5px;"></a>
    <br/>
    <div id="bar"></div>
  </div>
	<div id="loginbox"></br>
    <h1>Login</h1><hr/>
  	<input id="_uname" type="text" name="name" placeholder="Username" onkeypress="handle(event)"/><br/>
  	<input id="_pwd" type="password" name="email" placeholder="Password" onkeypress="handle(event)"/><br/>
    <center>
      <a class="pa" href="views/forgotpass.php">Forgot Password?</a>&nbsp;<a class="pa" href="views/register.php">Register</a><br/><br/>
      <button id="la" onClick="submitLogin()">Log In ➤</button>
    </center>
	</div>
</body>
</html>
