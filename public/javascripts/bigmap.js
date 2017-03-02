var map;
var infowindow = -1;
function initMap() {
map = new google.maps.Map(document.getElementById('Bigmap'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 13
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
            page: "incidentmanager/requests/create_request",
            x: x,
            y: y
        }
    });
    req.done(function( msg ) {
        $("#content").html(msg);
    });
}