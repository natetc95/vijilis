<?php
    require('../configurator.php');
    require('../verification.php');

    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);

    function openUser($mysqli, $uid) {
        $o = array('status' => 'FAIL', 'code' => array());
        if ($query = $mysqli->prepare('SELECT username, fname, lname, uid, email, telnum FROM user WHERE uid = ?')) {
            $query->bind_param('s', $uid);
            $query->execute();
            $query->bind_result($u, $f, $l, $u2, $e, $t);
            $query->fetch();
            if(isset($u)) {
                $query->fetch();
                $o['status'] = 'SUCC';
                $o['code']['name'] = $f . ' ' . $l;
                $o['code']['uid'] = $u2;
                $o['code']['email'] = $e;
                $o['code']['telnum'] = $t;
            }
        }
        echo(json_encode($o));
    }

    function approveUser($mysqli, $uid, $dist, $not, $msg, $method, $type) {
        $o = array('status' => 'FAIL', 'code' => array());
        if ($query = $mysqli->prepare('SELECT username, fname, lname, uid, email, telnum FROM user WHERE uid = ?')) {
            $query->bind_param('s', $uid);
            $query->execute();
            $query->bind_result($u, $f, $l, $u2, $e, $t);
            $query->fetch();
            if(isset($u)) {
                $query->fetch();
                if ($query = $mysqli->prepare('UPDATE user SET acttype = ?, district = ? WHERE uid = ?')) {
                    $query->bind_param('iis', $type, $dist, $uid);
                    $query->execute();
                    $o['status'] = 'SUCC';
                    $o['code'] = 'Updated!';
                    if ($not == 'true') {
                        approvalEmail($e, $f, 'approved', $msg);
                    }
                }
            }
        }
        echo(json_encode($o));
    }

    function declineUser($mysqli, $uid, $not, $msg) {
        $o = array('status' => 'FAIL', 'code' => array());
        if ($query = $mysqli->prepare('SELECT username, fname, lname, uid, email, telnum FROM user WHERE uid = ?')) {
            $query->bind_param('s', $uid);
            $query->execute();
            $query->bind_result($u, $f, $l, $u2, $e, $t);
            $query->fetch();
            if(isset($u)) {
                $query->fetch();
                if ($query = $mysqli->prepare('UPDATE user SET acttype = -1 WHERE uid = ?')) {
                    $query->bind_param('s', $uid);
                    $query->execute();
                    $o['status'] = 'SUCC';
                    $o['code'] = 'Declined User!';
                    if ($not == 'true') {
                        approvalEmail($e, $f, 'declined', $msg);
                    }
                }
            }
        }
        echo(json_encode($o));
    }

    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'pullUserData':
                openUser($mysqli, $_POST['uid']);
                break;
            case 'approveUser':
                approveUser($mysqli, $_POST['uid'], $_POST['poly'], $_POST['notify'], $_POST['msg'], $_POST['meth'], $_POST['type']);
                break;
            case 'declineUser':
                declineUser($mysqli, $_POST['uid'], $_POST['notify'], $_POST['msg']);
                break;
            default:
                echo(json_encode(array('status'=>'FAIL', 'code' => 'Invalid Action: ' . $_POST['action'])));
                break;
        }
    }