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

    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'edit':
                editProfile($mysqli, $_POST['fn'], $_POST['ln'], $_POST['em'], $_POST['tn']);
                break;
            case 'prof':
                editImage();
                break;
            case 'confirmEmail':
                confirmEmail($mysqli, $_POST['email']);
                break;
        }
    }

?>