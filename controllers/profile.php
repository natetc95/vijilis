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
        $o = array('status' => 'FAIL', 'code' => '');
        if($query = $mysqli->prepare("SELECT fname, lname, email, telnum FROM user WHERE uid = ?")) {
            $query->bind_param("i", $_SESSION['uid']);
            $query->execute();
            $query->bind_result($fno, $lno, $emo, $tno);
            $query->fetch();
            if(isset($fno)) {
                $query->fetch();
                if (!(strcmp($emo, $em) == 0 && strcmp($fno, $fn) == 0 && strcmp($lno, $ln) == 0 && strcmp($tno, $tn) == 0)) {
                    if($query = $mysqli->prepare("UPDATE user SET fname = ?, lname = ?, email = ?, telnum = ?  WHERE uid = ?")) {
                        $query->bind_param("ssssi", $fn, $ln, $em, $tn, $_SESSION['uid']);
                        $query->execute();
                        $o['status'] = 'SUCC';
                        if (strcmp($emo, $em) != 0) {
                            $o['code'] = $o['code'] . '<div class="codes">Email updated!<br/>New verification has been sent!</div>';
                        }
                        if (strcmp($tno, $tn) != 0) {
                            $o['code'] = $o['code'] . '<div class="codes">Phone Number updated!<br/>New verification has been sent!</div>';
                        }
                    } else {
                        $o['code'] = 'Could Not Update User Profile!';
                    }
                } else {
                    $o['status'] = 'SUCC';
                    $o['code'] = 'No changes detected!';
                }
            } else {
                $o['code'] = 'Could Not Find User Profile!';
            }
        } else {
            $o['code'] = 'Could Not Find User Profile!';
        }
        echo(json_encode($o));
    }

    function confirmEmail($mysqli, $em) {
        $o = array('status' => 'FAIL', 'code' => '');
        if($query = $mysqli->prepare("SELECT count(*) FROM user WHERE email = ? AND NOT uid = ?")) {
            $query->bind_param("si", $em, $_SESSION['uid']);
            $query->execute();
            $query->bind_result($cnt);
            $query->fetch();
            if(isset($cnt)) {
                $query->fetch();
                if ($cnt == 0) {
                    $o['status'] = 'SUCC';
                }
                $o['code'] = $cnt;
            }
        }
        echo(json_encode($o));
    }

    function editImage() {
        $o = array('status' => 'FAIL', 'code' => '');
        $exist = $GLOBALS['helpme'] . 'userfiles/u' . $_SESSION['uid'] . '/prof.png';
        $new = $GLOBALS['helpme'] . 'userfiles/u' . $_SESSION['uid'] . '/oldprofiles/' . time() . '.png';

        // Check to see if the user already has a profile image & move it if it does exist

        if(file_exists($exist)) {
            rename($exist, $new);
            $o['code'] = $o['code'] . 'Replaced old profile image!';
        } else {
            $o['code'] = $o['code'] . 'Added new profile image!';
        }

        // Upload the image

        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $fileError = $_FILES['file']['error'];

        if ($_FILES['file']['size'] != 0) {
            $fileContent = file_get_contents($_FILES['file']['tmp_name']);
            if($fileError == UPLOAD_ERR_OK) {
                if (imagepng(imagecreatefromstring($fileContent), $exist)) {
                    $o['code'] = $o['code'] . "File is valid, and was successfully uploaded.";
                    $o['status'] = "SUCC";
                } else {
                    $o['code'] = $o['code'] . "Possible file upload attack!";
                }
            }
        }

        echo(json_encode($o));
    }


    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'edit':
                editProfile($mysqli, $_POST['fn'], $_POST['ln'], $_POST['em'], $_POST['tn']);
                break;
            case 'img':
                editImage();
                break;
            case 'confirmEmail':
                confirmEmail($mysqli, $_POST['email']);
                break;
        }
    }

    $mysqli->close();

?>