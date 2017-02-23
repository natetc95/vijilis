function geoFindMe() {
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
    output.innerHTML = "Unable to retrieve your location";
  }
  navigator.geolocation.getCurrentPosition(success, error);
}