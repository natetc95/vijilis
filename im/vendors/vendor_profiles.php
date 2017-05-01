<script src="public/javascripts/im/vendorinfo.js"/>
<script src="public/javascripts/search.js"/>

<?php

    session_start();
    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    // if ($query = $mysqli->prepare('SELECT username, fname, lname, uid FROM user WHERE acttype = 1')) {
    if( $query = $mysqli->prepare('SELECT user.username, user.fname, user.lname, user.uid
                                      FROM user
                                      INNER JOIN vendor
                                      ON vendor.user_uid = user.uid') ){
        $query->execute();
        $query->bind_result($u, $f, $l, $u2);

?>
<div class="contentvhr">
    <h1><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Vendor Profiles</h1><hr/>
    <div class="interiorcontainer">
        <div class="interiorvhr">
          <input class="searchbox" id="searchinp" type="text" style="color:#888;" onClick="SelectAll()" onfocus="inputFocus(this)" onblur="inputBlur(this)" value="Search Vendor Name" onkeypress="return searchVendor(event)"/>
          <!-- <button id="search_but" style="height:26px; width:30px;" onClick="geocodeMe()"><i class="fa fa-paper-plane-o" id='meslogo' aria-hidden="true"></i></button><br/> -->
            <div class='code-select-box' style='margin-top: 10px'>
            <?php while($query->fetch()) { ?>
                <div class='code-select-entry' onclick='openuser(<?=$u2?>)'>
                    <h1><?=$f?> <?=$l?></h1>
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
          </br>
        </div>
        <div class="interiorvhr nomargin">
            <h2>Notify Vendor</h2><br/><hr/>
            <center>
                <b>Custom Message</b>
                <textarea id='custmsg' rows='16' cols='30'></textarea><br/><br/>
                <button id='emailVendor' onClick="newToast('This button currently has no functionality')">Email</button>
            </center>
        </div>
    </div>
</div>
