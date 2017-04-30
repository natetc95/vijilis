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
        <title>Direct</title>
        </head>
    <body>
        <?php
            if(isset($_GET['n'])) {
                require('controllers/configurator.php');
                $mysqli = new mysqli($DB_HOST, $DB_UNME, $DB_PWRD, $DB_NAME);
                if($query = $mysqli->prepare('SELECT locationCoords FROM requests WHERE uid = ?')) {
                    $query->bind_param('i', $_GET['n']);
                    $query->execute();
                    $query->bind_result($desc);
                    $query->fetch();
                    if(isset($desc)) {
                        $query->fetch();
                        $json = json_decode($desc, true);
                        $link = 'https://maps.google.com?saddr=Current+Location&daddr=' . $json['lat'] . ',' . $json['lng'];
                        header('location: ' . $link);
                        die();
                    } else {
                        header('location: index.php');
                        die();
                    }
                }
            } else {  
                header('location: index.php');
                die();
            }
        ?>
    </body>
</html>