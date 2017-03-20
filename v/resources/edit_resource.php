<?php
    session_start();
    require('../../controllers/configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    if(isset($_POST['uid'])) {
        if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
            $query->bind_param("i", $_SESSION['uid']);
            $query->execute();
            $query->bind_result($vendorid);
            $query->fetch();
            if(isset($vendorid)){
                $query->fetch();
                if($query = $mysqli->prepare("SELECT vendor_uid, resourceType, resourceTitle, resourceDescription FROM resource WHERE uid = ?")) {
                    $query->bind_param('i', $_POST['uid']);
                    $query->execute();
                    $query->bind_result($vendoridR, $rType, $rTitle, $rDesc);
                    $query->fetch();
                    if(!isset($vendorid) || $vendorid != $vendoridR) {
                        echo("<script>contentLoader('resources/my_resources',false);</script>");
                    }
                }
            }
        }
    } else {
        echo("<script>contentLoader('resources/my_resources',false);</script>");
    }
?>
<script src="public/javascripts/myResources.js"></script>
<div class="contentvhr">
    <div id="resourceHeader">
        <h1>Edit Resource</h1>
        <div class="resourceIconAdd" title="Save" onClick="editResource(<?=$_POST['uid']?>)" style="margin-top: -32px;">
            <i class="fa fa-save" aria-hidden="true"></i>&nbsp;Save
        </div>
        <div class="resourceIconDelete" title="Cancel" onClick="contentLoader('resources/my_resources', false)" style="margin-top: -32px; margin-right: 10px;">
            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Cancel
        </div>
    </div>
    <hr/>
    <b>Resource ID: </b><?=$_POST['uid']?><br/>
    <b>Vendor ID: </b><?=$vendorid?>
</div>
<div class="contentvhr">
    <h2>Title:</h2><br/>
    <center><input id="title" class="resourceInputBox" type="text" value="<?=$rTitle?>"></input></center><br/>
    <h2>Type of Resource:</h2><br/>
    <center><select id="type" class="resourceInputBox resourceSelectBox" value="<?=$rType?>">
        <option value=-1 disabled>Select One</option>
        <optgroup label="Vehicles">
            <option value=0>Tow Truck</option>
            <option value=1>&nbsp;Ambulance</option>
            <option value=2>&nbsp;Livery Car</option>
        <optgroup label="Supplies">
            <option value=3>&nbsp;Food Stuffs</option>
    </select></center><br/>
    <h2>Resource Description:</h2><br/>
    <center><textarea id="desc" class="resourceInputBox" rows="5" maxlength="128"><?=$rDesc?></textarea></center>
    &nbsp;<input type="checkbox" id="cbox1" value="first_checkbox">Resource Follows Vendor?<br/>
    <h2>Images:</h2><br/>
    <b>License Plate:</b>
    <center><input id="title" class="resourceInputBox" type="file"></input></center><br/>
    <b>License Plate:</b>
    <center><input id="title" class="resourceInputBox" type="file"></input></center><br/>
    <b>License Plate:</b>
    <center><input id="title" class="resourceInputBox" type="file"></input></center><br/>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('resources/my_resources', false)">Cancel</button><button style="float: right" onClick="editResource(<?=$_POST['uid']?>)">Save</button>
</div>