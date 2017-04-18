<?php

<?php

    require('../controllers/sessionHandler.php');
    require('../controllers/configurator.php');
    require('../controllers/registrar.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    if($query = $mysqli->prepare('SELECT fname FROM user WHERE uid = ?;')) {
        $query->bind_param('i', $_SESSION['uid']);
        $query->execute();
        $query->bind_result($uid);
        $query->fetch();
        if(isset($uid)) {
            $query->fetch();
        }
    }

?>

?>

<div class="contentvhr">
    <div class="resourceTitle">
        <h1>Profile Builder</h1><hr/>
        <p>Hello <?=$fname?>!
    </div>
</div>