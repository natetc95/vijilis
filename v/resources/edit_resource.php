<?php
    session_start();
    require('../../controllers/configurator.php');
    require('../../controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    if(isset($_POST['uid'])) {
        if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
            $query->bind_param("i", $_SESSION['uid']);
            $query->execute();
            $query->bind_result($vendorid);
            $query->fetch();
            if(isset($vendorid)){
                $query->fetch();
                if($query = $mysqli->prepare("SELECT uid, vendor_uid, resourceType, resourceTitle, resourceDescription FROM resource WHERE uid = ?")) {
                    $query->bind_param('i', $_POST['uid']);
                    $query->execute();
                    $query->bind_result($uid, $vendoridR, $rType, $rTitle, $rDesc);
                    $query->fetch();
                    if(!isset($vendorid) || $vendorid != $vendoridR) {
                        echo("<script>contentLoader('resources/my_resources',false);</script>");
                    } else {
                        $img1 = 'userfiles/u' . $_SESSION['uid'] . '/v' . $vendorid . '/r' . $uid . '/img1.png';
                        $img2 = 'userfiles/u' . $_SESSION['uid'] . '/v' . $vendorid . '/r' . $uid . '/img2.png';
                        $img3 = 'userfiles/u' . $_SESSION['uid'] . '/v' . $vendorid . '/r' . $uid . '/img3.png';
                    }
                }
            }
        }
    } else {
        echo("<script>contentLoader('resources/my_resources',false);</script>");
    }
?>

<script src="public/javascripts/myResources.js"></script>
<script>

    $(document).ready(function() {
        vecHandler();
        changeLocationSetting()
    });

</script>
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
    <h1>Basic Information:</h1><hr/>
    <h2>Title:</h2><br/>
    <center><input id="title" class="resourceInputBox" type="text" value="<?=$rTitle?>"></input></center>
    <h2>Type of Resource:</h2><br/>
    <center><select id="type" class="resourceInputBox resourceSelectBox" value="<?=$rType?>" onChange="vecHandler()">
        <option value=-1 disabled>Select One</option>
        <optgroup label="Vehicles">
            <option value=0>Tow Truck</option>
            <option value=1>&nbsp;Ambulance</option>
            <option value=2>&nbsp;Livery Car</option>
        <optgroup label="Supplies">
            <option value=3>&nbsp;Food Stuffs</option>
    </select></center>
    <h2>Resource Description:</h2><br/>
    <center><textarea id="desc" class="resourceInputBox" rows="5" maxlength="128"><?=$rDesc?></textarea></center>
</div>

<div class="contentvhr">
    <h1>Location Data:</h1><hr/>
    <input type="checkbox" id="cbox1" onclick="changeLocationSetting()"><label id="forcbox1">Resource Follows Vendor?</label><br/>
    <div id="locdata" class="">
        <b>Latitude:</b><br/>
        <center><input id="title" class="resourceInputBox" type="text" value=""></input></center>
        <b>Longitude:</b><br/>
        <center><input id="title" class="resourceInputBox" type="text" value=""></input></center>
    </div>
</div>

<div class="contentvhr">
    <h1>Type Specific Information:</h1><hr/>

    <!--VEHICLE INFORMATION BOX-->
    <div id="vec_info" class="resourceAddtInfo">
        <h2>Vehicle Information</h2><br/>
        &nbsp;<b>Make:</b>
        <center><input id="make" class="resourceInputBox" type="text"></input></center>
        &nbsp;<b>Model:</b>
        <center><input id="model" class="resourceInputBox" type="text"></input></center>
        &nbsp;<b>Year:</b>
        <center><select id="year" class="resourceInputBox resourceSelectBox"></select></center><br/>
    </div>

    <!-- TOWING INFORMATION BOX -->
    <div id="tow_info" class="resourceAddtInfo">
        <h2>Towing Information</h2><br/>
        &nbsp;<b>Capacity (lbs):</b><br/>
        <center>
        <input type="range" id="myRange" width="290px" value="0" min="0" step="100" max="20000" style="width: 205px; margin-left: 15px; float: left; text-align: center;"/>
        <input id="capacity" class="resourceInputBox" type="text" style="width: 40px; margin-left: 15px; float: left">
        </center><br/><br/>
    </div>

    <!-- SUPPLIES INFORMATION BOX -->

    <div id="food_info" class="resourceAddtInfo">
        <h2>Supplies Information</h2><br/>
        &nbsp;<b>Expiration:</b>
        <center><input class="resourceInputBox" type="text" id="expiration"></center>
    </div>
</div>

<div class="contentvhr">
    <h1>Images:</h1><hr/>
    <b>License Plate:</b>
    <center>
        <img src="<?=$img1?>" class="edimg"/>
        <input id="title" class="resourceInputBox" type="file"></input>
    </center><br/>
    <b>License Plate:</b>
    <center>
        <img src="<?=$img1?>" class="edimg"/>
        <input id="title" class="resourceInputBox" type="file"></input>
    </center><br/>
    <b>License Plate:</b>
    <center>
        <img src="<?=$img1?>" class="edimg"/>
        <input id="title" class="resourceInputBox" type="file"></input>
    </center>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('resources/my_resources', false)">Cancel</button><button style="float: right" onClick="editResource(<?=$_POST['uid']?>)">Save</button>
</div>