<?php

    require('../controllers/sessionHandler.php');
    require('../controllers/configurator.php');
    require('../controllers/registrar.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    if($query = $mysqli->prepare('SELECT uid, approved FROM vendor WHERE user_uid = ?;')) {
        $query->bind_param('i', $_SESSION['uid']);
        $query->execute();
        $query->bind_result($uid, $appr);
        $query->fetch();
        if(isset($uid) && isset($appr)) {
            $query->fetch();
            if ($appr == 1) {
                echo("<script>contentLoader('profile/my_profile', false, 'v')</script>");
            } else {
                echo("<script>contentLoader('profile/profile_builder', false, 'v')</script>");
            }
        } else {
            create_vendor_profile($mysqli, $_SESSION['uid']);
            echo("<script>contentLoader('profile/profile_builder', false, 'v')</script>");
        }
    }

?>