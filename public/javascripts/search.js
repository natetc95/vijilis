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

function searchVendor(e){
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

                  childElement.addEventListener("click", function(event) {
                    openuser(e[j].uid);
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
        }

      }
      else{
        //refill with orginial list?
      }
    }
    return false;
  }
}
