<?php
    error_reporting(E_ALL);
	ini_set("display_errors","On");
    require(__DIR__ . '/configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    if(isset($_POST['job'])) {
        if($query = $mysqli->prepare('SELECT locationCoords FROM requests WHERE uid = ?')) {
            $query->bind_param('i', $_POST['job']);
            $query->execute();
            $query->bind_result($desc);
            $query->fetch();
            if(isset($desc)) {
                $query->fetch();
                echo
            }
        }
    }

?>