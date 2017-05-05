    
/* profile.js
 * Handles all client side profile functionalities & AJAX requests
 * Included Functions:
 * - confirmation(message, header, cb)
 * - alerter(message, header)
 * - editProfile()
 * - validateEmail()
 * - validatePhone()
 * - addAllEvents()
 * 
 * VIJILIS: Emergency Response System
 *
 * Senior Design Team 16040
 * University of Arizona
 * Nathaniel Christianson & Travis Roser
 */

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
                    addProfileImage();
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

function addProfileImage() {
    if($('#img2')[0].files[0] != undefined && $('#img2')[0].files[0].size <= 2097152) {
        var formData = new FormData();
        formData.append('file', $('#img2')[0].files[0]);
        formData.append('action', 'img');
        $.ajax({
            url : 'controllers/profile.php',
            type : 'POST',
            data : formData,
            processData: false,
            contentType: false,
            success : function(data) {
                console.log(data);
            }
        });
    } else {
        console.log('No Image Added!')
    }
}


function addAllEvents() {
    if(document.getElementById('head') != undefined) {
        document.getElementById('save').addEventListener('click', function() {
            confirmation('You acknowledge that your profile could be <b>suspended</b> temporarily based on submitted information.', 'Edit', editProfile);
        });
        document.getElementById('save2').addEventListener('click', function() {
            confirmation('You acknowledge that your profile could be <b>suspended</b> temporarily based on submitted information.', 'Edit', editProfile);
        });
        document.getElementById('cancel').addEventListener('click', function() {
            contentLoader('profile/my_profile', false);
        });
        document.getElementById('cancel2').addEventListener('click', function() {
            contentLoader('profile/my_profile', false);
        });
    }
}

addAllEvents();