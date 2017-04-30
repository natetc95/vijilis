<?php

    function assembleSBox($value) {
        $string = file_get_contents(__DIR__ . "/status.json");
        $json = json_decode($string, true);
        
        $statuses = "<select class='wew' id='status'><option value='-1' selected> Status Code </option>";
        
        foreach($json as $stat) {
            $m = $stat['message'];
            $c = $stat['code'];
            if ("$value" == $c) {
                $statuses .= "<option value='$c' selected>$c - $m</option>";                
            } else {
                $statuses .= "<option value='$c'>$c - $m</option>";
            }
            
        }

        $statuses .= "</select>";
        echo $statuses;
    }

    function assemblePBox($value) {
        $string = file_get_contents(__DIR__ . "/priority.json");
        $json = json_decode($string, true);
        
        $statuses = "<select class='wew' id='priority'>";
        
        foreach($json as $stat) {
            $m = $stat['message'];
            $c = $stat['code'];
            if ("$value" == $c) {
                $statuses .= "<option value='$c' selected>$c - $m</option>";                
            } else {
                $statuses .= "<option value='$c'>$c - $m</option>";
            }
            
        }

        $statuses .= "</select>";
        echo $statuses;
    }

    function assembleSerBox($value) {
        $string = file_get_contents(__DIR__ . "/service.json");
        $json = json_decode($string, true);
        
        $statuses = "<select class='wew' id='service'><option value='-1' selected> Service Code </option>";
        
        foreach($json as $stat) {
            $m = $stat['message'];
            $c = $stat['code'];
            if ("$value" == $c) {
                $statuses .= "<option value='$c' selected>$c - $m</option>";                
            } else {
                $statuses .= "<option value='$c'>$c - $m</option>";
            }
            
        }

        $statuses .= "</select>";
        echo $statuses;
    }
    
?>