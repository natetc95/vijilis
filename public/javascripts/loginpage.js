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


function submitLogin() {
  var un = document.getElementById("_uname");
  var pw = document.getElementById("_pwd");
  if(document.getElementById("errors")) {
    document.getElementById("loginbox").removeChild(document.getElementById("errors"));
  }
  $.ajax({
    url: 'controllers/login.php',
    type: 'POST',
    dataType: 'text',
    data: {
      'un': un.value,
      'pw': pw.value
    },
    success: function(success) {
      if(JSON.parse(success).loginstat == "FAIL") {
        $( "#loginbox" ).effect( "shake" );
        // var errors = document.createElement("div");
        // errors.id = "errors";
        // errors.innerHTML = handleError(JSON.parse(success).error);
        // document.getElementById("loginbox").insertBefore(errors, document.getElementById("la"));
      } else if (JSON.parse(success).loginstat == "SUCC") {
        window.location = "portal.php";
      }
    },
    error: function(failure) {
      $( "#loginbox" ).effect( "shake" );
      var errors = document.createElement("div");
      errors.id = "errors";
      errors.innerHTML = "Could not authenticate user.<br/>Unable to connect to authentication controller.";
      document.getElementById("loginbox").insertBefore(errors, document.getElementById("la"));
    }
  })
}

function handle(e){
    if(e.keyCode === 13){
        e.preventDefault(); // Ensure it is only this code that rusn
        submitLogin();
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
