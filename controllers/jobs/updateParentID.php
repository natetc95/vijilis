<?php

  require('../configurator.php');
  $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

  function updateParents( $mysqli, $uid, $parent ){
    $o = array('status' => 'FAIL', 'uid' => $uid, 'parent_uid' => $parent);

    if($query = $mysqli->prepare('UPDATE requests SET parent_uid = ? WHERE uid = ?')) {
      $query->bind_param( 'ii', $parent, $uid );
      $query->execute();
      $o['status'] = 'SUCC';
    }
    echo(json_encode($o));
  }

  updateParents( $mysqli, $_POST['uid'], $_POST['parent'] );

 ?>
