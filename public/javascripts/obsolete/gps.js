var map, marker;

function sCenter() {
  map.setCenter({
    lat: parseFloat(document.getElementById("locbox_x").value),
    lng: parseFloat(document.getElementById("locbox_y").value)
  })
}

function sMarker(e) {
  marker.setPostion = e;
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
    marker = new google.maps.Marker({
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
    initAutocomplete();
    geolocate();
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

var autocomplete;

function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('locinp')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
      }

function geocodeMe() {
  if(document.getElementById('locinp').value != "Enter Location Here") {
    document.getElementById('meslogo').setAttribute('class', 'fa fa-cog fa-spin');
    $.ajax({
      url: 'https://maps.googleapis.com/maps/api/geocode/json',
      method: 'get',
      dataType: 'json',
      data: {
        address: document.getElementById('locinp').value.replace(/\s/g, "+"),
        key: 'AIzaSyBkjnCKXG0rhi9sBnXIbFnQYDjcotUnwBw'
      }, success: function(e) {
        document.getElementById('locbox_x').value = e.results[0].geometry.location.lat;
        document.getElementById('locbox_y').value = e.results[0].geometry.location.lng;
        marker.setPosition(e.results[0].geometry.location);
        map.setCenter(e.results[0].geometry.location);
        document.getElementById('meslogo').setAttribute('class', 'fa fa-paper-plane-o');
      }
    });
  } else {
    document.getElementById('meslogo').setAttribute('class', 'fa fa-exclamation-circle ');
    setTimeout(function() {
      document.getElementById('meslogo').setAttribute('class', 'fa fa-paper-plane-o');
    }, 750);
  }
}

function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}