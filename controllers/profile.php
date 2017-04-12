<?php

    /* profile.php
     * Handles all profile related requests
     * Included Functions:
     * - editProfile()
     * - editImage()
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

    function editProfile($mysqli, $fn, $ln, $em, $tn) {
        if($query = $mysqli->prepare("UPDATE user SET fname = ?, lname = ?, email = ?, telnum = ?  WHERE uid = ?")) {
            $query->bind_param("ssssi", $fn, $ln, $em, $tn, $_SESSION['uid']);
            $query->execute();
            echo('SUCC');
        } else {
            echo('FAIL');
        }
    }


    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'edit':
                editProfile($mysqli, $_POST['fn'], $_POST['ln'], $_POST['em'], $_POST['tn']);
                break;
            case 'prof':
                editImage();
        }
    }

?>