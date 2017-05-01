<!DOCTYPE html>
<html lang="en">
<head>
  <base href="../">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type='text/css' href='public/stylesheets/styles.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="public/font-awesome-4.7.0/css/font-awesome.min.css">

  <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="/public/images/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/public/images/favicons/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/public/images/favicons/manifest.json">
  <link rel="mask-icon" href="/public/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
  <link rel="shortcut icon" href="/public/images/favicons/favicon.ico">
  <meta name="apple-mobile-web-app-title" content="VIJILIS Responder">
  <meta name="application-name" content="VIJILIS Responder">
  <meta name="msapplication-config" content="/public/images/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="public/javascripts/viewcontroller.js"></script>
  <title>Vendor Portal</title>
</head>
<?php
  require('../controllers/sessionHandler.php');
  if(isset($_GET['m'])) {
    $_SESSION['mxs'] = $_GET['m'];
    $_SESSION['mxr'] = $_SERVER['HTTP_REFERER'];
    header("Location: index.php");
  }
  else if (isset($_SESSION['mxs'])) {
    echo("<script>FOBBY(\"" . $_SESSION['mxs'] . "\")</script>");
    unset($_SESSION['mxs']);
  }
?>
<body>
  <div id="clock"></div>
  <div id="sidebar-menu">
    <div id="sidebar-content">
      <div class="sidebar-entry" onclick="contentLoader('requests/my_requests', true, 'v')">
        <i id="request-icon" class="fa fa-handshake-o" aria-hidden="true"></i>Jobs
      </div>
      <div class="sidebar-entry" onclick="openMenu('profile')">
        <i class="fa fa-id-card-o" aria-hidden="true"></i>Profile
      </div>
      <div class="sidebar-entry" onclick="openMenu('resource')">
        <i class="fa fa-truck" aria-hidden="true"></i>Resources
      </div>
      <div class="sidebar-entry" onClick="FOBBY(null, true)">
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
  <div id="profile-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-empty">&nbsp;</div>
      <div class="under-menu-entry" onClick="contentLoader('profile/my_profile', true, 'v')">
        <i class="fa fa-user" aria-hidden="true"></i>My Profile
      </div>
      <div class="under-menu-entry">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile
      </div>
    </div>
  </div>
  <div id="resource-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-empty">&nbsp;</div>
      <div class="under-menu-empty">&nbsp;</div>
      <div class="under-menu-entry" onClick="contentLoader('resources/my_resources', true, 'v')">
        <i class="fa fa-list" aria-hidden="true"></i>My Resources
      </div>
      <div class="under-menu-entry" onClick="contentLoader('resources/add_resource', true, 'v')">
        <i class="fa fa-plus" aria-hidden="true"></i>Add Resource
      </div>
    </div>
  </div>
  <div id="menubar">
    <i id="burger" class="fa fa-bars" aria-hidden="true" onClick="test()"></i>
    <i id="refresh" class="fa fa-refresh" aria-hidden="true" onClick="refresh('v')"></i>
    <a href="portal.php">
      <img src="public/images/logo_rn.png" class="barlogo" height="24px" style="float: right; margin-right: 30px;">
    </a>
  </div>
  <div id="content">
    <?php require('news.php') ?>
  </div>
</body>
</html>
