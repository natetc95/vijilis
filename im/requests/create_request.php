<script src="public/javascripts/gps.js"></script>
<?php session_start();
    if (isset($x) && isset($y)) {
        $zx = $x;
        $zy = $y;
        echo("<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBkjnCKXG0rhi9sBnXIbFnQYDjcotUnwBw&callback=initBig&language=ru' async defer></script>");
    } else {
        $zx = "";
        $zy = "";
        echo("<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBkjnCKXG0rhi9sBnXIbFnQYDjcotUnwBw&callback=geoFindMe&language=ru' async defer></script>");
    }

?>


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
        <input class="locbox" id="locbox_x" type="text" value="<?php echo($zx); ?>"/><br/>
        <label>Longitude: </label><br/>
        <input class="locbox" id="locbox_y" type="text" value="<?php echo($zy); ?>"/><br/>
    </div><br/>
    <div id="map"></div>
</div>
<div id="sr" class="contentvhr">
    <h2>Sub-Requests</h2><br/><br/>
    <div id="th" class="tabholder">
        <a href="javascript:void(0)" class="tab" id="tab1" onclick="opensub('1')">1</a>
        <a href="javascript:void(0)" class="tab plus" onclick="addSub()"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
    <div class = "subreq open" id="subreq1">
        <br/>
        <div class="description" onChange="selectBox('car')">
            <h2>Incident Type</h2><br/>
            <select class="wew">
                <option selected hidden> -- Choose One -- </option>
                <option>Car Crash</option>
                <option>Debris Cleanup</option>
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
