<?php session_start(); ?>
<script src="public/javascripts/gps.js"></script>
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
    </div>
</div>
<div class="contentvhr">
    <div class="description">
        <h2>Incident Type</h2><br/>
        <select class="wew">
            <option>Car Crash</option>
            <option>Debris Cleanup</option>
            <option>Dom</option>
        </select>
    </div>
</div>
<div class="contentvhr">
    <div class="description">
        <h2>Incident Description</h2><br/>
        <textarea></textarea>
    </div>
</div>
<div class="contentvhr">
    <div class="description">
        <h2>Special Instructions</h2><br/>
        <textarea></textarea>
    </div>
</div>
<div class="contentvhr">
    <button style="float: left">Cancel</button><button style="float: right">Submit</button>
</div>