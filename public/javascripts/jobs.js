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

function makeJob() {
  window.scrollTo(0, 0);
  var list = document.getElementsByClassName('subreq');
  var nums = [];
  loc = JSON.parse('{"lat": ' + document.getElementById('locbox_x').value + ', "lng": ' + document.getElementById('locbox_y').value + "}");
  $.ajax({
    url: 'controllers/jobs/edit-create.php',
    method: 'post',
    dataType: 'json',
    data: {
      action: 'create-parent',
      location: loc,
      type: list[0].querySelector('#jobtype').value,
      desc: list[0].querySelector('#jobdesc').value,
      spec: list[0].querySelector('#jobspec').value
    }, success: function(e) {
      nums.push(e.code);
      if (list.length > 1) {
        for (var i = 1; i < list.length; i++) {
          $.ajax({
            url: 'controllers/jobs/edit-create.php',
            method: 'post',
            dataType: 'json',
            data: {
              action: 'create',
              location: loc,
              parent: e.code,
              type: list[i].querySelector('#jobtype').value,
              desc: list[i].querySelector('#jobdesc').value,
              spec: list[i].querySelector('#jobspec').value,
              i: i
            }, success: function(be) {
              nums.push(be.code);
              if (parseInt(be.num) == list.length-1) {
                var o = 'Job #\'s <br/>' + nums[0];
                for (var j = 1; j < nums.length; j++) {
                  o += ', ' + nums[j];
                }
                o += '<br/>have been created!';
                alerter(o, 'Jobs Created!');
              } else {
                console.log(parseInt(be.num) + '/' + list.length);
              }
            }
          });
        }
      } else {
        alerter('Job #' + e.code + ' has been created!', 'Jobs Created!');
      }
    }
  });
}
