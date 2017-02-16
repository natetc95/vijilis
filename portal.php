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
  <?php require('controllers/SessionHandler.php');?>
</head>
<body>
	<div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="80%" style="padding-top: 8px; padding-left: 5px;"></a>
    <br/>
    <div id="bar"></div>
  </div>
	<div id="portalbox" style="height: 420px"></br>
    <h1>Available Portals</h1>
    <center>
      <a class="portal-div" href="vendor">
    	  <div class="portal-link">
          <i class="fa fa-truck fa-2x" style="float: left" aria-hidden="true"></i>
          <div class="portal-text">Vendor Portal</div>
        </div>
      </a><br/>
      <a class="portal-div" href="views/incidentmanager">
    	  <div class="portal-link">
          <i class="fa fa-user-plus fa-2x" style="float: left" aria-hidden="true"></i>
          <div class="portal-text">Incident Manager Portal</div>
        </div>
      </a><br/>
      <a class="portal-div" href="views/admin/index.php">
    	  <div class="portal-link">
          <i class="fa fa-user-secret fa-2x" style="float: left" aria-hidden="true"></i>
          <div class="portal-text">Admin Portal</div>
        </div>
      </a><br/>
      <a class="portal-div" href="vendor">
    	  <div class="portal-link">
          <i class="fa fa-usd fa-2x" style="float: left" aria-hidden="true"></i>
          <div class="portal-text">Billing Portal</div>
        </div>
      </a>
    </center>
    <button style="float: left; margin: 12px;" onclick="Logout()"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Log Out</button>
    <button style="float: right; margin: 12px;" onclick="">Preferences&nbsp;<i class="fa fa-cogs" aria-hidden="true"></i></button>
	</div>
</body>
</html>
