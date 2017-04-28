<script src="public/javascripts/obsolete/gps.js"></script>
<script src="public/javascripts/jobs.js"></script>
<script src="public/javascripts/viewcontroller.js"></script>

<?php
    session_start();
?>

<script>geoFindMe();</script>

<div class="contentvhr">
    <h1>Create A Job</h1>
    <div class="reqinfo">
        IM: <?php echo($_SESSION['name']);?><br/>
        District: <?php echo("Tucson") ?>
    </div>
</div>
<div class="contentvhr">
    <div class="location">
        <h2>Location</h2><div class="help"><a href="javascript:geoFindMe()">(Get My Location <i class="fa fa-map-marker" aria-hidden="true"></i>)</a></div><br/>
        <label>Address: </label><br/>
        <input class="locbox" id="locinp" type="text" style="color:#888;" onfocus="inputFocus(this)" onblur="inputBlur(this)" value="Enter Location Here"/>
        <button id="locinp_but" style="height:30px; width:30px;" onClick="geocodeMe()"><i class="fa fa-search" aria-hidden="true"></i></button><br/><br/>
        <label>Latitude: </label><br/>
        <input class="locbox" id="locbox_x" type="text" value="<?php echo($zx); ?>"/><br/>
        <label>Longitude: </label><br/>
        <input class="locbox" id="locbox_y" type="text" value="<?php echo($zy); ?>"/><br/>
    </div><br/>
    <div id="map"></div>
</div>
<div id="sr" class="contentvhr">
    <h2>Linked Jobs</h2><br/><br/>
    <div id="th" class="tabholder">
        <a href="javascript:void(0)" class="tab" id="tab1" onclick="opensub('1')">1</a>
        <a href="javascript:void(0)" class="tab plus" onclick="addSub()"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
    <div id="subreq1" class = "subreq open">
        <br/>
        <div class="description" onChange="selectBox('car')">
            <h2>Incident Type</h2><br/>
            <select class="wew" id="jobtype">
                <option selected hidden> -- Choose One -- </option>
                <option value='0'>Car Crash</option>
                <option value='1'>Debris Cleanup</option>
            </select>
            <br/><br/><h2>Priority</h2><br/>
            <select class="wew" id="priorityinp">
                <option selected hidden> -- Choose One -- </option>
                <option value='1'>1</option>
                <option value='2'>2</option>
                <option value='3'>3</option>
                <option value='4'>4</option>
                <option value='5'>5</option>
                <option value='6'>6</option>
                <option value='7'>7</option>
                <option value='8'>8</option>
                <option value='9'>9</option>
                <option value='10'>10</option>
            </select>
            <div class="description" ><br/>
                <h2>Incident Description</h2><br/>
                <textarea id="jobdesc"></textarea>
            </div>
            <div class="description"><br/>
                <h2>Special Instructions</h2><br/>
                <textarea id="jobspec"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('news', true, 'im')">Cancel</button>
    <button onClick="submitJob()" style="float: right">Submit</button>
</div>
