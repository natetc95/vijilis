<base href="../"/>
<?php
    chdir("../");
    if(isset($_POST["page"])) {
        if (isset($_POST["x"]) && isset($_POST["y"])) {
            $x = $_POST["x"];
            $y = $_POST["y"];
            require(getcwd() . "\\" . $_POST["page"] . ".php");
        } else {
            require(getcwd() . "\\" . $_POST["page"] . ".php");
        }
    }
    else {
        require("index.php");
    }
    
?>