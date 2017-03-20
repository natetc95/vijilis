<?php
    require('configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    if(isset($_POST['uname'])) {
        if($query = $mysqli->prepare("SELECT COUNT(*) FROM user WHERE username = ?")) {
            $query->bind_param("s", $_POST['uname']);
            $query->execute();
            $query->bind_result($cnt);
            $query->fetch();
            if($cnt > 0) {
                echo("FALSE");
            } else {
                echo("TRUE");
            }
        }
    }
    $mysqli->close();
?>