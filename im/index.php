<!DOCTYPE html>
<html lang="en">
<head>
  <base href="../">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link type='text/css' href='public/stylesheets/styles.css' rel='stylesheet'>
  <link type='text/css' media="(min-width: 401px)" href='public/stylesheets/desktop-styles.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkjnCKXG0rhi9sBnXIbFnQYDjcotUnwBw&libraries=places"></script>
  <link rel="stylesheet" href="public/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel='icon' href='public/images/icon.ico'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="public/javascripts/viewcontroller.js"></script>
  <title>Incident Manager Portal</title>
</head>
<?php require('../controllers/sessionhandler.php'); ?>


<body>
  <div id="clock"></div>
  <div id="sidebar-menu">
    <div id="sidebar-content">
      <div class="sidebar-entry" onClick="openMenu('request')">
        <i id="request-icon" class="fa fa-handshake-o" aria-hidden="true"></i>Jobs
      </div>
      <div class="sidebar-entry" onClick="contentLoader('district/findme', true, 'im')">
        <i class="fa fa-building-o" aria-hidden="true"></i>My District
      </div>
      <div class="sidebar-entry" onClick="contentLoader('vendors/vendor_profiles', true, 'im')">
        <i class="fa fa-users" aria-hidden="true"></i>Vendors
      </div>
      <div class="sidebar-entry" onClick="contentLoader('profile/my_profile', true, 'im');">
        <i class="fa fa-id-card-o" aria-hidden"true"></i>My Profile
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
      <div class="under-menu-entry" onClick="contentLoader('requests/create_request', true, 'im')">
        <i class="fa fa-plus" aria-hidden="true"></i>Create
      </div>
      <div class="under-menu-entry" onClick="contentLoader('requests/view_edit_requests', true, 'im')">
        <i class="fa fa-wrench" aria-hidden="true"></i>View/Edit
      </div>
    </div>
  </div>
  <div id="menubar">
    <i id="burger" class="fa fa-bars fa-2x" aria-hidden="true" onClick="test()"></i><a href="portal.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px;"></a>
    <i id="refresh" class="fa fa-refresh" aria-hidden="true" onClick="refresh('im')"></i>
  </div>
  <div id="content">
    <?php require('news.php') ?>
  </div>
</body>
</html>
