<?php 

    error_reporting(E_ALL);
	ini_set("display_errors","On");

    require('../configurator.php');
    require('../sessionHandler.php');
    require('../json/assembly.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    $next = False;

    if (isset($_POST['uid'])) {
        $p = $_POST['uid'];
        if($query = $mysqli->prepare('SELECT concurrencyTimeout, parent_uid, incidentmanager_uid, vendor_uid, locationCoords, locationDescription, serviceCode, serviceStatus, serviceDescription, priorityCode FROM requests WHERE uid = ? LIMIT 1')) {
            $query->bind_param('i', $p);
            $query->execute();
            $query->bind_result($time, $parent, $manager, $vendor, $location, $spec, $code, $status, $desc, $priority);
            $query->fetch();
            if(isset($parent) && $parent != 0) {
                $query->fetch();
                if($query = $mysqli->prepare('SELECT uid FROM requests WHERE parent_uid = ? AND uid != parent_uid')) {
                    $query->bind_param('i', $parent);
                    $query->execute();
                    $query->bind_result($sibling);
                    $siblings = array();
                    while($query->fetch()) {
                        array_push($siblings, $sibling);
                    }
                    if (count($siblings) == 0) {
                        $sibling = 'None';
                    } elseif (count($siblings) == 1) {
                        $sibling .= "<a href='javascript:loadJob(<?=$sibling?>)'><?=$sibling?></div>";
                    } else {
                        $sibling = "";
                        foreach($siblings as $key) {
                            $sibling .= "<a href='javascript:loadJob($key)'>$key</div></a>&nbsp;";
                        }
                    }
                    $next = True;
                }
                if($query = $mysqli->prepare('SELECT username FROM user WHERE uid = ?')) {
                    $query->bind_param('i', $manager);
                    $query->execute();
                    $query->bind_result($manager_name);
                    $query->fetch();
                    if(isset($manager_name)) {
                        $query->fetch();
                    }
                }
                $location = json_decode($location, true);
            }
        }
    }

    if ($next) {

?>
<input type='hidden' value=<?=$p?> id='uid'/>
<input type='hidden' value=<?=$time?> id='time'/>
<div class="contentvhr" style='overflow: auto'>
    <h1>Job #<?=$p?></h1>
    <div class="breaker">
        <table>
            <tr>
                <td><b>Parent:</b></td>
                <td><a href='javascript:loadJob(<?=$parent?>)'><?=$parent?></div></td>
            </tr>
            <tr>
                <td><b>Siblings:</b></td>
                <td><?=$sibling?></td>
            </tr>
            <tr>
                <td><b>Creator:</b></td>
                <td><?=$manager_name?></td>
            </tr>
            <tr>
                <td><b>Latitude:</b></td>
                <td><?=$location['lat']?></td>
            </tr>
            <tr>
                <td><b>Longitude:</b></td>
                <td><?=$location['lng']?></td>
            </tr>
        </table>
    </div>
</div>
<div class="contentvhr">
    <h1>Information</h1>
    <div class="interiorvhr">
        <b>Status</b><br/>
        <?php assembleSBox($status);?><br/><div style='height: 33px;'/>
        <b>Priority</b><br/>
        <?php assemblePBox($priority);?><br/><div style='height: 33px;'/>
        <b>Service</b><br/>
        <?php assembleSerBox($code);?><br/>
    </div>
    <div class="interiorvhr">
        <b>Special Instructions:</b><br/>
        <textarea id='spec' class='wew' rows='8'><?=$spec?></textarea>
    </div>
    <div class="interiorvhr">
        <b>Description</b><br/>
        <textarea id='desc' class='wew' rows='8'><?=$desc?></textarea>
    </div>
</div>
<div class="contentvhr">
    <h1>Vendor Information</h1>
    <div class="interiorvhr">
        Dispatching History:
        <ol>
        <?php
            if($query = $mysqli->prepare('SELECT resNum, dist, stop FROM messages WHERE refNum = ?')) {
                $query->bind_param('i', $p);
                $query->execute();
                $query->bind_result($r, $d, $s);
                while($query->fetch()) {
                    if (isset($vendor) && $vendor = $r) {
                        echo('  <li>R#'. $r . ' - Approximately ' . sprintf('%.2f',$d) . ' miles away.&nbsp;&nbsp;<i class="fa fa-check" style="color: green" aria-hidden="true"></i></li>');
                    } else {
                        if($s == 1) {
                            echo('  <li>R#'. $r . ' - Approximately ' . sprintf('%.2f',$d) . ' miles away.&nbsp;&nbsp;<i class="fa fa-times" style="color: red" aria-hidden="true"></i></li>');
                        } else {
                            echo('  <li>R#'. $r . ' - Approximately ' . sprintf('%.2f',$d) . ' miles away.&nbsp;&nbsp;<i class="fa fa-spinner fa-spin" style="color: blue" aria-hidden="true"></i></li>');
                        }
                    }
                }
            }
        ?>
        </ol>
    </div>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="window.location='im/index.php'">Cancel</button>
    <button onClick="saveJob()" style="float: right">Save</button>
</div>

<?php } else { ?>

<div class="contentvhr">
    <center><h1>Invalid Request!</h1></center>
</div>

<?php } ?>