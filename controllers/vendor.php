<base href="../"/>
<?php
    if(isset($_POST["page"])) {
        if (isset($_POST["x"]) && isset($_POST["y"])) {
            require("../views/" . $_POST["page"] . ".php");
        } else {
            require("../views/" . $_POST["page"] . ".php");
        }
    }
?>