<?php
    function getAt($file, $code) {
        $string = file_get_contents(__DIR__ . "/" . $file . ".json");
        $json = json_decode($string, true);
        foreach($json as $jpapa) {
            if($jpapa['code'] == $code) {
                return $jpapa['message'];
            }
        }
        return 'No Code Associated';
    }
    
    function getFromService($code) {
        $o = array('res' => '', 'pri' => '');
        $string = file_get_contents(__DIR__ . "/service.json");
        $json = json_decode($string, true);
        foreach($json as $jpapa) {
            if($jpapa['code'] == $code) {
                $o['res'] = $jpapa['resource'];
                $o['pri'] = $jpapa['priority'];
                break;
            }
        }
        echo(json_encode($o));
    }

    if(isset($_POST['action'])) {
        switch($_POST['action']) {
            case 'defaults':
                getFromService($_POST['code']);
                break;
        }
    }
?>