<?php
    require('PHPMailer/PHPMailerAutoload.php');
    require('configurator.php');

    function EVerify($email, $fname, $vhash) {
        $verify_lnk = $redirectUri = isset($_SERVER['HTTPS']) ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . $GLOBALS['ftr'] . "verify.php?lnk=" . $vhash;
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
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
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
        $o = array('status' => 'FAIL', 'code' => '');
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
                        <table>
                            <tr><td><b>Name</b></td><td>&nbsp;$rname</td></tr>
                            <tr><td><b>ID Number</b></td><td>&nbsp;$ruid</td></tr>
                            <tr><td><b>Type</b></td><td>&nbsp;$rtype</td></tr>
                            <tr><td><b>Description</b></td><td>&nbsp;$rdesc</td></tr>
                        </table>
                    </p>
                    Thanks,<br/><br/>
                    <strong>VIJILIS Team</strong><br/><br/>
                </div>
            </div>";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = $GLOBALS['emailToUse'];
        $mail->Password = $GLOBALS['emailPassword'];
        $mail->SetFrom($GLOBALS['emailToUse']);
        $mail->Subject = "Resource Registration Confirmation";
        $mail->Body = $msg;
        $mail->AddEmbeddedImage('public/images/logo_rn.png', 'logo_rn');
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            $o['code'] = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $o['code'] = 'Message was sent sucessfully!';
            $o['status'] = 'SUCC';
        }
        return(json_encode($o));
    }

    function adminCreatedEmail($email, $fname, $username, $password, $type) {
        $o = array('status' => 'FAIL', 'code' => '');
        $msg = "
            <div id='center'>
                <div id='header'>
                    <h1>You have been registered!</h1>
                </div>
                <div id='content'>
                    Hello $fname,<br/>
                    <p>
                        Welcome to the VIJILIS system. You have been registered as a(n) $type! Please log in to the system and then reset your password.
                        <br/><br/>
                        <table>
                            <tr><td><b>Username</b></td><td>&nbsp;$username</td></tr>
                            <tr><td><b>Password</b></td><td>&nbsp;$password</td></tr>
                        </table>
                    </p>
                    Thanks,<br/><br/>
                    <strong>VIJILIS Team</strong><br/><br/>
                </div>
            </div>";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = $GLOBALS['emailToUse'];
        $mail->Password = $GLOBALS['emailPassword'];
        $mail->SetFrom($GLOBALS['emailToUse'], 'VIJILIS Team');
        $mail->Subject = "VIJILIS Registration Alert";
        $mail->Body = $msg;
        $mail->AddEmbeddedImage('public/images/logo_rn.png', 'logo_rn');
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            $o['code'] = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $o['code'] = 'Message was sent sucessfully!';
            $o['status'] = 'SUCC';
        }
        return(json_encode($o));
    }

    function approvalEmail($email, $fname, $quest, $msg) {
        $o = array('status' => 'FAIL', 'code' => '');
        $msg = "
            <div id='center'>
                <div id='header'>
                    <h1>You have been $quest!</h1>
                </div>
                <div id='content'>
                    Hello $fname,<br/>
                    <p>
                        Your account has been $quest by an admin!
                        <br/><br/>
                        <b>Custom Message:</b><br/>
                        $msg
                    </p>
                    Thanks,<br/><br/>
                    <strong>VIJILIS Team</strong><br/><br/>
                </div>
            </div>";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = $GLOBALS['emailToUse'];
        $mail->Password = $GLOBALS['emailPassword'];
        $mail->SetFrom($GLOBALS['emailToUse'], 'VIJILIS Team');
        $mail->Subject = "VIJILIS Account Status Alert";
        $mail->Body = $msg;
        $mail->AddEmbeddedImage('public/images/logo_rn.png', 'logo_rn');
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            $o['code'] = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $o['code'] = 'Message was sent sucessfully!';
            $o['status'] = 'SUCC';
        }
        return(json_encode($o));
    }

    function resourceApprovalEmail($email, $fname, $quest, $msg) {
        $o = array('status' => 'FAIL', 'code' => '');
        $msg = "
            <div id='center'>
                <div id='header'>
                    <h1>Your resource has been $quest!</h1>
                </div>
                <div id='content'>
                    Hello $fname,<br/>
                    <p>
                        Your resource has has been $quest by an admin!
                        <br/><br/>
                        <b>Custom Message:</b><br/>
                        $msg
                    </p>
                    Thanks,<br/><br/>
                    <strong>VIJILIS Team</strong><br/><br/>
                </div>
            </div>";
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = $GLOBALS['emailToUse'];
        $mail->Password = $GLOBALS['emailPassword'];
        $mail->SetFrom($GLOBALS['emailToUse'], 'VIJILIS Team');
        $mail->Subject = "VIJILIS Resource Status Alert";
        $mail->Body = $msg;
        $mail->AddEmbeddedImage('public/images/logo_rn.png', 'logo_rn');
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            $o['code'] = "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $o['code'] = 'Message was sent sucessfully!';
            $o['status'] = 'SUCC';
        }
        return(json_encode($o));
    }
?>
