<?php
    if(isset($_GET['lnk'])) {
        $l = $_GET['lnk'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type='text/css' href='public/stylesheets/styles.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="public/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/public/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/public/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/public/images/favicons/manifest.json">
    <link rel="mask-icon" href="/public/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/public/images/favicons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="VIJILIS Responder">
    <meta name="application-name" content="VIJILIS Responder">
    <meta name="msapplication-config" content="/public/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="public/javascripts/loginpage.js"></script>
    <title>NFC Check In</title>

    <style>
        #ios input[type='password'] {
            width: 24px;
            height: 24px;
            text-align: center;
        }
    </style>
    <script src='public/javascripts/checkinfob.js'></script>


</head>
<body>      
	<div class="headerbar">
		<a href="index.php"><img src="public/images/logo_rn.png" height="24px" style="float: right; margin-right: 30px"></a>
    </div>
    <div id="loginbox"></br>
        <h1>Enter Pin</h1>
        <center><br/><br/>
            <div id="ios">
                <input type="hidden" id='geo_lat'/>
                <input type="hidden" id='geo_lng'/>
                <input type="hidden" id='hash' value="<?=$l?>"/>
                <input type="password" id='q' maxlength="1" onkeyup='move(this, "a")' />
                <input type="password" id='a' maxlength="1" onkeyup='move(this, "b")'/>
                <input type="password" id='b' maxlength="1" onkeyup='move(this, "c")'/>
                <input type="password" id='c' maxlength="1" onkeyup='move(this, "d")'/>
                <br/><br/><button id='d' onclick='checkin()'>Submit</button>
            </div> 
        </center>
    </div>

</body>
</html>

<?php 
    } else {
        header('location: index.php');
        die();
    }
?>