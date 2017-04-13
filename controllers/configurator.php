<?php

   /* configurator.php
    * Holds all the login information needed for the system to function
    * 
    * VIJILIS: Emergency Response System
    *
    * Senior Design Team 16040
    * University of Arizona
    * Nathaniel Christianson & Travis Roser
    */

    // DATABASE LOGIN INFORMATIN

        $DB_HOST = 'localhost';
        $DB_UNME = 'root';
        $DB_PWRD = 'travis';
        $DB_NAME = 'vijilis';

    // EMAIL LOGIN INFORMATION

        $GLOBALS['emailToUse'] = "chimerasystemsaz@gmail.com";
        $GLOBALS['emailPassword'] = "ChimeraSystems88!";

    // FILES TO ROOT
    // if in /var/www/html it should be '/'
    // else if in htdocs (XAMPP) make it the folder the site is in
    // so for me, it would be /vijilis/vijilis/

        $GLOBALS['ftr'] = '/vijilis/';
        $GLOBALS['helpme'] = 'C:/xampp/htdocs/vijilis/vijilis/'

?>
