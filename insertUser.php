<?php
    require('configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    $u = $_POST['un'];
    $e = $_POST['em'];
    $pwd = $_POST['pw'];
    $hash = password_hash($pwd, PASSWORD_BCRYPT);
    if(password_verify($pwd, $hash)) {
        if($query = $mysqli->prepare('INSERT INTO user VALUES (0, ?, ?, ?);')) {
            $query->bind_param("sss", $u, $e, $hash);
            $query->execute();
        }
        if($query = $mysqli->prepare("SELECT * FROM USER WHERE USERNAME = ?")) {
            $query->bind_param("s", $u);
            $query->execute();
            $query->bind_result($id, $uname, $email, $pw);
            while($query->fetch()) {
                echo($uname . "<br/>");
            }
        }
    }
    $mysqli->close();
?>

<a href="index.php">Home</a>