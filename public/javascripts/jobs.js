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

function removeLinkedJob(){
    newToast('This button currently has no functionality');
}

function submitJob() {

    createLoader();
    var result = false;
    var baseElement = document.getElementById("sr");
    var list = [];

    for (var i = 1; i <= reqs; i++){

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
        // priority: baseElement.querySelector( "#subreq"+i ).querySelector( "#priorityinp" ).value
      },
      success: function(e){
        result = true;
        console.log("SUCC");
        list.push(e.code);
        $.ajax({
        url: 'controllers/jobs/updateParentID.php',
        method: 'post',
        dataType: 'json',
        data: {
          action: 'update',
          uid: e.code,
          parent: list[0]
        },
        success: function(e){
          removeLoader();
          console.log("SUCC2");
          console.log(e.status);
          contentLoader('news', true, 'im');
          if( list.length == reqs ){
            alerter('You have created the following linked job(s): '+list, 'New Job(s)');
          }
        },
        failure: function(e){
          removeLoader();
          console.log("FAIL2");
        },
        error: function(xhr, error){
          removeLoader();
          console.debug(error);
          console.log("ERROR2");
        }
        });
      },
      failure: function(e){
        console.log("FAIL");
      },
      error: function(xhr, error){
        console.debug(error);
        console.log("ERROR");
      }
      });
    }

}
