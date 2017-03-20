<?php
    require('controllers/PHPMailer/PHPMailerAutoload.php');
    function EVerify($email, $fname, $vhash) {
        $emailToUse = "chimerasystemsaz@gmail.com";
        $emailPassword = "Robertanthony99"; 
        $verify_lnk = $redirectUri = isset($_SERVER['HTTPS']) ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/vijilis/vijilis/verify.php?lnk=" . $vhash;
        $msg = "
            <style>
                @import url('https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300');
                #center {
                    margin: 0 auto;
                    border: 1px solid #BDBDBD;
                    width: 520px;
                    text-align: center;
                }
                #content {
                    text-align:justify;
                    text-justify: inter-word;
                    width: 500px;
                    word-wrap: break-word;
                    font-family: 'Open Sans Condensed', sans-serif;
                    padding: 10px;
                    cursor: default;
                    color: #193864;
                }
                #center img {
                    margin: 0 auto;
                }
                #header {
                    width: 500px;
                    word-wrap: break-word;
                    font-family: 'Open Sans Condensed', sans-serif;
                    background: #BDBDBD;
                    padding: 10px;
                    color: #193864;
                }
                #header h1 {
                    margin: 0;
                }
            </style>
            <div id='center'>
                <div id='header'>
                    <h1>Thanks for Signing up!</h1>
                </div>
                <div id='content'>
                    Hello $fname,<br/>
                    <p>
                        Thanks for registering for VIJILIS! Theres just one more step before you can log in, and thats to verify! You will not be asked to log into your VIJILIS account -- We are simply verifying the ownership of this email address. Please verify your account by either clicking this link:<br/><br/>
                        <a href='$verify_lnk'>Click me</a><br/><br/>
                        or by entering this URL into your browser:<br/><br/>
                        <a href='$verify_lnk'>$verify_lnk</a><br/>
                    </p>
                    Thanks,<br/><br/>
                    <strong>VIJILIS Team</strong><br/><br/>
                    <img style='height: 50px; text-align-' src='cid:logo_rn'/>
                </div>
            </center>";
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = $emailToUse;
        $mail->Password = $emailPassword;
        $mail->SetFrom($emailToUse);
        $mail->Subject = "Please Verify Your VIJILIS Account";
        $mail->Body = $msg;
        $mail->AddEmbeddedImage('public/images/logo_rn.png', 'logo_rn');
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent";
        }
    }
    EVerify("natetc95@gmail.com", "Test", "test");
?>