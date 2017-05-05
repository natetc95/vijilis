<script src="public/javascripts/jobs.js"/>

<?php

    session_start();
    require('controllers/configurator.php');
    //require('controllers/sessionHandler.php');
    require('controllers/json/assembly.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

?>
<div class="contentvhr">
    <h1><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search For Jobs</h1><hr/>
    <div class="interiorcontainer">
        <div class="interiorvhr" style='border-right: 1px solid slategrey;'>
            <b>General Search Options</b></br>
            <table>
                <tr>
                    <td><input class="searchbox" id="jobnum" type="text" style="width: 114px;" placeholder="Job Number" /></td>
                    <td><input class="searchbox" id="parent" type="text" style="width: 114px;" placeholder="Parent Number" /></td>
                </tr>
            </table>
            <div style="margin-left: 3px;">
                <?php assembleSerBox(-1)?>
            </div>
            <div style="margin-left: 3px; margin-top: 3px;">
                <?php assembleSBox(-1)?>
            </div>
            <div style="margin-left: 3px; margin-top: 3px;">
                <textarea class='wew' id='desc' style='width: 244px;' placeholder='Description'></textarea>
            </div><div style='height: 5px'/>
            <b>Creation Search Options</b></br>
            <table>
                <tr>
                    <td><input class="searchbox" id="user" type="text" style="width: 114px;" placeholder="Created By" /></td>
                    <td><input class="searchbox" id="ctime" type="text" style="width: 114px;" placeholder="Last Edited" /></td>
                </tr>
            </table><div style='height: 5px'/>
            <b>Vendor Search Options</b></br>
            <table>
                <tr>
                    <td><input class="searchbox" id="vid" type="text" style="width: 114px;" placeholder="Resource ID" /></td>
                </tr>
            </table><div style='height: 5px'/>
            <button style="float: left" onClick="window.location='im/index.php'">Clear</button>
            <button onClick="search()" style="float: right; margin-right: 20px;">Search</button>
        </div>
        <div class='search-div'>
            <table class='search-table' id='tableoo'>
                <tr>
                    <th style='overflow:hidden; white-space:nowrap'>Job #</th>
                    <th style='overflow:hidden; white-space:nowrap'>Status</th>
                    <th style='overflow:hidden; white-space:nowrap'>Description</th>
                    <th style='overflow:hidden; white-space:nowrap'>Assigned To</th>
                    <th style='overflow:hidden; white-space:nowrap'>Last Updated</th>
                </tr>
            </table>
        </div>
    </div>
</div>
