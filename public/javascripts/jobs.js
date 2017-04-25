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

    var baseElement = document.getElementById("sr");

    for (var i = 1; i <= reqs; i++){

      console.log("i = "+i);
      console.log( baseElement.querySelector( "#subreq"+i ).querySelector( "#jobtype" ).value );
      console.log( baseElement.querySelector( "#subreq"+i ).querySelector( "#jobdesc"  ).value );
      console.log( parseFloat(document.getElementById('locbox_x').value) );
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
          parent: i
        }
      }).done(function(e) {
        contentLoader('news', true, 'im');
        alerter('A new request has been created. #' + e.code, 'Request Tool');
      });
      console.log("done");
    }
}
