
/* checkin.js
* Handles all check in related requests for geolocation & AJAX
* Included Functions:
* - geoFindMe()
* 
* VIJILIS: Emergency Response System
*
* Senior Design Team 16040
* University of Arizona
* Nathaniel Christianson & Travis Roser
*/

function geoFindMe() {

  var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
  };

  if (!navigator.geolocation){
    document.getElementById("locbox_y").value = "Geolocation is not supported by your browser";
    return;
  }

  function success(position) {
    document.getElementById('latitude').innerHTML = '&nbsp' + position.coords.latitude;
    document.getElementById('longitude').innerHTML = '&nbsp' + position.coords.longitude;
    var json = '{"lat": ' + position.coords.latitude + ', "lon": ' + position.coords.longitude + ', "time": ' + Math.floor(Date.now() / 1000) + '}';
    $.ajax({
        url: 'controllers/checkin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'locate',
            json: json
        }, success: function(e) {
            alerter(e.code, 'Thank you!');
        }
    });
  }

  function error() {
    return alerter(e.code, 'SOON');
  }
  navigator.geolocation.getCurrentPosition(success, error, options);

}