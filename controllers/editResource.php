<?php

    session_start();
    require('configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    if(isset($_POST["title"]) && isset($_POST["type"]) && isset($_POST["desc"]) && isset($_POST["uid"])) {
        if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
            $query->bind_param("i", $_SESSION['uid']);
            $query->execute();
            $query->bind_result($vendorid);
            $query->fetch();
            if(isset($vendorid)) {
                $query->fetch();
                if($query = $mysqli->prepare("UPDATE resource SET resourceTitle=?, resourceType=?, resourceDescription=? WHERE uid = ?")) {
                    $query->bind_param("sisi", $_POST["title"], $_POST["type"], $_POST["desc"], $_POST["uid"]);
                    $query->execute();
                    echo("SUCC");
                } else {
                    echo("FAIL");
                }
            }
        } else {
            echo("FAIL");
        }
    }
?>