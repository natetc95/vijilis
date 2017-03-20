<script src="public/javascripts/myResources.js"></script>
<div class="contentvhr">
    <div id="resourceHeader">
        <h1>New Resource</h1>
        <div class="resourceIconAdd" title="Save" onClick="addResource()" style="margin-top: -32px;">
            <i class="fa fa-save" aria-hidden="true"></i>&nbsp;&nbsp;Save
        </div>
        <div class="resourceIconDelete" title="Cancel" onClick="contentLoader('resources/my_resources', false)" style="margin-top: -32px; margin-right: 10px;">
            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Cancel
        </div>
    </div>
</div>
<div class="contentvhr">
    <h2>Title:</h2><br/>
    <center><input id="title" class="resourceInputBox" type="text"></input></center><br/>
    <h2>Type of Resource:</h2><br/>
    <center><select id="type" class="resourceInputBox resourceSelectBox" onChange="vecHandler()">
        <option value=-1 disabled selected="selected">Select One</option>
        <optgroup label="Vehicles">
            <option value=0>Tow Truck</option>
            <option value=1>&nbsp;Ambulance</option>
            <option value=2>&nbsp;Livery Car</option>
        <optgroup label="Supplies">
            <option value=3>&nbsp;Food Stuffs</option>
    </select></center><br/>

    <!--VEHICLE INFORMATION BOX-->

    <div id="vec_info" class="resourceAddtInfo">
        <h2>Vehicle Information</h2><br/>
        <b>Make:</b>
        <center><input id="make" class="resourceInputBox" type="text"></input></center>
        <b>Model:</b>
        <center><input id="model" class="resourceInputBox" type="text"></input></center>
        <b>Year:</b>
        <center><select id="year" class="resourceInputBox resourceSelectBox"></select></center><br/>
    </div>

    <!-- SURVIVAL INFORMATION BOX -->

    <div id="food_info" class="resourceAddtInfo">
        <h2>Survial Gear Information</h2><br/>
        <b>Expiration:</b>
        <center><input class="resourceInputBox" type="text" id="expiration"></center>
    </div>

    <h2>Resource Description:</h2><br/>
    <center><textarea id="desc" class="resourceInputBox" rows="5" maxlength="128"></textarea></center>
    <h2>Images:</h2><br/>
    <b>License Plate:</b>
    <center><input id="title" class="resourceInputBox" type="file"></input></center><br/>
    <b>License Plate:</b>
    <center><input id="title" class="resourceInputBox" type="file"></input></center><br/>
    <b>License Plate:</b>
    <center><input id="title" class="resourceInputBox" type="file"></input></center><br/>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('resources/my_resources', false)">Cancel</button><button style="float: right" onClick="addResource()">Save</button>
</div>