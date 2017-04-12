    
/* profile.js
 * Handles all client side profile functionalities & AJAX requests
 * Included Functions:
 * - confirmation(message, header, cb)
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
                        <p style="height: 66px; overflow: hidden;">` + message + `</p>
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

function editProfile() {
    createLoader();
    $.ajax({
        url: 'controllers/profile.php',
        type: 'POST',
        dataType: 'text',
        data: {
            action: 'edit',
            fn: document.getElementById('fname').value,
            ln: document.getElementById('lname').value,
            em: document.getElementById('email').value,
            tn: document.getElementById('telnu').value
        },
        success: function(e) {
            if (e == "SUCC") {
                removeLoader();
                contentLoader('profile/my_profile', false);
            } else {
                console.log("FAILURE: " + e);
                removeLoader();
            }
        }
    });
}