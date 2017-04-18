<?php
    
    require('twilio/autoload.php');
    require('../configurator.php');

    use Twilio\Rest\Client;

    function sendMessage($to, $message) {
        $client = new Client($GLOBALS['twilio_usr'], $GLOBALS['twilio_pwd'], $GLOBALS['twilio_sid']);
        $client->messages->create(
            $to,
            array(
                'from' => $GLOBALS['twilio_num'],
                'body' => $message
            )
        );
    }