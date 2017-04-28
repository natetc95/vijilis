<?php  

	header('content-type: text/xml');
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

	error_reporting(E_ALL);
	ini_set("display_errors","On");

	require('../controllers/configurator.php');
    require('../controllers/twilio/actions.php');

	$mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
	if(isset($_REQUEST['From'])) {
        $pkg = getRequestData($mysqli, $_REQUEST['From']);
    }

    echo ('<!--' . $pkg['status'] . '-->');

    if(isset($_REQUEST['Body']) && $pkg['status'] != 'FAIL') {
        switch(strtolower($_REQUEST['Body'])) {
            case 'accept':
                $response = "Hi " . $pkg['data']['name'] . ", Job # " . $pkg['data']['job#'] . " acknowledged. Please check in when you reach the site. Click this link for directions: https://" . $_SERVER['HTTP_HOST'] . "/direct.php?n=" . $pkg['data']['job#'];
                acceptCall($mysqli, $pkg['data']);
                break;
            case 'decline':
                $response = "Hi " . $pkg['data']['name'] . ", Request acknowledged. Your resource has been marked as inactive.";
                declineCall($mysqli, $pkg['data']);
                break;
            case 'more':
                $response = callInfo($mysqli, $pkg['data']);
                break;
            default:
                $response = 'Unknown Command!';
                break;
        }
    } else {
        $response = 'No jobs are currently available in your area!';
    }

?>
<Response>
	<Message><?php echo($response); ?></Message>
</Response>