<?php

    session_start();
    require('configurator.php');
    require('verification.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

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

    function addResource($mysqli) {
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
                                if($query = $mysqli->prepare("SELECT uid FROM resource WHERE resourceTitle = ?")) {
                                    $query->bind_param("s", $_POST['title']);
                                    $query->execute();
                                    $query->bind_result($uid);
                                    $query->fetch();
                                    if(isset($uid)) {
                                        $query->fetch();
                                        echo("SUCC");
                                        AlertResource($email, $name, $_POST["title"], resourceType($_POST["type"]), $_POST["desc"], $uid);
                                    }
                                }
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
    }

    function editResource($mysqli) {
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
    }

    function deleteResource($mysqli) {
        if(isset($_POST["resourceToDelete"])) {
            if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
                $query->bind_param("i", $_SESSION['uid']);
                $query->execute();
                $query->bind_result($vendorid);
                $query->fetch();
                if(isset($vendorid)){
                    $query->fetch();
                    if($query = $mysqli->prepare("SELECT vendor_uid FROM resource WHERE uid = ?")) {
                        $query->bind_param("i", $_POST["resourceToDelete"]);
                        $query->execute();
                        $query->bind_result($vendorid_r);
                        $query->fetch();
                        if(isset($vendorid_r)){
                            $query->fetch();
                            if($vendorid_r == $vendorid) {
                                if($query = $mysqli->prepare("UPDATE resource SET resourceWasDeleted = 1 WHERE uid = ?")) {
                                    $query->bind_param('i',$_POST["resourceToDelete"]);
                                    $query->execute();
                                } else {
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    $action = $_POST['action'];

    switch($action) {
        case 'addResource':
            addResource($mysqli);
            break;
        case 'editResource':
            editResource($mysqli);
            break;
        case 'deleteResource':
            deleteResource($mysqli);
            break;
        
    }

    $mysqli->close();
?>