<!DOCTYPE html>
<html lang="en">
<head>
  <base href="../">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type='text/css' media="(max-width: 400px)" href='public/stylesheets/styles.css' rel='stylesheet'>
  <link type='text/css' media="(min-width: 401px)" href='public/stylesheets/desktop-styles.css' rel='stylesheet'>
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
  <title>Admin Portal</title>
</head>

<?php
  require('../controllers/sessionHandler.php');
?>

<body>
  <div id="clock"></div>
  <div id="sidebar-menu">
    <div id="sidebar-content">
      <div class="sidebar-entry" onclick="openMenu('acct')">
        <i class="fa fa-users" aria-hidden="true"></i>Creation
      </div>
      <div class="sidebar-entry" onclick="openMenu('req')">
        <i class="fa fa-code" aria-hidden="true"></i>Job Codes
      </div>
      <div class="sidebar-entry" onclick="openMenu('billing')">
        <i class="fa fa-usd" aria-hidden="true"></i>Billing
      </div>
      <div class="sidebar-entry">
        <i class="fa fa-line-chart" aria-hidden="true"></i>Analytics
      </div>
      <div class="sidebar-entry" onclick="contentLoader('js/testing',true,'a')">
        <i class="fa fa-flask" aria-hidden="true"></i>JS Testing
      </div>
      <div class="sidebar-entry">
        <i class="fa fa-cogs" aria-hidden="true"></i>Preferences
      </div>
      <div class="sidebar-entry">
        <i class="fa fa-question" aria-hidden="true"></i>About
      </div>
      <div class="sidebar-entry" onClick="window.location='portal.php'">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>Portals
      </div>
      <div class="sidebar-entry no-border" onClick="Logout()">
        <i class="fa fa-sign-out" aria-hidden="true"></i>Log Out
      </div>
    </div>
  </div>
  <div id="acct-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-entry" onClick="contentLoader('accounts/im', true, 'a')">
        <i class="fa fa-user-plus" aria-hidden="true"></i>Create IM
      </div>
      <div class="under-menu-entry" onClick="contentLoader('accounts/v', true, 'a')" style="padding-right: 0; float: left; width: 173px;">
        <i class="fa fa-truck" aria-hidden="true"></i>Create Vendor
      </div>
      <div class="under-menu-entry" onClick="contentLoader('accounts/a', true, 'a')">
        <i class="fa fa-user-secret" aria-hidden="true"></i>Create Admin
      </div>
      <div class="under-menu-entry" onClick="contentLoader('accounts/d', true, 'a')" style="padding-right: 0; float: left; width: 173px;">
        <i class="fa fa-map-o" aria-hidden="true"></i>Create District
      </div>
    </div>
  </div>
  <div id="req-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-entry" onClick="contentLoader('codes/view_codes', true, 'a')">
        <i class="fa fa-search" aria-hidden="true"></i>Find Codes
      </div>
      <div class="under-menu-entry" onClick="contentLoader('accounts/im', true, 'a')">
        <i class="fa fa-plus" aria-hidden="true"></i>New Codes
      </div>
    </div>
  </div>
  <div id="billing-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-entry" onClick="contentLoader('requests/create_request')">
        <i class="fa fa-rss" aria-hidden="true"></i>My Requests
      </div>
      <div class="under-menu-entry" onClick="contentLoader('requests/local_requests')">
        <i class="fa fa-newspaper-o" aria-hidden="true"></i>In My Area
      </div>
      <div class="under-menu-entry" onClick="contentLoader('requests/lookup_request')">
        <i class="fa fa-search" aria-hidden="true"></i>Find Request
      </div>
    </div>
  </div>
  <div id="menubar">
    <i id="burger" class="fa fa-bars" aria-hidden="true" onClick="test()"></i>
    <i id="refresh" class="fa fa-refresh" aria-hidden="true" onClick="refresh('a')"></i>
    <a href="portal.php">
      <img src="public/images/logo_rn.png" class="barlogo" height="24px" style="float: right; margin-right: 30px;">
    </a>
  </div>
  <div id="content">
    <?php 
      require(getcwd() . '\\news.php');
    ?>
  </div>
</body>
</html>
