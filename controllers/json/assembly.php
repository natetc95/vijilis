<?php

    function assembleSBox($value) {
        $string = file_get_contents(__DIR__ . "/status.json");
        $json = json_decode($string, true);
        
        $statuses = "<select class='wew' id='status'><option value='-1' selected> -- Choose One -- </option>";
        
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
        
        $statuses = "<select class='wew' id='priority'><option value='-1' selected> -- Choose One -- </option>";
        
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
        
        $statuses = "<select size='4' class='wew' id='service'><option value='-1' selected> -- Choose One -- </option>";
        
        foreach($json as $stat) {
            $m = $stat['message'];
            $c = $stat['code'];
            if ("$value" == $c) {
                $statuses .= "<option value='$c' selected>$m ($c)</option>";                
            } else {
                $statuses .= "<option value='$c'>$m ($c)</option>";
            }
            
        }

        $statuses .= "</select>";
        echo $statuses;
    }
    
    function assembleGenericBox($type, $value) {
        $string = file_get_contents(__DIR__ . "/" . $type . ".json");
        $json = json_decode($string, true);
        
        $statuses = "<select class='wew' id='" .  $type . "'><option value='-1' selected> -- Choose One -- </option>";
        
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

    function assembleRBox($value) {
        $type='resources';
        $string = file_get_contents(__DIR__ . "/" . $type . ".json");
        $json = json_decode($string, true);
        
        $statuses = "<select class='wew' id='type'><option value='-1' selected> -- Choose One -- </option>";
        
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

    if(isset($_POST['type'])) {
        switch($_POST['type']) {
            case 'service':
                assembleSerBox($_POST['value']);
                break;
            case 'priority':
                assemblePBox($_POST['value']);
                break;
        }
    }

?>