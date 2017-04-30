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
      type: list[0].querySelector('#service').value,
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
              type: list[i].querySelector('#service').value,
              desc: list[i].querySelector('#jobdesc').value,
              spec: list[i].querySelector('#jobspec').value,
              i: i
            }, success: function(be) {
              nums.push(be.code);
              if (parseInt(be.num) == list.length-1) {
                loadJob(nums[0]);
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
        loadJob(nums[0]);
        alerter('Job #' + e.code + ' has been created!', 'Jobs Created!');
      }
    }
  });
}

function loadJob(uid) {
    window.scrollTo(0, 0);
    currPage = ['job', uid];
    createLoader();
    var req = $.ajax({
        url: 'controllers/jobs/view_a_request.php',
        method: 'POST',
        dataType: 'html',
        data: {
            uid: uid
        },
       statusCode: {
           403: function() {
                window.location = "errors/403.php";
           },
           404: function() {
               window.location = "errors/404.php";
           },
           418: function() {
               window.location = "errors/418.php";
           }
        }
    });
    req.done(function( msg ) {
        $("#content").html(msg);
        removeLoader();
    });
}

function saveJob() {
    var uid = parseInt(document.getElementById('uid').value);
    console.log(uid);
    $.ajax({
        url: 'controllers/jobs/edit-create.php',
        method: 'post',
        dataType: 'json',
        data: {
            action: 'edit',
            uid: uid,
            status: document.getElementById('status').value,
            prio: document.getElementById('priority').value,
            service: document.getElementById('service').value,
            spec: document.getElementById('spec').value,
            desc: document.getElementById('desc').value,
            time: document.getElementById('time').value
        }, 
        success: function(e) {
            alerter(e.code, 'Response!');
            refresh('im');
        }
    })
}

function search() {
    document.getElementById('tableoo').innerHTML = '<center><i class="fa fa-cog fa-spin fa-4x fa-fw"></i><center>';
    $.ajax({
        url: 'controllers/jobs/job_search.php',
        method: 'post',
        dataType: 'json',
        data: {
            job: document.getElementById('jobnum').value,
            cc: document.getElementById('ctime').value,
            code: document.getElementById('service').value,
            status: document.getElementById('status').value,
            desc: document.getElementById('desc').value,
            user: document.getElementById('user').value,
            vendor: document.getElementById('vid').value,
            parent: document.getElementById('parent').value
        }, 
        success: function(e) {
            var newBox = null;
            var dt = null;
            document.getElementById('tableoo').innerHTML = `<tr>
                    <th style='overflow:hidden; white-space:nowrap'>Job #</th>
                    <th style='overflow:hidden; white-space:nowrap'>Status</th>
                    <th style='overflow:hidden; white-space:nowrap'>Description</th>
                    <th style='overflow:hidden; white-space:nowrap'>Assigned To</th>
                    <th style='overflow:hidden; white-space:nowrap'>Last Updated</th>
                </tr>`;
            for(var i = 0; i < e.arr.length; i++) {
                dt = new Date(e.arr[i][4] * 1000);
                newBox = document.createElement('tr');
                newBox.setAttribute('class', 'style-row-'+(i%2+1));
                newBox.setAttribute('onclick', 'loadJob(' + e.arr[i][0] + ')');
                newBox.innerHTML = `<td style='cursor:pointer'>` + e.arr[i][0] + `</td>
                    <td>` + e.arr[i][1] + `</td>
                    <td>` + e.arr[i][2] + `</td>
                    <td>` + e.arr[i][3] + `</td>
                    <td>` + dt.toLocaleString() + `</td>`;
                document.getElementById('tableoo').appendChild(newBox);
            }
        }
    })
}