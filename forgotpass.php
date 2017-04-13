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
  <script src="public/javascripts/resetpage.js"></script>
  <title>Forgot Password</title>
</head>
<body>
  <div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px"></a>
  </div>
  <div id="forgotpassbox"></br>
    <h1>Reset Password</h1>
    <center id="xxx">
      <br><span class="fa fa-envelope fa-entry fa2"></span><input require id="email" class="fa2 inputicon" type="text" placeholder="Email" onkeyup="validateEmail()"/>
    </center>

    <button style="float: left; margin: 10px;" onclick="window.location='index.php'"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button>
    <button id="relevant" style="float: right; margin: 10px;" onClick="submitToReset()">Reset&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
  </div>
</body>
</html>