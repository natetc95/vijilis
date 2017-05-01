<script src='public/javascripts/jobs_v.js'/>

<?php

    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    require('controllers/json/arrays.php');
    require('controllers/json/assembly.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    if($query = $mysqli->prepare('SELECT user.username, vendor.lastloggedlocation FROM vendor INNER JOIN user ON vendor.user_uid = user.uid WHERE user.uid = ?')) {
        $jobs = array();
        $query->bind_param('i', $_SESSION['uid']);
        $query->execute();
        $query->bind_result($username, $location);
        $query->fetch();
        if(isset($username)) {
            $query->fetch();
            if(isset(json_decode($location, true)['time'])) {
                $location_time = json_decode($location, true)['time'];
            } else {
                $location_time = time();
            }
        }
    }

    if($query = $mysqli->prepare('SELECT resource.uid, resource.resourceTitle FROM vendor INNER JOIN resource ON resource.vendor_uid = vendor.uid WHERE vendor.user_uid = ? AND resource.resourceWasDeleted = 0 AND resource.approved = 1')) {
        $resources = array();
        $query->bind_param('i', $_SESSION['uid']);
        $query->execute();
        $query->bind_result($uid, $title);
        while($query->fetch()) {
            array_push($resources, array('uid' => $uid, 'title' => $title));
        }
    }

    if($query = $mysqli->prepare('SELECT requests.uid FROM (select resource.uid FROM resource INNER JOIN vendor ON resource.vendor_uid = vendor.uid WHERE vendor.user_uid = ?) as resource_table INNER JOIN requests ON resource_table.uid = requests.vendor_uid WHERE requests.serviceStatus < 40 ORDER BY requests.serviceStatus ASC')) {
        $jobs = array();
        $query->bind_param('i', $_SESSION['uid']);
        $query->execute();
        $query->bind_result($job);
        while($query->fetch()) {
            array_push($jobs, $job);
        }
    }
?>

<div class="contentvhr">
    <h1>My Jobs</h1>
    <hr/>
    <table>
        <tr>
            <td><b>Username:</b></td>
            <td><?=$username?></td>
        </tr>
        <tr>
            <td><b>Last Check In:</b></td>
            <td><?=date('D, m/d/Y H:i', $location_time)?></td>
        </tr>
    </table><hr/>
    <select class='wew' id ='filter' style='margin-bottom: 7px;'>
        <option value='-1' selected>Filter by Resource</option>
        <?php foreach($resources as $res) { ?> <option value=<?=$res['uid']?>><?=$res['uid']?> - <?=$res['title']?></option> <?php } ?>
    </select>
    <?php assembleSerBox(-1) ?>
    <div style='height: 7px'/>
    <?php assembleSBox(-1) ?>
    <div class="filterMenu" onClick='submitFilter()'>
        <i class="fa fa-filter" aria-hidden="true"></i>
    </div>

</div>
<div id='jobs-to-ajax'>
<?php foreach($jobs as $job) { 
        if($query = $mysqli->prepare('SELECT vendor_uid, serviceStatus, serviceDescription, serviceCode, priorityCode FROM requests WHERE uid = ?')) {
            $query->bind_param('i', $job);
            $query->execute();
            $query->bind_result($rid, $ss, $sd, $sc, $p);
            $query->fetch();
            if(isset($rid)) {
                $query->fetch();
            }
        }
?>

<div class="contentvhr q r<?=$rid?>">
        <div style='position: relative;'>
        <div class="resourceTitle">
            <h1>Job#<?=$job?>
        </div>
        <div class="resourceMenu" id='j<?=$job?>' onClick="openBoxMenu(<?=$job?>)">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
    </div><div style="height: 32px;"/>
    <b>Available Data:</b>
    <table>
        <tr>
            <td><b>Res #:</b></td>
            <td><?=$rid?></td>
        </tr>
        <tr>
            <td><b>Priority:</b></td>
            <td><?=$p?> - <?php echo(getAt('priority', $p)) ?></td>
        </tr>
        <tr>
            <td><b>Status:</b></td>
            <td><?=$ss?> - <?php echo(getAt('status', $ss)) ?></td>
        </tr>
        <tr>
            <td><b>Code</b></td>
            <td><?=$sc?> - <?php echo(getAt('service', $sc)) ?></td>
        </tr>
    </table>  
</div>

<?php } ?>
</div>

