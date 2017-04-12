<?php
    session_start();
    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
?>

<script src="public/javascripts/myResources.js"></script>
<div class="contentvhr">
    <h1><?=$_SESSION['name']?>'s Resources</h1>
</div>
<div class="contentvhr">
    <div class="resourceTitle">
        <h1>Add A Resource</h1>
    </div>
    <div class="resourceIconAdd" title="Edit" onClick="contentLoader('resources/add_resource', false)">
        <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add
    </div>
</div>
<?php

    function resourceType($x) {
        switch($x) {
            case 0:
                return 'Tow Truck';
                break;
            case 1:
                return 'Ambulance';
                break;
            case 2:
                return 'Snow Plow';
                break;
            case 3:
                return 'Food Stuffs';
                break;
        }
    }

    if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
        $query->bind_param('i', $_SESSION['uid']);
        $query->execute();
        $query->bind_result($uid);
        $query->fetch();
        if(isset($uid)) {
            $query->fetch();
            if($query = $mysqli->prepare("SELECT uid, resourceType, resourceTitle, resourceDescription, resourceWasDeleted FROM resource WHERE vendor_uid = ?")) {
                $query->bind_param('i', $uid);
                $query->execute();
                $query->bind_result($uid2, $type, $title, $description, $valid);
                while($query->fetch()) { 
                    if ($valid == 0) {
                        $pic = "userfiles/u" . $_SESSION['uid'] . "/v" . $uid . "/r" . $uid2 . "/img2.png";
                ?>
                <div class="contentvhr">
                    <div>
                        <div class="resourceTitle">
                            <h1> <?= $title ?> </h1>
                        </div>
                        <div class="resourceIconDelete" title="Delete" onClick="deleteResource(<?=$uid2?>)">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;Delete
                        </div>
                        <div class="resourceIconEdit" title="Edit" onClick="openEditor(<?=$uid2?>)">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit
                        </div>
                    </div>
                    <div style="margin-top: 40px; height: 150px;">
                        <div class="resourceImage">
                            <img width="150px;" height="100px" style="margin-left: -50px;" src="<?=$pic?>">
                        </div>
                        <div class="resourceInfo">
                            <b>Resource #: </b><?= $uid2 ?><br/>
                            <b>Resource Type: </b><?=resourceType($type)?><br/>
                            <b>Owner: </b><?= $_SESSION['name'] ?><br/>
                            <b>Description: </b><xmp><?= $description ?></xmp>
                        </div>
                    </div>
                </div>
                <?php } } 
            } else {
                echo("<br/>ERROR OCCURRED!");
            }
        } else {
            echo("<br/>NO VENDOR PROFILE ASSOCIATED");
        }
    }

    $mysqli->close();
?>
    