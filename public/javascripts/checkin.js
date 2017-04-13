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
            alert(e.code);
        }
    });
  }

  function error() {
    return alert("Unable to retrieve your location");
  }
  navigator.geolocation.getCurrentPosition(success, error, options);

}