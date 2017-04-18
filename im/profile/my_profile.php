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
    $count = 0;
    if ($query = $mysqli->prepare('SELECT uid FROM vendor WHERE user_uid = ?')) {
        $query->bind_param('i', $_SESSION['uid']);
        $query->execute();
        $query->bind_result($vid);
        $query->fetch();
        if(isset($vid)) {
            $query->fetch();
            if ($query = $mysqli->prepare('SELECT count(*) FROM resource WHERE vendor_uid = ?')) {
                $query->bind_param('i', $vid);
                $query->execute();
                $query->bind_result($count);
                $query->fetch();
                if(isset($count)) {
                    $query->fetch();
                    if ($query = $mysqli->prepare('SELECT count(*) FROM resource WHERE vendor_uid = ? AND approved = 1')) {
                        $query->bind_param('i', $vid);
                        $query->execute();
                        $query->bind_result($acount);
                        $query->fetch();
                        if(isset($acount)) {
                            $query->fetch();
                        }
                    }
                }
            }
        }
    }
?>
<script>
    var path = '<?=$profimg?>';
    setTimeout(function() {
        document.getElementById('img2reload').src = path + "?" + new Date().getTime();
    }, 120);
</script>
<script src="public/javascripts/profile.js"/>
<div class="contentvhr">
    <h1><?=$_SESSION['name']?>'s Profile</h1>
</div>
<div class="contentvhr">
    <div class="resourceTitle" style="width: 310px;margin-bottom: 10px">
        <h1 style="margin-top: 3px">Personal Information</h1>
        <div class="resourceIconEdit" title="Edit" onClick="contentLoader('profile/edit_profile', false)" style="float: right; margin-top: -35px;">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit
        </div>
    </div><hr/>
    <div class="pi-container">
        <div class="pi left">
            <b>First Name: </b><?=$fname?><br/>
            <b>Last Name: </b><?=$lname?><br/>
            <b>eMail: </b><?=$email?><br/>
            <b>Telephone: </b><?=$telnum?><br/>
        </div>
        <div class="pi right" >
            <div class="hoveroo" onClick="contentLoader('profile/edit_profile', false)"><p>Edit</p></div>
            <div class="imghider"><img id="img2reload" class="hoverimg" src="<?=$profimg?>" height='145' width='145'/></div>
        </div>
    </div>
</div>
<div class="contentvhr">
    <div class="resourceTitle" style="width: 310px;margin-bottom: 10px">
        <h1 style="margin-top: 3px">Resource Data</h1>
        <div class="resourceIconEdit" title="Edit" onClick="contentLoader('resources/my_resources', false)" style="float: right; margin-top: -35px;">
            <i class="fa fa-chevron-right" aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: -5px;"></i></i></i>&nbsp;More
        </div>
    </div><hr/>
    <div>
        <b># of Resources: </b><?=$count?><br/>
        <b># of Approved Resources: </b><?=$acount?><br/>
        <b># of Engaged Resources: </b><?=$acount?><br/>
    </div>
</div>
<div class="contentvhr">
    <div class="resourceTitle" style="width: 310px;margin-bottom: 10px">
        <h1 style="margin-top: 3px">Requests Data</h1>
        <div class="resourceIconEdit" title="Edit" onClick="contentLoader('resources/my_resources', false)" style="float: right; margin-top: -35px;">
            <i class="fa fa-chevron-right" aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: -5px;"></i></i></i>&nbsp;More
        </div>
    </div><hr/>
    <div>
        <b># of Open Requests: </b><?=$pmethod?><br/>
        <b># of Requests within 24 hours: </b><?=$acctnum?><br/>
    </div>
</div>
<div class="contentvhr">
    <div class="resourceTitle" style="width: 310px;margin-bottom: 10px">
        <h1 style="margin-top: 3px">Billing Information</h1>
        <div class="resourceIconEdit" title="Edit" onClick="contentLoader('resources/my_resources', false)" style="float: right; margin-top: -35px;">
            <i class="fa fa-chevron-right" aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true" style="margin-left: -5px;"></i></i></i>&nbsp;More
        </div>
    </div><hr/>
    <div>
        <b>Method: </b><?=$pmethod?><br/>
        <b>Account Number: </b><?=$acctnum?><br/>
    </div>
</div>
