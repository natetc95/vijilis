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
                if($query = $mysqli->prepare("SELECT uid, vendor_uid, resourceType, resourceTitle, resourceDescription, resourceFollowsVendor FROM resource WHERE uid = ?")) {
                    $query->bind_param('i', $_POST['uid']);
                    $query->execute();
                    $query->bind_result($uid, $vendoridR, $rType, $rTitle, $rDesc, $rFollow);
                    $query->fetch();
                    if(!isset($vendorid) || $vendorid != $vendoridR) {
                        echo("<script>contentLoader('resources/my_resources',false, 'v');</script>");
                    } else {
                        $query->fetch();
                        $img1 = 'userfiles/u' . $_SESSION['uid'] . '/v' . $vendorid . '/r' . $uid . '/img1.png';
                        $img2 = 'userfiles/u' . $_SESSION['uid'] . '/v' . $vendorid . '/r' . $uid . '/img2.png';
                        $img3 = 'userfiles/u' . $_SESSION['uid'] . '/v' . $vendorid . '/r' . $uid . '/img3.png';
                        if ($rType == '0') {
                            if ($query = $mysqli->prepare("SELECT vehicleMake , vehicleModel, vehicleYear, towingClass FROM resource WHERE uid = ?")) {
                                $query->bind_param('i', $_POST['uid']);
                                $query->execute();
                                $query->bind_result($mk, $mdl, $yr, $tc);
                                $query->fetch();
                                if(isset($mk)) {
                                    $query->fetch();
                                    $exp = '00/00/00';
                                }
                            }
                        } elseif ($rType == '1' || $rType == '2') {
                            if ($query = $mysqli->prepare("SELECT vehicleMake , vehicleModel, vehicleYear FROM resource WHERE uid = ?")) {
                                $query->bind_param('i', $_POST['uid']);
                                $query->execute();
                                $query->bind_result($mk, $mdl, $yr);
                                $query->fetch();
                                if(isset($mk)) {
                                    $query->fetch();
                                    $tc = 'Z';
                                    $exp = '00/00/00';
                                }
                            }
                        } elseif ($rType == '3') {
                            if ($query = $mysqli->prepare("SELECT foodDate FROM resource WHERE uid = ?")) {
                                $query->bind_param('i', $_POST['uid']);
                                $query->execute();
                                $query->bind_result($exp);
                                $query->fetch();
                                if(isset($mk)) {
                                    $query->fetch();
                                    $mk = '';
                                    $mdl = '';
                                    $yr = 0;
                                    $tc = 'Z';
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        echo("<script>contentLoader('resources/my_resources',false, 'v');</script>");
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
        <div class="resourceIconDelete" title="Cancel" onClick="contentLoader('resources/my_resources', false, 'v')" style="margin-top: -32px; margin-right: 10px;">
            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Cancel
        </div>
    </div>
    <hr/>
    <b>Resource ID: </b><?=$_POST['uid']?><br/>
    <b>Vendor ID: </b><?=$vendorid?>
</div>
<div class="contentvhr">
    <h1>Basic Information:</h1><hr/>
    <p>Please add some basic information.......</p>
    <hr/>
    <h2>Title:</h2><br/>
    <center><input id="title" class="resourceInputBox" type="text" value="<?=$rTitle?>"></input></center>
    <h2>Type of Resource:</h2><br/>
    <center><select id="type" class="resourceInputBox resourceSelectBox" onChange="vecHandler()">
        <option value=-1 disabled>Select One</option>
        <optgroup label="Vehicles">
            <option value=0 <?=$rType == '0' ? ' selected="selected"' : '';?>>Tow Truck</option>
            <option value=1 <?=$rType == '1' ? ' selected="selected"' : '';?>>&nbsp;Ambulance</option>
            <option value=2 <?=$rType == '2' ? ' selected="selected"' : '';?>>&nbsp;Livery Car</option>
        <optgroup label="Supplies">
            <option value=3 <?=$rType == '3' ? ' selected="selected"' : '';?>>&nbsp;Food Stuffs</option>
    </select></center>
    <h2>Resource Description:</h2><br/>
    <center><textarea id="desc" class="resourceInputBox" rows="5" maxlength="128"><?=$rDesc?></textarea></center>
</div>

<div class="contentvhr">
    <h1>Location Data:</h1><hr/>
    <input type="checkbox" id="cbox1" onclick="changeLocationSetting()" <?php if($rFollow == 1) {echo "checked";}?>><label id="forcbox1">Resource Follows Vendor?</label><br/>
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
        <center><input id="make" class="resourceInputBox" type="text" value="<?=$mk?>"></input></center>
        &nbsp;<b>Model:</b>
        <center><input id="model" class="resourceInputBox" type="text" value="<?=$mdl?>"></input></center>
        &nbsp;<b>Year:</b>
        <center><select id="year" class="resourceInputBox resourceSelectBox" value="<?=$yr?>"></select></center><br/>
    </div>

    <!-- TOWING INFORMATION BOX -->
    <div id="tow_info" class="resourceAddtInfo">
        <h2>Towing Information</h2><br/>
        &nbsp;<b>Class: </b> <?=$tc?><br/>
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
        <center><input class="resourceInputBox" type="text" id="expiration" value="<?=$exp?>"></center>
    </div>
</div>

<div class="contentvhr">
<h1>Images:</h1><hr/>
<?php if($rType == '0' || $rType == '1' || $rType == '2') { ?>
    <b>License Plate (2MB):</b>
    <center>
        <img src="<?=$img1?>" class="edimg"/>
        <input id="img1" class="resourceInputBox" type="file"></input>
    </center><br/>
    <b>Front of Vehicle (2MB):</b>
    <center>
        <img src="<?=$img1?>" class="edimg"/>
        <input id="img2" class="resourceInputBox" type="file"></input>
    </center><br/>
    <b>Side of Vehicle (2MB):</b>
    <center>
        <img src="<?=$img1?>" class="edimg"/>
        <input id="img3" class="resourceInputBox" type="file"></input>
    </center>
<?php } elseif ($rType = '3') { ?>
    <b>Picture of Supply (2MB):</b>
    <center>
        <img src="<?=$img1?>" class="edimg"/>
        <input id="img2" class="resourceInputBox" type="file"></input>
    </center>
<?php } ?>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('resources/my_resources', false, 'v')">Cancel</button><button style="float: right" onClick="editResource(<?=$_POST['uid']?>)">Save</button>
</div>