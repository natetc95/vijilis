<form action="insertUser.php" method="POST">
    USERNAME:<br/>
    <input type="text" name="un"/><br/><br/>
    EMAIL:<br/>
    <input type="text" name="em"/><br/><br/>
    PASSWORD:<br/>
    <input type="password" name="pw"/><br/><br/>
    <input type="submit">
</form>

<?php
    require('controllers/configurator.php');
    $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
    echo($DB_HOST);
?>