<?php
    require('PHPMailer/PHPMailerAutoload.php');
    require('configurator.php');
    function EVerify($email, $fname, $vhash) {
        $verify_lnk = $redirectUri = isset($_SERVER['HTTPS']) ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . "/verify.php?lnk=" . $vhash;
        $msg = "
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
                        <a href='$verify_lnk'>$verify_lnk</a><br/><br/>
                    </p>
                    Thanks,<br/><br/>
                    <strong>VIJILIS Team</strong><br/><br/>
                    <img style='height: 50px; text-align-' src='cid:logo_rn'/>
                </div>
            </center>";
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = $GLOBALS['emailToUse'];
        $mail->Password = $GLOBALS['emailPassword'];
        $mail->SetFrom($GLOBALS['emailToUse']);
        $mail->Subject = "Please Verify Your VIJILIS Account";
        $mail->Body = $msg;
        $mail->AddEmbeddedImage('public/images/logo_rn.png', 'logo_rn');
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            /// echo "Message has been sent";
        }
    } 

    function AlertResource($email, $fname, $rname, $rtype, $rdesc, $ruid) {
        $msg = "
            <div id='center'>
                <div id='header'>
                    <h1>Your Resource Has Been Registered!</h1>
                </div>
                <div id='content'>
                    Hello $fname,<br/>
                    <p>
                        This email is just to confirm the registration of your resource! Be aware it may take up to 2 weeks before your resource is approved for use within the VIJILIS system.
                        <br/><br/>
                        $rname:$ruid<br/>
                        $rtype<br/>
                        $rdesc<br/><br/>
                    </p>
                    Thanks,<br/><br/>
                    <strong>VIJILIS Team</strong><br/><br/>
                    <img style='height: 50px; text-align-' src='cid:logo_rn'/>
                </div>
            </center>";
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = $GLOBALS['emailToUse'];
        $mail->Password = $GLOBALS['emailPassword'];
        $mail->SetFrom($GLOBALS['emailToUse']);
        $mail->Subject = "Resource Registration Confirmation";
        $mail->Body = $msg;
        $mail->AddEmbeddedImage('public/images/logo_rn.png', 'logo_rn');
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            // echo "Message has been sent";
        }
    }
?>