<script src="public/javascripts/obsolete/gps.js"></script>
<script src="public/javascripts/jobs.js"></script>
<script src="public/javascripts/viewcontroller.js"></script>

<?php
    session_start();
    require('controllers/json/assembly.php');
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
    <div class="location" style='margin-left: 0'>
        <h2>Location</h2><div class="help"><a href="javascript:geoFindMe()">(Get My Location <i class="fa fa-map-marker" aria-hidden="true"></i>)</a></div><br/>
        <label>Address: </label><br/>
        <input class="locbox" id="locinp" type="text" style="color:#888;" onfocus="inputFocus(this)" onblur="inputBlur(this)" value="Enter Location Here"/>
        <button id="locinp_but" style="height:26px; width:30px;" onClick="geocodeMe()"><i class="fa fa-paper-plane-o" id='meslogo' aria-hidden="true"></i></button><br/>
        <label>Latitude: </label><br/>
        &nbsp;<input class="locbox" id="locbox_x" type="text" value="<?php echo($zx); ?>"/><br/>
        <label>Longitude: </label><br/>
        &nbsp;<input class="locbox" id="locbox_y" type="text" value="<?php echo($zy); ?>"/><br/>
    </div><br/>
    <div id="map">
        <i class="fa fa-cog fa-spin fa-4x fa-fw"></i>
    </div>
</div>
<div id="sr" class="contentvhr">
    <h2>Linked Jobs</h2><br/><br/>
    <div id="th" class="tabholder">
        <a href="javascript:void(0)" class="tab" id="tab1" onclick="opensub('1')">1</a>
        <a href="javascript:void(0)" class="tab plus" onclick="addSub()"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
    <div id="subreq1" class = "subreq open" style="overflow: auto;">
        <br/>
        <div class="description" onChange="selectBox('car')">
            <div class="breaker">
                <h2>Incident Type</h2><br/>
                <?php assembleSerBox(); ?>
                <br/><br/><h2>Priority</h2><br/>
                <?php assemblePBox(); ?>
            </div>
            <div class="breaker">
                <div class="description" >
                    <h2>Incident Description</h2><br/>
                    <textarea class="wew"  id="jobdesc"></textarea>
                </div>
            </div>
            <div class="breaker">
                <div class="description">
                    <h2>Special Instructions</h2><br/>
                    <textarea class="wew" id="jobspec"></textarea>
                </div>
            </div>
            <br/>
        </div>
    </div>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="window.location='im/index.php'">Cancel</button>
    <button onClick="makeJob()" style="float: right">Submit</button>
</div>
