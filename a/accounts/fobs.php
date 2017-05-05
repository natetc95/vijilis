<script src="public/javascripts/admin/registration.js"/>
<div class="contentvhr">
    <h1><i class="fa fa-tag" aria-hidden="true"></i>&nbsp;Create a Fob</h1><hr/>
    <p style="margin: 0;">&nbsp;Generates random FOB key information to be applied to a user account which does not already have one.</p>
</div>
<?php 
    $pin = mt_rand(1000, 9999);
    $hash = md5(mt_rand(1000, 9999) . time() . mt_rand(1000, 9999));
    $lnk = 'https://' . $_SERVER['HTTP_HOST'] . '/fob.php?lnk=' . $hash;
    session_start();
    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    if ($query = $mysqli->prepare('SELECT username, uid FROM user WHERE fobHash = "0" AND fobVeri = 0')) {
        $query->execute();
        $query->bind_result($u, $uid);
?>
<div class="contentvhr">
    <div class="interiorcontainer">
        <div class="interiorvhr">
            <b>User ID:</b>
            <select class='wew' size='8' id='select'>
<?php while($query->fetch()) {?>
                <option value='<?=$uid?>'><?=$u?>&nbsp;(<?=$uid?>)</option>
<?php }
    }
?>
            </select>
        </div>
        <div class="interiorvhr">
            <b>Key PIN</b>
            <input class='wew' type='text' value='<?=$pin?>' id='pin' disabled/>
            <b>Hash</b>
            <input class='wew' type='text' value='<?=$hash?>' id='hash' disabled/>
            <b>Link for Fob</b>
            <input class='wew' type='text' value='<?=$lnk?>'/>
        </div>
        <div class="interiorvhr nomargin">
        </div>
    </div>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('news', false, 'a')">Cancel</button>
    <button style="float: right" onClick="submitPin()">Apply</button>
</div>