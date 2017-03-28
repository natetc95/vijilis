<?php

    session_start();
    require('configurator.php');
    require('verification.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    if(isset($_POST["title"]) && isset($_POST["type"]) && isset($_POST["desc"])) {
        if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
            $query->bind_param("i", $_SESSION['uid']);
            $query->execute();
            $query->bind_result($vendorid);
            $query->fetch();
            if(isset($vendorid)) {
                $query->fetch();
                if($query = $mysqli->prepare("SELECT email, fname FROM user WHERE uid = ?")) {
                    $query->bind_param("i", $_SESSION['uid']);
                    $query->execute();
                    $query->bind_result($email, $name);
                    $query->fetch();
                    if(isset($email)) {
                        $query->fetch();
                        if($query = $mysqli->prepare("INSERT INTO resource VALUES (0, ?, ?, ?, ?, '{}', 1, 0)")) {
                            $query->bind_param("iiss", $vendorid, $_POST["type"], $_POST["title"], $_POST["desc"]);
                            $query->execute();
                            echo("SUCC");
                            AlertResource($email, $name, $_POST["title"], $_POST["type"], $_POST["desc"], 14);
                        } else {
                            echo("FAIL");
                        }
                    }
                }
            }
        } else {
            echo("FAIL");
        }
    }
?>