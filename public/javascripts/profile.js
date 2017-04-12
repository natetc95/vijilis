    
/* profile.js
 * Handles all client side profile functionalities & AJAX requests
 * Included Functions:
 * - confirmation(message, header, cb)
 * - alerter(message, header)
 * - editProfile()
 * 
 * VIJILIS: Emergency Response System
 *
 * Senior Design Team 16040
 * University of Arizona
 * Nathaniel Christianson & Travis Roser
 */

function confirmation(message, header, cb) {

    message = message.replace(/(?:\r\n|\r|\n)/g, '<br/>');
    var output = false;

    $('body').css({'overflow':'hidden'});
    $(document).bind('scroll',function () { 
        window.scrollTo(0,document.body.scrollTop); 
    });
    var hgt = $(window).height();
    var bg = document.createElement("div");
    var prompt = document.createElement("div");
    bg.setAttribute("id", "promptBackground");
    bg.setAttribute("style", "top: " + document.body.scrollTop + "px;");
    bg.addEventListener("click", function(e) {
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll'); 
        $('body').css({'overflow':'visible'});
    });
    prompt.setAttribute("id", "promptDelete");
    prompt.setAttribute("style", "top: " + (document.body.scrollTop + hgt/3) + "px;");
    prompt.innerHTML = `<div id='promptTitle'><h1>Confirm ` + header + `</h1></div>
                        <p style="min-height: 66px; overflow: hidden;">` + message + `</p>
                        <div class="promptoptions">
                            <div class="promptAccept" id="pAid" title="Edit"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Ok</div>
                            <div class="promptDecline" id="pDid" title="Edit"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</div>
                        </div>`;
    document.body.appendChild(prompt);
    document.body.appendChild(bg);
    document.getElementById("pDid").addEventListener("click", function(e) {
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll'); 
        $('body').css({'overflow':'visible'});
    });
    document.getElementById("pAid").addEventListener("click", function(e) {

        cb();

        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll'); 
        $('body').css({'overflow':'visible'});
    });
}

function alerter(message, header) {

    message = message.replace(/(?:\r\n|\r|\n)/g, '<br/>');
    var output = false;

    $('body').css({'overflow':'hidden'});
    $(document).bind('scroll',function () { 
        window.scrollTo(0,document.body.scrollTop); 
    });
    var hgt = $(window).height();
    var bg = document.createElement("div");
    var prompt = document.createElement("div");
    bg.setAttribute("id", "promptBackground");
    bg.setAttribute("style", "top: " + document.body.scrollTop + "px;");
    bg.addEventListener("click", function(e) {
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll'); 
        $('body').css({'overflow':'visible'});
    });
    prompt.setAttribute("id", "promptDelete");
    prompt.setAttribute("style", "top: " + (document.body.scrollTop + hgt/3) + "px;");
    prompt.innerHTML = `<div id='promptTitle'><h1>` + header + `</h1></div>
                        <div style="min-height: 77px; overflow: hidden; display: table; margin: 0 auto;"><div style="vertical-align: middle; display: table-cell;">` + message + `</div></div>
                        <div class="promptoptions">
                            <center><div class="promptAck" id="pAid" title="Edit"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Ok</div></center>
                        </div>`;
    document.body.appendChild(prompt);
    document.body.appendChild(bg);
    document.getElementById("pAid").addEventListener("click", function() {
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll'); 
        $('body').css({'overflow':'visible'});
    });
}

function editProfile() {
    var A = validateEmail();
    var B = validatePhone();
    if( A && B ) {
        createLoader();
        $.ajax({
            url: 'controllers/profile.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'edit',
                fn: document.getElementById('fname').value,
                ln: document.getElementById('lname').value,
                em: document.getElementById('email').value,
                tn: document.getElementById('telnu').value
            },
            success: function(e) {
                if (e.status == "SUCC") {
                    removeLoader();
                    contentLoader('profile/my_profile', false);
                    if (e.code.localeCompare('No changes detected!') != 0) {
                        alerter(e.code, 'Profile Updated!');
                    }
                } else {
                    alerter(e.code, 'Error Occured!');
                    removeLoader();
                }
            },
            failure: function() {
                removeLoader();
            }
        });
    } else {
        $('#head').effect( "shake" );
        $('#foot').effect( "shake" );
    }
}

function validateEmail() {
    var email = document.getElementById("email").value;
    var output = false;
    if(email.length > 0) {
        var REGEXEM = /^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$/;
        if(email.match(REGEXEM)) {
            var req = $.ajax({
                url: 'controllers/profile.php',
                type: 'POST',
                dataType: 'json',
                async: false,
                data: {
                    action: 'confirmEmail',
                    email: email
                }, 
                success: function(e) {
                    if (e.status == "FAIL") {
                        document.getElementById('emV').innerHTML = 'eMail (Already Taken): ';
                    } else {
                        document.getElementById('emV').innerHTML = 'eMail: ';
                        output = true;
                    }
                },
                failure: function() {
                    console.log('Failed to connect!');
                }
            });
            return output;
        } else {
            document.getElementById('emV').innerHTML = 'eMail (Currently RegEx Invalid): ';
            return false;
        }
    }
}

function validatePhone() {
    var tel = document.getElementById("telnu").value;
    var REGEXPH = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    if(tel != "") {
        if(tel.match(REGEXPH)) {
            document.getElementById('tuV').innerHTML = 'Telephone Number: ';
            return true;
        }
    } else {
        document.getElementById('tuV').innerHTML = 'Telephone Number (Currently Invalid): ';
        return false;
    }
    document.getElementById('tuV').innerHTML = 'Telephone Number (Currently Invalid): ';
    return false;
}

function addAllEvents() {
    
}