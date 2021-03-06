<base href="../"/>

<?php 
    require('controllers/sessionHandler.php'); 
    require('controllers/json/assembly.php');
?>

<script src="public/javascripts/myResources.js"></script>
<div class="contentvhr">
    <div id="resourceHeader">
        <h1>New Resource</h1>
        <div class="resourceIconAdd" title="Save" onClick="addResource()" style="margin-top: -32px;">
            <i class="fa fa-save" aria-hidden="true"></i>&nbsp;&nbsp;Save
        </div>
        <div class="resourceIconDelete" title="Cancel" onClick="contentLoader('resources/my_resources', false, 'v')" style="margin-top: -32px; margin-right: 10px;">
            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Cancel
        </div>
    </div>
</div>
<div class="contentvhr">
    <h2>Title:</h2><br/>
    <center><input id="title" class="resourceInputBox" type="text"></input></center><br/>
    <h2>Type of Resource:</h2><br/>
    <center><?php assembleRBox(-1); ?></center><br/>

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

    <h2>Resource Description:</h2><br/>
    <center><textarea id="desc" class="resourceInputBox" rows="5" maxlength="128"></textarea></center>
    <h2>Images:</h2><br/>
    &nbsp;<b>License Plate (2MB):</b>
    <center><input id="img1" class="resourceInputBox" type="file"></input></center><br/>
    &nbsp;<b>Front of Vehicle (2MB):</b>
    <center><input id="img2" class="resourceInputBox" type="file"></input></center><br/>
    &nbsp;<b>Side of Vehicle (2MB):</b>
    <center><input id="img3" class="resourceInputBox" type="file"></input></center><br/>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('resources/my_resources', false, 'v')">Cancel</button><button style="float: right" onClick="addResource()">Save</button>
</div>