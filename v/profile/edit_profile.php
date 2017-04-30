<?php
    session_start();
    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    $pmethod = "Paypal";
    $acctnum = "000000001328";
    if (file_exists($GLOBALS['helpme'] . 'userfiles/u' . $_SESSION['uid'] . '/prof.png')) {
        $profimg = 'userfiles/u' . $_SESSION['uid'] . '/prof.png?' . time();
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
<div id="head" class="contentvhr">
    <div id="resourceHeader">
        <h1><?=$_SESSION['name']?>'s Profile</h1>
        <div id="save" class="resourceIconAdd" title="Save"style="margin-top: -32px;">
            <i class="fa fa-save" aria-hidden="true"></i>&nbsp;Save
        </div>
        <div id="cancel" class="resourceIconDelete" title="Cancel" onClick="contentLoader('profile/my_profile', false, 'v')" style="margin-top: -32px; margin-right: 10px;">
            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Cancel
        </div>
    </div>
</div>
<div class="contentvhr">
    <div class="resourceTitle" style="width: 310px;">
        <h1>Personal Information</h1>
    </div><br/><br/>
    <b>First Name: </b><br/>
    <center><input id="fname" class="resourceInputBox" type="text" value="<?=$fname?>"></input></center>
    <b>Last Name: </b><br/>
    <center><input id="lname" class="resourceInputBox" type="text" value="<?=$lname?>"></input></center>
    <b id="emV">eMail: </b><br/>
    <center><input id="email" class="resourceInputBox" type="text" value="<?=$email?>" onkeyup="validateEmail()"></input></center>
    <b id="tuV">Telephone Number: </b><br/>
    <center><input id="telnu" class="resourceInputBox" type="text" value="<?=$telnum?>"onkeyup="validatePhone()"></input></center>
</div>
<div class="contentvhr">
    <h1>Profile Image:</h1><hr/>
    <center><img src="<?=$profimg?>" width='260'/></center>
    <center><input id="img2" class="resourceInputBox" type="file"></input></center>
</div>
<div id='foot' class="contentvhr">
    <button style="float: right;" id="save2">Save</button>
    <button id="cancel2">Cancel</button>
</div>