function inputFocus(i){
    if(i.value == i.defaultValue){
      i.value = "";
      i.style.color = "#193864";
    }
}
function inputBlur(i){
    if(i.value == ""){
      i.value = i.defaultValue;
      i.style.color = "#888";
    }
}

function submitJob() {

    createLoader();
    var result = false;
    var baseElement = document.getElementById("sr");
    var list = [];

    for (var i = 1; i <= reqs; i++){

      console.log("i = "+i);
      console.log("reqs = "+reqs);
      $.ajax({
      url: 'controllers/jobs/edit-create.php',
      method: 'post',
      dataType: 'json',
      data: {
        action: 'create',
        location: JSON.parse('{"lat": ' + parseFloat(document.getElementById('locbox_x').value) + ', "lng": ' + parseFloat(document.getElementById('locbox_y').value) + "}"),
        type: baseElement.querySelector( "#subreq"+i ).querySelector( "#jobtype" ).value,
        desc: baseElement.querySelector( "#subreq"+i ).querySelector( "#jobdesc" ).value,
        spec: baseElement.querySelector( "#subreq"+i ).querySelector( "#jobspec" ).value,
        priority: baseElement.querySelector( "#subreq"+i ).querySelector( "#priorityinp" ).value,
        parent: i
        // type: document.getElementById("jobtype").value,
        // desc: document.getElementById("jobdesc").value,
        // spec: document.getElementById("jobspec").value,
        // parent: false
      },
      success: function(e){
        removeLoader();
        result = true;
        console.log("SUCC");
        console.log(e.code);
        list.push("SUCC");
      },
      failure: function(e){
        list.push("FAIL");
        console.log("FAIL");
      },
      // complete: function(e){
      //   console.log(e.code);
      // },
      error: function(xhr, error){
        console.debug(error);
        console.log("ERROR");
        alerter("ERROR", 'Error Handling');
      }
      });
      // }).done(function(e) {
      //   removeLoader();
      //   //window.location = "im/index.php";
      //   contentLoader('news', true, 'im');//maybe put out of this
      //   alerter('A new request has been created. #' + e.code, 'Request Tool');//make an array
      // });
  }
  // if( result == true ){
  //   //window.location = "index.php";
  //   contentLoader('index', true, 'i');
  //   if( reqs == 1 ){
  //   alerter( 'A new request has been created. #' + list );
  //   }
  //   else{
  //     alerter( 'New requests have been created: ' + list );
  //   }
  // }
  // else{
  //   contentLoader('news', true, 'im');
  //   alerter( 'An error occured and your request was not processed' );
  // }
}
