<?php
    session_start();
    require('configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
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
    $mysqli->close();
?>