var map;

function sCenter() {
  map.setCenter({
    lat: parseFloat(document.getElementById("locbox_x").value),
    lng: parseFloat(document.getElementById("locbox_y").value)
  })
}

function initMap(lati, long) {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: lati, lng: long},
      zoom: 17,
      mapTypeControl: false,
      streetViewControl: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      styles: [
          { elementType: 'geometry', stylers: [{ color: '#242f3e' }] },
          { elementType: 'labels.text.stroke', stylers: [{ color: '#242f3e' }] },
          { elementType: 'labels.text.fill', stylers: [{ color: '#746855' }] },
          {
              featureType: 'poi',
              elementType: 'labels',
              stylers: [{ visibility: 'off' }]
          },
          {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{ color: '#38414e' }]
          },
          {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{ color: '#212a37' }]
          },
          {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#9ca5b3' }]
          },
          {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{ color: '#746855' }]
          },
          {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{ color: '#1f2835' }]
          },
          {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#f3d19c' }]
          },
          {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{ color: '#17263c' }]
          },
          {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#515c6d' }]
          },
          {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{ color: '#17263c' }]
          }
      ]
    });
    var marker = new google.maps.Marker({
          position: {lat: lati, lng: long},
          map: map,
          draggable:true,
          title:"Incident Location!",
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

  var output = {
    lat: 0,
    lon: 0
  };

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

function searchLocation(){

  // Create the search box and link it to the UI element.
  var searchString = document.getElementById('locinp').value;
  //var searchBox = new google.maps.places.SearchBox(searchString);
  // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  newToast('This button currently has no functionality');

  // // Bias the SearchBox results towards current map's viewport.
  // map.addListener('bounds_changed', function() {
  //   searchBox.setBounds(map.getBounds());
  // });
  // var markers = [];
  // searchBox.addListener('places_changed', function() {
  //       var places = searchBox.getPlaces();
  //
  //       if (places.length == 0) {
  //         return;
  //       }
  //
  //       // Clear out the old markers.
  //       markers.forEach(function(marker) {
  //         marker.setMap(null);
  //       });
  //       markers = [];
  //
  //       // For each place, get the icon, name and location.
  //       var bounds = new google.maps.LatLngBounds();
  //       places.forEach(function(place) {
  //         if (!place.geometry) {
  //           console.log("Returned place contains no geometry");
  //           return;
  //         }
  //         var icon = {
  //           url: place.icon,
  //           size: new google.maps.Size(71, 71),
  //           origin: new google.maps.Point(0, 0),
  //           anchor: new google.maps.Point(17, 34),
  //           scaledSize: new google.maps.Size(25, 25)
  //         };
  //
  //         // Create a marker for each place.
  //         markers.push(new google.maps.Marker({
  //           map: map,
  //           icon: icon,
  //           title: place.name,
  //           position: place.geometry.location
  //         }));
  //
  //         if (place.geometry.viewport) {
  //           // Only geocodes have viewport.
  //           bounds.union(place.geometry.viewport);
  //         } else {
  //           bounds.extend(place.geometry.location);
  //         }
  //       });
  //       map.fitBounds(bounds);
  //     });

}
