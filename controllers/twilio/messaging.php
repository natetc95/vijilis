<?php

    error_reporting(E_ALL);
	ini_set("display_errors","On");

    require('Twilio/autoload.php');

    use Twilio\Rest\Client;

    function sendMessage($t, $m) {
        $client = new Client($GLOBALS['twilio_usr'], $GLOBALS['twilio_pwd'], $GLOBALS['twilio_sid']);
        $client->messages->create(
            $t,
            array(
                'from' => $GLOBALS['twilio_num'],
                'body' => $m
            )
        );
        return 'SUCC';
    }

?>