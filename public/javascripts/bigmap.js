var infowindow = -1;

function initBig() {
    var x = parseFloat(document.getElementById("locbox_x").value);
    var y = parseFloat(document.getElementById("locbox_y").value);
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: x, lng: y},
        zoom: 13,
        mapTypeControl: false,
        streetViewControl: false
    });
    var marker = new google.maps.Marker({
          position: {lat: x, lng: y},
          map: map,
          draggable:true,
          icon: 'public/images/logo_icon_tr.png'
        });
}

function initMap() {
map = new google.maps.Map(document.getElementById('Bigmap'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 13,
    mapTypeControl: false,
    streetViewControl: false
});

var trafficLayer = new google.maps.TrafficLayer();

// Try HTML5 geolocation.
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
    function(position) {
        var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };
        map.setCenter(pos);
        trafficLayer.setMap(map);
        var marker1 = new google.maps.Marker({
            position: {lat: 32.25171658527061, lng: -111.04705810546875},
            map: map,
            draggable:true,
            icon: 'public/images/logo_icon_tr.png'
        });
        var marker2 = new google.maps.Marker({
            position: {lat: 32.22206813061224, lng: -110.94893992933044},
            map: map,
            draggable:true,
            icon: 'public/images/logo_icon_tr.png'
        });
        var marker3 = new google.maps.Marker({
            position: {lat: 32.258539603730426, lng: -110.88277816772461},
            map: map,
            draggable:true,
            icon: 'public/images/logo_icon_tr.png'
        });
        map.addListener('rightclick', function(event) {
            contentString = "<a href='javascript:makeReq(" + event.latLng.lat() + ", " + event.latLng.lng() + ")'>New Request</a>"
            if (infowindow != -1) {
                infowindow.close()
            }
            infowindow = new google.maps.InfoWindow({
                map: map
            });
            infowindow.setPosition(event.latLng);
            infowindow.setContent(contentString);
        });
        map.addListener('click', function(event) {
            if (infowindow != -1) {
                infowindow.close()
            }
        });
    }, 
    function() {
        handleLocationError(true, map.getCenter());
    });
} else {
    // Browser doesn't support Geolocation
    handleLocationError(false, map.getCenter());
}
}

function handleLocationError(browserHasGeolocation, pos) {
    if (browserHasGeolocation == false) {
        console.log("ERROR OCCURED!");
    }
}

function makeReq(x, y) {
    var req = $.ajax('controllers/vendor.php', {
        method: 'POST',
        dataType: 'html',
        data: {
            page: "im/requests/create_request",
            x: x,
            y: y
        }
    });
    req.done(function( msg ) {
        $("#content").html(msg);
    });
}