<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type='text/css' href='styles.css' rel='stylesheet'>
  <link rel='icon' href='./icon.ico'>
  <title>Login</title>
</head>
<body>
	<div class="headerbar">
		<a href="./index.php"><img src="logo_rn.png" height="80%" style="padding-top: 8px; padding-left: 5px;"></a>
	</div>
  <div id="bar"></div>
	<div id="loginbox"></br>
		<form action="login.php" method="post">
		Username / Email:<input type="text" name="name"></br></br>
		Password:<input type="password" name="email"></br><a class="pa" href="./logout.php">Forgot Password?</a>&nbsp;<a class="pa" href="./register.php">Register</a></br></br>
		<input value="Log In ➤" type="submit">
		</form>
	</div>
</body>
</html>
