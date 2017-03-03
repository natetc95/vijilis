<?php
    if(isset($_POST["page"])) {
        require("../views/" . $_POST["page"] . ".php");
    }
?>