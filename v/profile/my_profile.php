<?php
    session_start();
    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    $fname = "Nathaniel";
    $lname = "Christianson";
    $pmethod = "Paypal";
    $acctnum = "000000001328";
?>

<div class="contentvhr">
    <h1><?=$_SESSION['name']?>'s Profile</h1>
</div>
<div class="contentvhr">
    <div class="resourceTitle">
        <h1>Personal Information</h1>
    </div><br/><br/>
    <div class="pi-container">
        <div class="pi left">
            <b>First Name: </b><?=$fname?><br/>
            <b>Last Name: </b><?=$lname?><br/>
        </div>
        <div class="pi right" >
            <img src="public/images/towtruck1.jpg" height='145' width='145'/>
        </div>
    </div>
</div>
<div class="contentvhr">
    <div class="resourceTitle">
        <h1>Resource Data</h1>
    </div><br/><br/>
    <div>
        <b>Number of Resources: </b><?=$pmethod?><br/>
        <b>Number of Active Requests: </b><?=$acctnum?><br/>
    </div>
</div>
<div class="contentvhr">
    <div class="resourceTitle">
        <h1>Billing Information</h1>
    </div><br/><br/>
    <div>
        <b>Method: </b><?=$pmethod?><br/>
        <b>Account Number: </b><?=$acctnum?><br/>
    </div>
</div>