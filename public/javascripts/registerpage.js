var numErrors = 0;

function writeErrors(obj, id, parent, n=1, pxMod=32) {
  if (!obj.result) {
    var arr = document.getElementsByClassName("error");
    Array.prototype.forEach.call(arr, function(it) {
      if(it.id == id) {
            document.getElementById("xxx").removeChild(it);
            numErrors -= n;
            if(numErrors < 0) {numErrors = 0;}
      }
    });
    var error = document.createElement("div");
    error.setAttribute("class", "error");
    error.setAttribute("id", id)
    error.innerHTML = obj.error;
    insertAfter(document.getElementById(parent), error);
    numErrors += n;
  } else {
    var arr = document.getElementsByClassName("error");
    Array.prototype.forEach.call(arr, function(it) {
      if(it.id == id) {
            document.getElementById("xxx").removeChild(it);
            numErrors -= n;
            if(numErrors < 0) {numErrors = 0;}
      }
    });
  }
  document.getElementById("registerbox").style="height: " + (465 + numErrors*pxMod) + "px";
}

function insertAfter( referenceNode, newNode ) {
    referenceNode.parentNode.insertBefore( newNode, referenceNode.nextSibling );
}


function validatePasswords() {
  var pw1 = document.getElementById("pw1").value;
  var pw2 = document.getElementById("pw2").value;
  var obj = {};
  if(pw1.localeCompare(pw2) == 0) {
    obj.error = "";
    obj.result = true;
  } else {
    obj.error = "Passwords Do Not Match!";
    obj.result = false;
  }
  writeErrors(obj, "pwerror", "pw2");
  return obj;
}

function strengthTestPassword() {
  var anUpperCase = /[A-Z]/;
  var aLowerCase = /[a-z]/; 
  var aNumber = /[0-9]/;
  var aSpecial = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
  var obj = {};
  var obj2= {};
  obj.result = true;
  obj.error = "";
  var p = document.getElementById("pw1").value;
  if(p.length > 6) {
    var numUpper = 0;
    var numLower = 0;
    var numNums = 0;
    var numSpecials = 0;
    for(var i=0; i<p.length; i++){
        if(anUpperCase.test(p[i]))
            numUpper++;
        else if(aLowerCase.test(p[i]))
            numLower++;
        else if(aNumber.test(p[i]))
            numNums++;
        else if(aSpecial.test(p[i]))
            numSpecials++;
    }
    if(numUpper > 0) {
      obj.error += "<b>1 Upper Case Letter</b><br/>";
    } else {
      obj.error += "1 Upper Case Letter<br/>";
      obj.result = false;
    }
    if(numNums > 1) {
      obj.error += "<b>2 Numbers</b><br/>";
    } else {
      obj.error += "2 Numbers<br/>";
      obj.result = false;
    }
    if(numSpecials > 0) {
      obj.error += "<b>1 Special Character</b><br/>";
    } else {
      obj.error += "1 Special Character<br/>";
      obj.result = false;
    }
    obj2.error = obj.error;
    obj2.result = false;
    writeErrors(obj2, "pcerror", "pw1", 3, 28);
  } else {
    obj.error = "Password Too Short!"
    obj2.error = obj.error;
    obj2.result = false;
    writeErrors(obj2, "pcerror", "pw1", 1, 36);
  }
  return obj;
}

function validatePhoneNumber() {
  var tel = document.getElementById("tel").value;
  var obj = {};
  obj.error = "";
  obj.result = true;
  var REGEXPH = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(tel != "") {
    if(tel.match(REGEXPH)) {
      obj.error = "";
      obj.result = true;
    }
    else {
      obj.error = "Invalid Format<br/>(XXX-XXX-XXXX)";
      obj.result = false;
    }
  } else {
    obj.error = "Invalid Format<br/>(XXX-XXX-XXXX)";
    obj.result = false;
  }
  writeErrors(obj, "pherror", "tel", 2);
  return obj;
}

function validateEmail() {
  var email = document.getElementById("email").value;
  var obj = {};
  if(email.length > 0) {
    var REGEXEM = /^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$/;
    if(email.match(REGEXEM)) {
      var ajaxCall = $.ajax({
        url: 'controllers/validateEmail.php',
        type: 'POST',
        dataType: 'text',
        async: false,
        data: {
          email: email
        },
        success: function(success) {
          if (success == "TRUE") {
            obj.error = ""
            obj.result = true;
          } else {
            obj.error = "Email Already Exists";
            obj.result = false;
          }
        }
      });
    }
    else {
      obj.error = "Invalid Email";
      obj.result = false;
    }
  } else if(email.length == 0) {
    obj.error = "Email Is Too Short";
    obj.result = true;
  }
  else {
    obj.error = "Email Is Too Short";
    obj.result = true;
  }
  writeErrors(obj, "emerror", "email");
  return obj;
}

function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

function validateUsername() {
  var uname = document.getElementById("uname").value;
  var obj = {};
  if (uname.length > 4) {
    var ajaxCall = $.ajax({
        url: 'controllers/validateUsername.php',
        type: 'POST',
        dataType: 'text',
        async: false,
        data: {
          uname: uname
        },
        success: function(success) {
          if (success == "TRUE") {
            obj.error = ""
            obj.result = true;
          } else {
            obj.error = "Username Already Exists";
            obj.result = false;
          }
        }
      });
  }
  else {
    obj.error = "Username is Too Short";
    obj.result = false;
  }
  writeErrors(obj, "unerror", "uname");
  return obj;
}

function fullValidation() {
  return validateUsername().result && validateEmail().result && validatePhoneNumber().result && validatePasswords().result && strengthTestPassword().result;
}

function submitToRegistrar() {
  var uname = document.getElementById("uname").value;
  var pword = document.getElementById("pw2").value;
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var email = document.getElementById("email").value;
  var tel = document.getElementById("tel").value;
  if (fullValidation()) {
    $.ajax({
      url: 'controllers/registrar.php',
      type: 'POST',
      dataType: 'text',
      data: {
        uname: uname,
        pword: pword,
        fname: fname,
        lname: lname,
        email: email,
        telnum: tel
      },
      success: function(success) {
        window.location = "index.php";
      }
    });
  }
}

function Logout() {
  $.ajax({
    url: 'controllers/logout.php',
    type: 'POST',
    dataType: 'text',
    success: function(success) {
      console.log("Logged Out!");
      window.location = "index.php";
    }
  });
}
