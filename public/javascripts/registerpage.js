var numErrors = 0;

function handleError(code) {
  switch(code) {
    case "1":
      return "Could not authenticate user.<br/>Verify the user name and password, and try again.";
      break;
    default:
      return "Unknown Error Occurred. Please contact the webmaster."
      break;
  }
}

function handle(e, pw){
    if(e.keyCode === 13){
        e.preventDefault(); // Ensure it is only this code that rusn
    } else if(pw == 1) {
      passwordMatch();
    } else if(pw == 2) {
      document.getElementById("relevant").disabled = !(phoneNumber() && passwordMatch());
    } else if(pw == 3) {
      document.getElementById("relevant").disabled = !(passwordMatch() && phoneNumber());
    }
}

function passwordMatch() {
  var pw1 = document.getElementById("pw1").value;
  var pw2 = document.getElementById("pw2").value;
  if(pw1.localeCompare(pw2) == 0) {
    document.getElementById("relevant").style = "cursor: pointer; float: right; margin: 10px;";
    if(document.getElementById("pw-error")) {
      document.getElementById("pw-error").remove();
      numErrors--;
      document.getElementById("registerbox").style = "height: " + (465 + numErrors*32) + "px";
    }
    return true;
  } else {
    document.getElementById("relevant").style = "cursor: not-allowed; float: right; margin: 10px;";
    if(!document.getElementById("pw-error")) {
      var newDiv = document.createElement("div");
      newDiv.setAttribute("class", "reg-error pw-error");
      newDiv.setAttribute("id", "pw-error");
      newDiv.innerHTML = "Passwords do not match!"
      numErrors++;
      document.getElementById("registerbox").style = "height: " + (465 + numErrors*32) + "px";
      $(newDiv).insertAfter(document.getElementById("pw2"));
    }
    return false;
  }
}

function phoneNumber() {
  var tel = document.getElementById("tel").value;
  if(tel != "") {
    var REGEXPH = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    if(tel.match(REGEXPH)) {
      if(document.getElementById("tel-error")) {
      document.getElementById("tel-error").remove();
      numErrors-= 3;
      document.getElementById("registerbox").style = "height: " + (465 + numErrors*32) + "px";
    }
      return true;
    }
    else {
      document.getElementById("relevant").style = "cursor: not-allowed; float: right; margin: 10px;";
      if(!document.getElementById("tel-error")) {
        var newDiv = document.createElement("div");
        newDiv.setAttribute("class", "reg-error");
        newDiv.setAttribute("id", "tel-error");
        newDiv.innerHTML = "Invalid Phone Number!<br/>XXX-XXX-XXXX<br/>XXX.XXX.XXXX<br/>XXX XXX XXXX<br/>"
        numErrors+= 3;
        document.getElementById("registerbox").style = "height: " + (465 + numErrors*32) + "px";
        $(newDiv).insertAfter(document.getElementById("tel"));
      }
      return false;
    }
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
