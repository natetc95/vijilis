var map;

function initMap(lati, long) {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: lati, lng: long},
      zoom: 17
    }); 
    var marker = new google.maps.Marker({
          position: {lat: lati, lng: long},
          map: map,
          draggable:true,
          title:"Hello World!",
          icon: 'public/images/logo_icon_tr.png'
        });
    
    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);

    marker.addListener('mouseup', function() {
      document.getElementById("locbox_x").value = marker.getPosition().lat();
      document.getElementById("locbox_y").value = marker.getPosition().lng();
    });
  }

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
    initMap(latitude, longitude);
  }

  function error() {
    return alert("Unable to retrieve your location");
    initMap(0, 0);
  }
  navigator.geolocation.getCurrentPosition(success, error, options);
}

function initBigMap(lati, long) {
    var options = {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0
    };

    if (!navigator.geolocation){
      alert("Geolocation is not supported by your browser");
      return;
    }
    function success(position) {
      var lati  = position.coords.latitude;
      var long = position.coords.longitude;
      map = new google.maps.Map(document.getElementById('Bigmap'), {
        center: {lat: lati, lng: long},
        zoom: 17
      }); 
      
      var marker = new google.maps.Marker({
            position: {lat: lati, lng: long},
            map: map,
            draggable:true,
            title:"CENTER",
            icon: 'public/images/logo_icon_tr.png'
          });
      
      var trafficLayer = new google.maps.TrafficLayer();
      trafficLayer.setMap(map);
      alert("jsfhgkljasfhlkgjasfhlkgjasfkljghas");
    }

    function error() {
      return alert("Unable to retrieve your location");
    }
    navigator.geolocation.getCurrentPosition(success, error, options);
}