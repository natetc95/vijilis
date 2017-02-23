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
  <script src="public/javascripts/viewcontroller.js"></script>
  <title>Login</title>
</head>
<body>
  <div id="sidebar-menu">
    <div id="sidebar-content">
      <div class="sidebar-entry" onclick="openMenu('request')">
        <i id="request-icon" class="fa fa-handshake-o" aria-hidden="true"></i>Requests
      </div>
      <div class="sidebar-entry" onclick="openMenu('profile')">
        <i class="fa fa-id-card-o" aria-hidden="true"></i>Profile
      </div>
      <div class="sidebar-entry" onclick="openMenu('resource')">
        <i class="fa fa-truck" aria-hidden="true"></i>Resources
      </div>
      <div class="sidebar-entry">
        <i class="fa fa-street-view" aria-hidden="true"></i>Check In
      </div>
      <div class="sidebar-entry" onclick="openMenu('billing')">
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
  <div id="request-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-entry">
        <i class="fa fa-cogs" aria-hidden="true"></i>My Requests
      </div>
      <div class="under-menu-entry">
        <i class="fa fa-cogs" aria-hidden="true"></i>Open Requests
      </div>
      <div class="under-menu-entry">
        <i class="fa fa-cogs" aria-hidden="true"></i>Find Request
      </div>
    </div>
  </div>
  <div id="profile-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-entry">
        <i class="fa fa-user" aria-hidden="true"></i>My Profile
      </div>
      <div class="under-menu-entry">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile
      </div>
    </div>
  </div>
  <div id="resource-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-entry">
        <i class="fa fa-list" aria-hidden="true"></i>My Resources
      </div>
      <div class="under-menu-entry">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Resource
      </div>
      <div class="under-menu-entry">
        <i class="fa fa-plus" aria-hidden="true"></i>Add Resource
      </div>
    </div>
  </div>
  <div id="menubar">
    <i id="burger" class="fa fa-bars" aria-hidden="true" onClick="test()"></i><a href="index.php"><img src="public/images/logo_rn.png" class="barlogo" height="24px" style="float: right; margin-right: 30px;"></a>
  </div>
  <div id="content">
    <?php require('requests.php') ?>
  </div>
</body>
</html>
