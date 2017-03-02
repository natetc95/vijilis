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
      <div class="sidebar-entry" onClick="window.location='/vijilis/views/incidentmanager/'">
        <i class="fa fa-home" aria-hidden="true"></i>Home
      </div>
      <div class="sidebar-entry" onclick="openMenu('request')">
        <i id="request-icon" class="fa fa-handshake-o" aria-hidden="true"></i>Requests
      </div>
      <div class="sidebar-entry" onclick="openMenu('profile')">
        <i class="fa fa-id-card-o" aria-hidden="true"></i>Profile
      </div>
      <div class="sidebar-entry" onclick="contentLoaderIM('district/findme')">
        <i class="fa fa-map-o" aria-hidden="true"></i>My District
      </div>
      <div class="sidebar-entry" onclick="openMenu('vendor')">
        <i class="fa fa-users" aria-hidden="true"></i>Vendors
      </div>
      <div class="sidebar-entry" onClick="contentLoaderIM('preferences')">
        <i class="fa fa-cogs" aria-hidden="true"></i>Preferences
      </div>
      <div class="sidebar-entry" onClick="contentLoaderIM('about')">
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
  <div id="request-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-empty">&nbsp;</div>
      <div class="under-menu-entry" onClick="contentLoaderIM('requests/create_request')">
        <i class="fa fa-plus" aria-hidden="true"></i>Create
      </div>
      <div class="under-menu-entry" onClick="contentLoaderIM('requests/view_edit_requests')">
        <i class="fa fa-wrench" aria-hidden="true"></i>View/Edit
      </div>
      <div class="under-menu-entry" onClick="contentLoaderIM('requests/my_open_requests')">
        <i class="fa fa-folder-o" aria-hidden="true"></i>Open
      </div>
    </div>
  </div>
  <div id="profile-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-empty">&nbsp;</div>
      <div class="under-menu-empty">&nbsp;</div>
      <div class="under-menu-entry" onClick="contentLoaderIM('profile/my_profile')">
        <i class="fa fa-user" aria-hidden="true"></i>My Profile
      </div>
      <div class="under-menu-entry" onClick="contentLoaderIM('profile/edit_profile')">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile
      </div>
    </div>
  </div>
  <div id="vendor-under-menu" class="under-menu">
    <div class="under-menu-content">
      <div class="under-menu-empty">&nbsp;</div>
      <div class="under-menu-empty">&nbsp;</div>
      <div class="under-menu-empty">&nbsp;</div>
      <div class="under-menu-entry" onClick="contentLoaderIM('vendors/find_vendor')">
        <i class="fa fa-search" aria-hidden="true"></i>Find Vendor
      </div>
      <div class="under-menu-entry" onClick="contentLoaderIM('vendors/vendor_profiles')">
        <i class="fa fa-address-book-o" aria-hidden="true"></i>Profiles
      </div>
    </div>
  </div>
  <div id="menubar">
    <i id="burger" class="fa fa-bars fa-2x" aria-hidden="true" onClick="test()"></i><a href="portal.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px;"></a>
  </div>
  <div id="content">
    <div class="contentvhr">
      Welcome to the Incident Manager Home Portal page!
    </div>
  </div>
</body>
</html>
