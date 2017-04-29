<script src="public/javascripts/im/vendorinfo.js"/>

<?php

    session_start();
    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    if ($query = $mysqli->prepare('SELECT username, fname, lname, uid FROM user WHERE acttype = 0')) {
        $query->execute();
        $query->bind_result($u, $f, $l, $u2);

?>
<div class="contentvhr">
    <h1><i class="fa fa-code" aria-hidden="true"></i>&nbsp;Vendor Profiles</h1><hr/>
    <div class="interiorcontainer">
        <div class="interiorvhr">
            <div class='code-select-box'>
            <?php while($query->fetch()) { ?>
                <div class='code-select-entry' onclick='openuser(<?=$u2?>)'>
                    <h1><?=$u?></h1>
                </div>
                <?php }} ?>
            </div>
        </div>
        <div class="interiorvhr">
            <h2>Basic Information</h2><br/><hr/>
            <table>
                <tr>
                    <td><b>Name:</b></td>
                    <td id="name"></td>
                </tr>
                <tr>
                    <td><b>User ID:</b></td>
                    <td id="uid"></td>
                </tr>
                <tr>
                    <td><b>Email:</b></td>
                    <td id="email"></td>
                </tr>
                <tr>
                    <td><b>Telephone:</b></td>
                    <td id="telnum"></td>
                </tr>
                <tr>
                    <td><b>Zip Code:</b></td>
                    <td id='zip'></td>
                </tr>
            </table>
            <br/><h2>Configurables</h2><br/><hr/>
            <table>
                <tr>
                    <td><b>Polygon:</b></td>
                    <td>
                        <select class="wew" id="poly" style="width: 190px">
                        <?php
                            if ($query = $mysqli->prepare('SELECT uid, city, state FROM districts')) {
                                $query->execute();
                                $query->bind_result($u, $c, $s);
                                while($query->fetch()) {
                        ?>
                            <option value='<?=$u?>'>Polygon <?=$u?> -- <?=$c?>, <?=$s?></option>
                        <?php }} ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>Account Type:</b></td>
                    <td>
                        <select class="wew" id="type" style="width: 190px">
                            <option value='1'>Vendor</option>
                            <option value='2'>Incident Manager</option>
                            <option value='7'>Admin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><b>Notify:</b></td>
                    <td><input type='checkbox' id='notify' onChange='stopNotify()' checked></input></td>
                </tr>
                <tr>
                    <td><b>Method:</b></td>
                    <td>
                        <select class="wew" id="contactmethod" style="width: 190px">
                            <option value='e'>Email</option>
                            <option value='p'>Phone</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div class="interiorvhr nomargin">
            <h2>Applicant</h2><br/><hr/>
            <center>
                <b>Custom Message</b>
                <textarea id='custmsg' rows='16' cols='30'></textarea><br/><br/>
                <button id='x' onClick="contentLoader('news', false, 'a')" disabled>Decline</button>
                <button id='y' onClick="createIncidentManager()" disabled>Approve</button><br/>
            </center>
        </div>
    </div>
</div>
