<script src="public/javascripts/admin/approvals.js"/>
<?php

    session_start();
    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    if ($query = $mysqli->prepare('SELECT resourceTitle, uid FROM resource WHERE approved = 0')) {
        $query->execute();
        $query->bind_result($u, $u2);

?>
<div class="contentvhr">
    <h1><i class="fa fa-code" aria-hidden="true"></i>&nbsp;Resources awaiting approval</h1><hr/>
    <div class="interiorcontainer">
        <div class="interiorvhr">
            <div class='code-select-box' style='height:575px'>
            <?php while($query->fetch()) { ?>        
                <div class='code-select-entry' onclick='openResource(<?=$u2?>)'>
                    <h1><?=$u?></h1>
                </div>
                <?php }} ?>
            </div>
        </div>
        <div class="interiorvhr">
            <h2>Resource Information</h2><br/><hr/>
            <table>
                <tr>
                    <td><b>Resource ID:</b></td>
                    <td id="uid"></xmp></td>
                </tr>
                <tr>
                    <td><b>Title:</b></td>
                    <td><xmp id="title"></xmp></td>
                </tr>
                <tr>
                    <td><b>Type:</b></td>
                    <td><xmp id="type"></xmp></td>
                </tr>
                <tr>
                    <td><b>Description:</b></td>
                    <td><xmp id="desc"></xmp></td>
                </tr>
            </table>
            <h4 style='padding: 0; margin: 5px 0px 0px 0px'>Vehicle Information</h4><hr/>
            <table>
                <tr>
                    <td><b>Make:</b></td>
                    <td><xmp id="make"></xmp></td>
                </tr>
                
                <tr>
                    <td><b>Model:</b></td>
                    <td><xmp id="model"></xmp></td>
                </tr>
                <tr>
                    <td><b>Year:</b></td>
                    <td><xmp id="year"></xmp></td>
                </tr>
            </table>
            <h4 style='padding: 0; margin: 5px 0px 0px 0px'>Food Information</h4><hr/>
            <table>
                <tr>
                    <td><b>Expiration Date:</b></td>
                    <td><xmp id="exp-date"></xmp></td>
                </tr>
            </table>
            <br/><h2>User Information</h2><br/><hr/>
            <table>
                <tr>
                    <td><b>Name:</b></td>
                    <td><xmp id="name"></xmp></td>
                </tr>
                <tr>
                    <td><b>User ID:</b></td>
                    <td><xmp id="uuid"></xmp></td>
                </tr>
                <tr>
                    <td><b>Vendor ID:</b></td>
                    <td><xmp id="vid"></xmp></td>
                </tr>
                <tr>
                    <td><b>Email:</b></td>
                    <td><xmp id="email"></xmp></td>
                </tr>
                <tr>
                    <td><b>Telephone:</b></td>
                    <td><xmp id="telnum"></xmp></td>
                </tr>
                <tr>
                    <td><b>Zip Code:</b></td>
                    <td><xmp id='zip'></xmp></td>
                </tr>
            </table>
        </div>
        <div class="interiorvhr nomargin">
            <h2>Configurables</h2><br/><hr/>
            <table>
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
            <br/><h2>Applicant</h2><br/><hr/>
            <center>
                <b>Custom Message</b>
                <textarea id='custmsg' rows='20' cols='30'></textarea><br/><br/>
                <button id='x' onClick="contentLoader('news', false, 'a')" disabled>Decline</button>
                <button id='y' onClick="createIncidentManager()" disabled>Approve</button><br/>
            </center>
        </div>
    </div>
</div>