<?php

    /* resources.php
     * Handles all resource related requests
     * Included Functions:
     * - resourceType()
     * - addResource()
     * - editResource()
     * - deleteResource()
     * - addImage()
     * 
     * VIJILIS: Emergency Response System
     *
     * Senior Design Team 16040
     * University of Arizona
     * Nathaniel Christianson & Travis Roser
     */



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
                            if($query = $mysqli->prepare("INSERT INTO resource VALUES (0, ?, ?, ?, ?, '{}', 1, 0, 0, ?, ?, ?, ?, ?, 0, 0, 0)")) {
                                $query->bind_param("iissssiss", $vendorid, $_POST["type"], $_POST["title"], $_POST["desc"], $_POST['make'], $_POST['model'], $_POST['year'], $_POST['class'], $_POST['cxim']);
                                $query->execute();
                                if($query = $mysqli->prepare("SELECT uid FROM resource WHERE resourceTitle = ?")) {
                                    $query->bind_param("s", $_POST['title']);
                                    $query->execute();
                                    $query->bind_result($uid);
                                    $query->fetch();
                                    if(isset($uid)) {
                                        $query->fetch();
                                        chdir("../userfiles/u" . $_SESSION['uid'] . "/v" . $vendorid);
                                        mkdir("r" . $uid);
                                        echo($uid);
                                        AlertResource($email, $name, $_POST["title"], resourceType($_POST["type"]), $_POST["desc"], $uid);
                                    }
                                }
                            } else {
                                echo("FAIL");
                            }
                        }
                    } else {
                        echo ("FAIL");
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
                    if($query = $mysqli->prepare("UPDATE resource SET resourceFollowsVendor = ?, resourceTitle=?, resourceType=?, resourceDescription=?, vehicleMake = ?, vehicleModel = ?, vehicleYear = ?, towingClass = ?, foodDate = ? WHERE uid = ?")) {
                        $query->bind_param("isisssissi", $_POST['rfv'], $_POST["title"], $_POST["type"], $_POST["desc"], $_POST['make'], $_POST['model'], $_POST['year'], $_POST['class'], $_POST['cxim'], $_POST["uid"]);
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

    function addImage($mysqli, $rid, $imagetype) {
        if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
            $query->bind_param("i", $_SESSION['uid']);
            $query->execute();
            $query->bind_result($vid);
            $query->fetch();
            if(isset($vid)) {
                $query->fetch();
                $fileName = $_FILES['file']['name'];
                $fileType = $_FILES['file']['type'];
                $fileError = $_FILES['file']['error'];
                echo $_FILES['file']['tmp_name']  . "\n";

                if ($_FILES['file']['size'] != 0) {

                    $fileContent = file_get_contents($_FILES['file']['tmp_name']);

                    if($fileError == UPLOAD_ERR_OK){
                        $upload = $GLOBALS['helpme'] . "userfiles/u" . $_SESSION['uid'] . "/v" . $vid . "/r" . $rid . "/" . $imagetype  . ".png";
                        if(file_exists($upload)) {
                            unlink($upload);
                        }
                        echo($upload . "\n");
                        if (imagepng(imagecreatefromstring($fileContent), $upload)) {
                            echo "File is valid, and was successfully uploaded.\n";
                        } else {
                            echo "Possible file upload attack!\n";
                        }
                    } else {
                        echo 'FAIL';   
                    }
                }
            }
        }
    }

    function activation($mysqli, $uid, $yes) {
        $o = array('STAT' => 'FAIL', 'CODE' => $yes);
        if($query = $mysqli->prepare("SELECT uid FROM vendor WHERE user_uid = ?")) {
            $query->bind_param("i", $_SESSION['uid']);
            $query->execute();
            $query->bind_result($vid);
            $query->fetch();
            if(isset($vid)) {
                $query->fetch();
                if($query = $mysqli->prepare("UPDATE resource SET active = 0 WHERE vendor_uid = ?")) {
                    $query->bind_param("i", $vid);
                    $query->execute();
                    if($yes == 'true') {
                        if($query = $mysqli->prepare("UPDATE resource SET active = 1 WHERE vendor_uid = ? AND uid = ?")) {
                            $query->bind_param("ii", $vid, $uid);
                            $query->execute();
                        }
                    }
                    $o['STAT'] = 'SUCC';
                }
            }
        }
        echo(json_encode($o));
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
        case 'img':
            addImage($mysqli, $_POST['uid'], $_POST['imgtype']);
            break;
        case 'activate':
            activation($mysqli, $_POST['uid'], $_POST['do']);
            break;
    }

    $mysqli->close();
?>