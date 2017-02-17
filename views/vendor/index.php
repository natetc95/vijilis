<!DOCTYPE html>
<html lang="en">
<head>
  <base href="../../">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type='text/css' href='public/stylesheets/styles.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="public/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel='icon' href='public/images/icon.ico'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script>
    var open = false;
    function test() {
      if(!open) {
        document.getElementById("sidebar-menu").style="margin-left: 0px;"
        document.getElementById("burger").setAttribute("class", "fa fa-times fa-2x");
        //document.getElementById("burger").style="display: none";
        open = true;
      } else {
        document.getElementById("sidebar-menu").style="margin-left: -300px;"
        document.getElementById("burger").setAttribute("class", "fa fa-bars fa-2x");
        //document.getElementById("burger").style="display: inline";
        open = false;
      }
    }
    function Logout() {
      $.ajax({
        url: 'controllers/logout.php',
        type: 'POST',
        dataType: 'text',
        success: function(success) {
          console.log("Logged Out!");
          window.location = "index.php";
        }
      });
    }
    function openMenu(type) {
      document.getElementById("request-icon").setAttribute("class", "fa fa-handshake-o fa-rotate-90")
    }
  </script>
  <title>Login</title>
</head>
<body>
  <div id="sidebar-menu">
    <div id="sidebar-content">
      <div class="sidebar-entry" onclick="openMenu('request')">
        <i id="request-icon" class="fa fa-handshake-o" aria-hidden="true"></i>Requests
        <ul id="request-under-nav" class="under-nav open" style="display: none;">
          <li>Stuff</li>
        </ul>
      </div>
      <div class="sidebar-entry">
        <i class="fa fa-id-card-o" aria-hidden="true"></i>Profile
      </div>
      <div class="sidebar-entry">
        <i class="fa fa-truck" aria-hidden="true"></i>Resources
      </div>
      <div class="sidebar-entry">
        <i class="fa fa-street-view" aria-hidden="true"></i>Check In
      </div>
      <div class="sidebar-entry">
        <i class="fa fa-usd" aria-hidden="true"></i>Billing
      </div>
      <div class="sidebar-entry">
        <i class="fa fa-cogs" aria-hidden="true"></i>Preferences
      </div>
      <div class="sidebar-entry" onClick="window.location='portal.php'">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>Portals
      </div>
      <div class="sidebar-entry no-border" onClick="Logout()">
        <i class="fa fa-sign-out" aria-hidden="true"></i>Log Out
      </div>
    </div>
  </div>
  <div id="menubar">
    <i id="burger" class="fa fa-bars fa-2x" aria-hidden="true" onClick="test()"></i><div height="32px" style="float: right; margin-right: 30px;font-size: 24px; line-height: 32px">Vendor Portal</div>
  </div>
  <div id="content">
    insert content here
  </div>
</body>
</html>
