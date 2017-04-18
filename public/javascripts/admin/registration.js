var numCoords = 3;
var maxCoords = 7;

function generatePassword(length=12) {
    var charlist = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890!@#$%^&*()-+<>";
    var password = "";
    for (var i = 0; i < length; i++) {
        var x = Math.floor(Math.random() * charlist.length);
        password += charlist.charAt(x);
    }
    document.getElementById('gpass').value = password;
}

function generateUsername(length=10) {
    var f = document.getElementById('fname').value.toLowerCase();
    var l = document.getElementById('lname').value.toLowerCase();
    if (f.length > 0 && l.length > 0) {
        var o = f[0];
        for(var i = 0; i < Math.min(length-1, l.length); i++) {
            o += l[i];
        }
        document.getElementById('guser').value = o;
    } else {
        alerter("Please enter a first name and last name of the user before generating a username!", "Error Occured!");
    }

}

function newNode() {
    if (numCoords < maxCoords) {
        numCoords++;
        var newDiv = document.createElement('div');
        newDiv.setAttribute('class', 'coords');
        newDiv.innerHTML = `<b>Location ` + numCoords + `: </b><br/>
                    <center><table>
                        <tr>
                            <td><input id="lat" class="resourceInputBox half" type="text"></input></td>
                            <td><input id="lng" class="resourceInputBox half" type="text"></input></td>
                        </tr>
                    </table></center>`;
        document.getElementById('bounding-box').appendChild(newDiv);
    } else {
        alerter('Maximum Limit of 7 coordinates reached! Could not add a new node!', 'Max Reached!');
    }
}

function delNode() {
    if (numCoords > 3) {
        numCoords--;
        var divArray = document.getElementsByClassName('coords');
        document.getElementById('bounding-box').removeChild(divArray[divArray.length-1]);
    } else {
        alerter('Minimum limit of 3 coordinates reached! Could not remove a node!', 'Min Reached!');
    }
}

function validateEmail() {
    var email = document.getElementById("email").value;
    var output = false;
    if(email.length > 0) {
        var REGEXEM = /^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$/;
        if(email.match(REGEXEM)) {
            var req = $.ajax({
                url: 'controllers/admin/validation.php',
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
    return output;
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

function createVendor() {
    if(validateEmail() && validatePhone()) {
        createLoader();
        $.ajax({
            url: 'controllers/admin/creation.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'createVendor',
                fname: document.getElementById('fname').value,
                lname: document.getElementById('lname').value,
                email: document.getElementById('email').value,
                telnum: document.getElementById('telnu').value,
                uname: document.getElementById('guser').value,
                pword: document.getElementById('gpass').value
            },
            success: function(e) {
                removeLoader();
                contentLoader('news', false, 'a');
                alerter('User #' + e.code + ' has been created!', 'User Created!');
            },
            failure: function(e) {
                removeLoader();
                console.log(e);
            }
        });
    } else {
        alerter("One or more entries in the form are invalid! Please check your values!", "Invalid Entries!");
    }
}

function createIncidentManager() {
    if(validateEmail() && validatePhone()) {
        createLoader();
        $.ajax({
            url: 'controllers/admin/creation.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'createIncidentManager',
                fname: document.getElementById('fname').value,
                lname: document.getElementById('lname').value,
                email: document.getElementById('email').value,
                telnum: document.getElementById('telnu').value,
                uname: document.getElementById('guser').value,
                pword: document.getElementById('gpass').value
            },
            success: function(e) {
                removeLoader();
                contentLoader('news', false, 'a');
                alerter('User #' + e.code + ' has been created!', 'User Created!');
            },
            failure: function(e) {
                removeLoader();
                console.log(e);
            }
        });
    } else {
        alerter("One or more entries in the form are invalid! Please check your values!", "Invalid Entries!");
    }
}

function createDistrict() {
        createLoader();
        var bounds = document.getElementsByClassName('coords');
        var arr = [];
        var x,y = 0;
        for(var i = 0; i < bounds.length; i++) {
            x = parseFloat(bounds[i].querySelector('#lat').value);
            y = parseFloat(bounds[i].querySelector('#lng').value);
            arr.push(JSON.parse('{"lat": ' + x + ', "lng": ' + y + "}"));
        }
        $.ajax({
        url: 'controllers/admin/creation.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'createDistrict',
            data: arr,
            cname: document.getElementById('fname').value,
            email: document.getElementById('email').value,
            telnum: document.getElementById('telnu').value,
            dname: document.getElementById('dname').value,
            color: document.getElementById('color').value,
        },
        success: function(e) {
            removeLoader();
            console.log(e);
        },
        failure: function(e) {
            removeLoader();
            console.log(e);
        }
    });
}

function popModal() {

}