<?php
    session_start();
    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    $pmethod = "Paypal";
    $acctnum = "000000001328";
    if (file_exists($GLOBALS['helpme'] . 'userfiles/u' . $_SESSION['uid'] . '/prof.png')) {
        $profimg = 'userfiles/u' . $_SESSION['uid'] . '/prof.png';
    } else {
        $profimg = 'public/images/unknownuser.jpg';
    }
    if ($query = $mysqli->prepare('SELECT fname, lname, email, telnum FROM user WHERE uid = ?')) {
        $query->bind_param('i', $_SESSION['uid']);
        $query->execute();
        $query->bind_result($fname, $lname, $email, $telnum);
        $query->fetch();
        if(isset($fname)) {
            $query->fetch();
        }
    }
?>
<script src="public/javascripts/profile.js"/>
<div class="contentvhr">
    <h1><?=$_SESSION['name']?>'s Profile</h1>
</div>
<div class="contentvhr">
    <div class="resourceTitle" style="width: 310px;">
        <h1>Personal Information</h1>
        <div class="resourceIconEdit" title="Edit" onClick="contentLoader('profile/edit_profile', false)" style="float: right; margin-top: -30px;">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit
        </div>
    </div><br/><br/>
    <div class="pi-container">
        <div class="pi left">
            <b>First Name: </b><?=$fname?><br/>
            <b>Last Name: </b><?=$lname?><br/>
            <b>eMail: </b><?=$email?><br/>
            <b>Telephone: </b><?=$telnum?><br/>
        </div>
        <div class="pi right" >
            <div class="hoveroo" onClick="contentLoader('profile/edit_profile', false)"><p>Edit</p></div>
            <div class="imghider"><img class="hoverimg" src="<?=$profimg?>" width='145'/></div>
        </div>
    </div>
</div>
<div class="contentvhr">
    <div class="resourceTitle" style="width: 310px;">
        <h1>Resource Data</h1>
        <div class="resourceIconEdit" title="Edit" onClick="contentLoader('resources/my_resources', false)" style="float: right; margin-top: -30px;">
            <i class="fa fa-chevron-right" aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: -5px;"></i></i></i>&nbsp;More
        </div>
    </div><br/><br/>
    <div>
        <b>Number of Resources: </b><?=$pmethod?><br/>
        <b>Number of Active Requests: </b><?=$acctnum?><br/>
    </div>
</div>
<div class="contentvhr">
    <div class="resourceTitle" style="width: 310px;">
        <h1>Requests Data</h1>
        <div class="resourceIconEdit" title="Edit" onClick="contentLoader('resources/my_resources', false)" style="float: right; margin-top: -30px;">
            <i class="fa fa-chevron-right" aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: -5px;"></i></i></i>&nbsp;More
        </div>
    </div><br/><br/>
    <div>
        <b># of Open Requests: </b><?=$pmethod?><br/>
        <b># of Requests within 24 hours: </b><?=$acctnum?><br/>
    </div>
</div>
<div class="contentvhr">
    <div class="resourceTitle" style="width: 310px;">
        <h1>Billing Information</h1>
        <div class="resourceIconEdit" title="Edit" onClick="contentLoader('resources/my_resources', false)" style="float: right; margin-top: -30px;">
            <i class="fa fa-chevron-right" aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: -5px;"></i></i></i>&nbsp;More
        </div>
    </div><br/><br/>
    <div>
        <b>Method: </b><?=$pmethod?><br/>
        <b>Account Number: </b><?=$acctnum?><br/>
    </div>
</div>