<?php
    require('PHPMailer/PHPMailerAutoload.php');
    require('configurator.php');

    function EReset($email, $fname, $fhash) {
        $reset_lnk = $redirectUri = isset($_SERVER['HTTPS']) ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . $GLOBALS['ftr'] . "reset.php?lnk=" . $fhash;
        $msg = "
            <div id='center'>
                <div id='content'>
                    Hello $fname,<br/>
                    <p>
                        A request to reset your VIJILIS account password has been made. If this request was not made by you, please ignore this email. If this was made by you, please click on the following link to reset your password:<br/><br/>
                        <a href='$reset_lnk'>Click me</a><br/><br/>
                        or by entering this URL into your browser:<br/><br/>
                        <a href='$reset_lnk'>$reset_lnk</a><br/><br/>
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
        $mail->Subject = "Password Reset Request";
        $mail->Body = $msg;
        $mail->AddEmbeddedImage('public/images/logo_rn.png', 'logo_rn');
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            /// echo "Message has been sent";
        }
    }

    // function AlertResource($email, $fname, $rname, $rtype, $rdesc, $ruid) {
    //     $msg = "
    //         <div id='center'>
    //             <div id='header'>
    //                 <h1>Your Resource Has Been Registered!</h1>
    //             </div>
    //             <div id='content'>
    //                 Hello $fname,<br/>
    //                 <p>
    //                     This email is just to confirm the registration of your resource! Be aware it may take up to 2 weeks before your resource is approved for use within the VIJILIS system.
    //                     <br/><br/>
    //                     <table>
    //                         <tr><td><b>Name</b></td><td>&nbsp;$rname</td></tr>
    //                         <tr><td><b>ID Number</b></td><td>&nbsp;$ruid</td></tr>
    //                         <tr><td><b>Type</b></td><td>&nbsp;$rtype</td></tr>
    //                         <tr><td><b>Description</b></td><td>&nbsp;$rdesc</td></tr>
    //                     </table>
    //                 </p>
    //                 Thanks,<br/><br/>
    //                 <strong>VIJILIS Team</strong><br/><br/>
    //             </div>
    //         </div>";
    //     $mail = new PHPMailer(); // create a new object
    //     $mail->IsSMTP(); // enable SMTP
    //     $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    //     $mail->SMTPAuth = true; // authentication enabled
    //     $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    //     $mail->Host = "smtp.gmail.com";
    //     $mail->Port = 465; // or 587
    //     $mail->IsHTML(true);
    //     $mail->Username = $GLOBALS['emailToUse'];
    //     $mail->Password = $GLOBALS['emailPassword'];
    //     $mail->SetFrom($GLOBALS['emailToUse']);
    //     $mail->Subject = "Resource Registration Confirmation";
    //     $mail->Body = $msg;
    //     $mail->AddEmbeddedImage('public/images/logo_rn.png', 'logo_rn');
    //     $mail->AddAddress($email);
    //     if(!$mail->Send()) {
    //         echo "Mailer Error: " . $mail->ErrorInfo;
    //     } else {
    //         // echo "Message has been sent";
    //     }
    // }
?>
