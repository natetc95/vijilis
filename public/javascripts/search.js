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
function SelectAll()
{
    document.getElementById('searchinp').focus();
    document.getElementById('searchinp').select();
}

function openuser(uid) {
    createLoader();
    $.ajax({
        url: 'controllers/admin/users.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'pullUserData',
            uid: uid
        },
        success: function(e) {
            removeLoader();
            document.getElementById('name').innerHTML = e.code.name;
            document.getElementById('uid').innerHTML = e.code.uid;
            document.getElementById('email').innerHTML = e.code.email;
            document.getElementById('telnum').innerHTML = e.code.telnum;
            document.getElementById('zip').innerHTML = '85719';
        },
        failure: function(e) {
            removeLoader();
            console.log(e);
        }
    });
}

function searchVendor(e){
  var currUIDList = new Array();
  if (e.keyCode == 13) {
    var list = document.getElementById('searchinp').value.split(' ');
    if( list.length > 0 ){
      if( list[0] != '' ){
        document.getElementById('name').innerHTML = '';
        document.getElementById('uid').innerHTML = '';
        document.getElementById('email').innerHTML = '';
        document.getElementById('telnum').innerHTML = '';
        document.getElementById('zip').innerHTML = '';

        //remove current entries
        var parentElement = document.getElementsByClassName('code-select-box');
        while (parentElement[0].hasChildNodes()) {
            parentElement[0].removeChild(parentElement[0].lastChild);
        }

        //create new entries
        for(var i = 0; i < list.length; i++){
          if(i == 0){
            $.ajax({
              url: 'controllers/jobs/search.php',
              type: 'POST',
              dataType: 'json',
              data: {
                  action: 'pullVendorData',
                  str: list[i]
                },
                success: function(e) {
                  for(var j = 0; j < e.length; j++){
                    if(e[j].status == 'SUCC'){
                      var childElement = document.createElement('div');
                      var h1 = document.createElement('h1');
                      h1.innerHTML = e[j].fname + ' ' + e[j].lname;
                      childElement.setAttribute('class', 'code-select-entry');
                      h1.setAttribute('accessKey', e[j].uid);
                      currUIDList.push(e[j].uid);

                      childElement.addEventListener("click", function(event) {
                        openuser(event.srcElement.accessKey);
                        event.preventDefault();
                      });

                      childElement.appendChild(h1);
                      parentElement[0].appendChild(childElement);
                    }
                    else{
                      alerter('Please try a different entry', 'User not found')
                    }
                  }
                },
                error: function(xhr, error) {
                  console.log(error);
                }
            });
          }else{
            $.ajax({
              url: 'controllers/jobs/search.php',
              type: 'POST',
              dataType: 'json',
              data: {
                  action: 'pullVendorData',
                  str: list[i]
              },
              success: function(e) {

                var result = true;
                for(var j = 0; j < currUIDList.length; j++){
                  for(var k = 0; k < e.length; k++){
                    if(currUIDList[j] == e[k].uid){
                      result = false;
                    }
                  }
                }
                if(result == true){
                  for(var j = 0; j < e.length; j++){
                    if(e[j].status == 'SUCC'){
                      var childElement = document.createElement('div');
                      var h1 = document.createElement('h1');
                      h1.innerHTML = e[j].fname + ' ' + e[j].lname;
                      childElement.setAttribute('class', 'code-select-entry');
                      h1.setAttribute('accessKey', e[j].uid);
                      currUIDList.push(e[j].uid);

                      childElement.addEventListener("click", function(event) {
                        openuser(event.srcElement.accessKey);
                        event.preventDefault();
                      });

                      childElement.appendChild(h1);
                      parentElement[0].appendChild(childElement);
                    }
                    else{
                      alerter('Please try a different entry', 'User not found')
                    }
                  }
                }
              },
              error: function(xhr, error) {
                  console.log(error);
              }
            });
          }
        }

      }
      else{
        //refill with orginial list?
      }
    }
    return false;
  }
}
