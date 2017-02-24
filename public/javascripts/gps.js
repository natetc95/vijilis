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
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    document.getElementById("locbox_x").value = latitude;
    document.getElementById("locbox_y").value = longitude;
  }

  function error() {
    return alert("Unable to retrieve your location");
  }
  navigator.geolocation.getCurrentPosition(success, error, options);
}