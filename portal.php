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
  <title>Portals</title>
</head>
<?php
  session_start();
  require('controllers/sessionHandler.php');
  $id = $_SESSION['acct'];
  $size = 0;
  if(($id & 1) == 1) {
    $size++;
  } 
  if(($id & 2) == 2) {
    $size++;
  }
  if(($id & 4) == 4) {
    $size++;
  }
  if(($id & 8) == 8) {
    $size++;
  }
  $size = $size*65 + 130;
?>
<body>
	<div class="headerbar">
		<a href="portal.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px"></a>
  </div>
	<div id="portalbox" style="height: <?php echo($size)?>px"></br>
    <h1>Available Portals</h1>
    <center>
      <?php if(($id & 1) == 1) {?>
      <a class="portal-div" href="v/index.php">
    	  <div class="portal-link">
          <i class="fa fa-truck fa-2x" style="float: left" aria-hidden="true"></i>
          <div class="portal-text">Vendor Portal</div>
        </div>
      </a><?php } if(($id & 2) == 2) { ?>
      <a class="portal-div plminus" href="im/index.php">
    	  <div class="portal-link">
          <i class="fa fa-user-plus fa-2x" style="float: left" aria-hidden="true"></i>
          <div class="portal-text">Incident Manager Portal</div>
        </div>
      </a><?php } if(($id & 4) == 4) {?>
      <a class="portal-div plminus" href="a/index.php">
    	  <div class="portal-link">
          <i class="fa fa-user-secret fa-2x" style="float: left" aria-hidden="true"></i>
          <div class="portal-text">Admin Portal</div>
        </div>
      </a><?php } if(($id & 8) == 8) {?>
      <a class="portal-div plminus" href="views/billing/index.php">
    	  <div class="portal-link">
          <i class="fa fa-usd fa-2x" style="float: left" aria-hidden="true"></i>
          <div class="portal-text">Billing Portal</div>
        </div>
      </a><?php } ?>
    </center>
    <button style="float: left; margin:  12px 10px 10px 12px" onclick="Logout()"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Log Out</button>
    <button style="float: right; margin: 12px 12px 10px 10px;" onclick="">Preferences&nbsp;<i class="fa fa-cogs" aria-hidden="true"></i></button>
	</div>
</body>
</html>
