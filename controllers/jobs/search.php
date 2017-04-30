<?php

require('../configurator.php');

$mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

function vendorData($mysqli, $str){
  $o = array(
         'status' => 'FAIL',
         'fname' => '',
         'lname' => '',
         'username' => '',
         'uid' => ''
       );
  $list = array();

  if ($query = $mysqli->prepare('SELECT username, fname, lname, uid FROM user WHERE acttype = 1 AND ( fname = ? OR lname = ? )')) {
    $query->bind_param('ss', $str, $str);
    $query->execute();
    $query->bind_result($uname, $fname, $lname, $uid);

    while($query->fetch()) {
      if(isset($uname)){
        $o['status'] = 'SUCC';
        $o['fname'] = $fname;
        $o['lname'] = $lname;
        $o['username'] = $uname;
        $o['uid'] = $uid;
        $list[] = $o;
      }
    }
  }
  echo(json_encode($list));
}



if( isset($_POST['action']) ){
  switch($_POST['action']) {
      default:

          break;
      case 'pullVendorData':
          vendorData($mysqli, $_POST['str']);
          break;
  }
}

?>
