<base href="../"/>
<?php

    error_reporting(E_ALL);
	ini_set("display_errors","On");
    
    chdir("../");
    if(isset($_POST["page"])) {
        require(getcwd() . "/" . $_POST["page"] . ".php");
    }
    else {
        require("index.php");
    }

?>
