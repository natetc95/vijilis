<?php
    chdir('../');
    require('controllers/configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    $name = 'Nate';
    $str = '%' . $name . '%';
    echo ('$str -> ' . $str . '</br>');

    $list = array();
    $o = array();

    $qstr = ' SELECT
                user.username,
                user.fname,
                user.lname,
                user.uid 
             FROM
                user 
             INNER JOIN
                vendor
             ON
                vendor.user_uid = user.uid
             WHERE
                user.fname LIKE ? OR
                user.lname LIKE ? ';

    if ($query = $mysqli->prepare($qstr)) {

        $query->bind_param('ss', $str, $str);
        $query->execute();
        $query->bind_result($u, $f, $l, $uid);
        while($query->fetch()) {
            $o['status'] = 'SUCC';
            $o['fname'] = $f;
            $o['lname'] = $l;
            $o['username'] = $u;
            $o['uid'] = $uid;
            $list[] = $o;
        }
    }

    echo(json_encode($list));

?>