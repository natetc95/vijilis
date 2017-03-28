<?php
    chdir("../../");
    session_start();
    require('controllers/configurator.php');
    require('controllers/sessionHandler.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    if($query = $mysqli->prepare("SELECT uid, username, email FROM user WHERE uid = ?")) {
        $query->bind_param("i", $_SESSION['uid']);
        $query->execute();
        $query->bind_result($uid, $uname, $email);
        $query->fetch();
        if(isset($uid)) {
            $query->fetch();
            $x = md5($uid . $uname . $email);
        }
    }
    if(isset($_POST['uid']) && $_POST['uid'] != null) {
        $y = $_POST['uid'];
    } else {
        $scannedTag = "No Tag Scanned!";
        $scannedOwner = "No Tag Scanned!";
        $scannedVeri = "No Tag Scanned!";
    }
?>

<div class="contentvhr">
    <h1><?=$_SESSION['name']?>'s Check Ins</h1>
</div>
<div class="contentvhr">
    <h1>Check Ins</h1>
    <hr/>
    <div class="checkinbtn">
        Check In!
    </div>
</div>
<div class="contentvhr">
    <h1>Last Check In</h1>
    <hr/>
    <div><b>Date: </b><?php echo(date('D, d/M/Y H:i'));?></div>
    <div><b>Latitude: </b></div>
    <div><b>Longitude: </b></div>
</div>
<div class="contentvhr">
    <h1>Tag Information</h1>
    <hr/>
    <h2>Your Tag</h2><br/>
    <table>
        <tr>
            <td><b>Tag ID:</b></td>
            <td><?=$x?></td>
        </tr>
        <tr>
            <td><b>Owner:</b></td>
            <td><?=$_SESSION['name']?></td>
        </tr>
        <tr>
            <td><b>Tag Verified:</b></td>
            <td>Yes</td>
        </tr>
    </table><br/>
    <h2>Scanned Tag</h2><br/>
    <table>
        <tr>
            <td><b>Tag ID:</b></td>
            <td><?=$scannedTag?></td>
        </tr>
        <tr>
            <td><b>Owner:</b></td>
            <td><?=$scannedOwner?></td>
        </tr>
        <tr>
            <td><b>Tag Verified:</b></td>
            <td><?=$scannedVeri?></td>
        </tr>
    </table>
</div>