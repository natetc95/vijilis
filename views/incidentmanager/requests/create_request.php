<?php session_start(); ?>
<script src="public/javascripts/gps.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkjnCKXG0rhi9sBnXIbFnQYDjcotUnwBw&callback=geoFindMe" async defer></script>
<div class="contentvhr">
    <h1>Create A Request</h1>
    <div class="reqinfo">
        ID# <?php echo("000001AZ");?><br/>
        IM: <?php echo($_SESSION['name']);?><br/>
        District: <?php echo("Tucson") ?>
    </div>
</div>
<div class="contentvhr">
    <div class="location">
        <h2>Location</h2><div class="help"><a href="javascript:geoFindMe()">(Get My Location <i class="fa fa-map-marker" aria-hidden="true"></i>)</a></div><br/>
        <label>Latitude: </label><br/>
        <input class="locbox" id="locbox_x" type="text"/><br/>
        <label>Longitude: </label><br/>
        <input class="locbox" id="locbox_y" type="text"/><br/>
    </div><br/>
    <div id="map"></div>
</div>
<div class="contentvhr">
    <h2>Sub-Requests</h2><br/><br/>
    <div class="tabholder">
        <a href="javascript:void(0)" class="tab" id="tab1" onclick="opensub('1')">1</a>
        <a href="javascript:void(0)" class="tab" id="tab2" onclick="opensub('2')">2</a>
        <a href="javascript:void(0)" class="tab" id="tab3" onclick="opensub('3')">3</a>
        <a href="javascript:void(0)" class="tab" id="tab4" onclick="opensub('4')">4</a>
        <a href="javascript:void(0)" class="tab plus" onclick=""><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
    <div class = "subreq open" id="subreq1">
        <br/>
        <div class="description" onChange="selectBox('car')">
            <h2>Incident Type</h2><br/>
            <select class="wew">
                <option selected hidden> -- Choose One -- </option>
                <option>Car Crash</option>
                <option>Debris Cleanup</option>
                <option>Dom</option>
            </select>
            <div class="description"><br/>
                <h2>Incident Description</h2><br/>
                <textarea></textarea>
            </div>
            <div class="description"><br/>
                <h2>Special Instructions</h2><br/>
                <textarea></textarea>
            </div>
        </div>
    </div>
    <div class = "subreq" id="subreq2">
        <br/>
        <div class="description" onChange="selectBox('car')">
            <h2>Incident Type</h2><br/>
            <select class="wew">
                <option selected hidden> -- Choose One -- </option>
                <option>Car Crash</option>
                <option>Debris Cleanup</option>
                <option>Dom</option>
            </select>
            <div class="description"><br/>
                <h2>Incident Description</h2><br/>
                <textarea></textarea>
            </div>
            <div class="description"><br/>
                <h2>Special Instructions</h2><br/>
                <textarea></textarea>
            </div>
        </div>
    </div>
    <div class = "subreq" id="subreq3">
        <br/>
        <div class="description" onChange="selectBox('car')">
            <h2>Incident Type</h2><br/>
            <select class="wew">
                <option selected hidden> -- Choose One -- </option>
                <option>Car Crash</option>
                <option>Debris Cleanup</option>
                <option>Dom</option>
            </select>
            <div class="description"><br/>
                <h2>Incident Description</h2><br/>
                <textarea></textarea>
            </div>
            <div class="description"><br/>
                <h2>Special Instructions</h2><br/>
                <textarea></textarea>
            </div>
        </div>
    </div>
    <div class = "subreq" id="subreq4">
        <br/>
        <div class="description" onChange="selectBox('car')">
            <h2>Incident Type</h2><br/>
            <select class="wew">
                <option selected hidden> -- Choose One -- </option>
                <option>Car Crash</option>
                <option>Debris Cleanup</option>
                <option>Dom</option>
            </select>
            <div class="description"><br/>
                <h2>Incident Description</h2><br/>
                <textarea></textarea>
            </div>
            <div class="description"><br/>
                <h2>Special Instructions</h2><br/>
                <textarea></textarea>
            </div>
        </div>
    </div>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="window.location='/vijilis/views/incidentmanager/index.php'">Cancel</button><button style="float: right">Submit</button>
</div>
