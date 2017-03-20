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
  var newPW = pw.value;
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
      console.log(success);
      if(JSON.parse(success).loginstat == "FAIL") {
        $( "#loginbox" ).effect( "shake" );
      } else if (JSON.parse(success).loginstat == "SUCC") {
        window.location = "portal.php";
      }
    },
    error: function(failure) {
      $( "#loginbox" ).effect( "shake" );
      console.log(failure);
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
