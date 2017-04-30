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
        $GLOBALS['helpme'] = 'C:/xampp/htdocs/vijilis/vijilis/';

    // TWILIO FILES

        $GLOBALS['twilio_usr'] = 'SKc085fd225a45f1e936d672b116f8c0b6';
        $GLOBALS['twilio_pwd'] = '0Rrak4cTTg2I7f9UQdNRYe2PS1FTDYCm';
        $GLOBALS['twilio_sid'] = 'AC27331a077ac468fb5a51ebd2bac7d3bd';
        $GLOBALS['twilio_num'] = '+14805256796';

?>
