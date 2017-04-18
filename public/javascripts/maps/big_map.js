var x = false;
var map = null;
var infowindow = null;

var markers = [];

function initMap() {
    // Styles a map in night mode.
    document.getElementById('biggysmalls').style = 'height: ' + ($(window).height() - 44) + 'px';
    map = new google.maps.Map(document.getElementById('biggysmalls'), {
        center: {lat: 33.348884792201694, lng: -111.99394226074219},
        //{ lat: 40.674, lng: -73.945 },
        zoom: 12,
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

}

function init() {
    initMap();
    var mapPolygon = [
        {lat: 33.28806392819752, lng: -112.11856842041016},
        {lat: 33.28490697068781, lng: -111.99256896972656},
        {lat: 33.348884792201694, lng: -111.99394226074219}
    ];
    var bermudaTriangle = new google.maps.Polygon({
          paths: mapPolygon,
          strokeColor: '#FFFFFF',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FFFFFF',
          fillOpacity: 0.05,
          map: map
        });
    getAllData()
}

function createMarker(jobNumber, position) {
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: 'Job # ' + jobNumber,
        icon: 'public/images/logo_icon_tr_2.png'
    });
    marker.addListener('click', function(e) {
        var curr = document.getElementsByClassName('map-modal');
        var contentString = '<h3 style="margin: 0">Job #' + jobNumber + '</h3>' +
                            '<a href="javascript:getInformation()">More Information</a>' + 
                            '<input id="ss" type="hidden" value="' + jobNumber + '"/>';
        if (infowindow == null) {
            infowindow = new google.maps.InfoWindow({
                content: contentString,
                position: {lat: e.latLng.lat(), lng: e.latLng.lng()},
                map: map
            });
        } else {
            infowindow.close();
            infowindow = new google.maps.InfoWindow({
                content: contentString,
                position: {lat: e.latLng.lat(), lng: e.latLng.lng()},
                map: map
            });
        }
        closeInformation();
    });
    markers.push(marker);
}

function closeAllMarkers() {
    if (markers.length != 0) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
    }
}

function getInformation() {
    document.getElementById('biggysmalls').style = 'height: ' + ($(window).height() - 294) + 'px';
    var jn = document.getElementById('ss').value;
    document.getElementById('jn').innerHTML = jn;
    infowindow.close();
    document.getElementById('jobinfo').style.marginBottom = '0px';
    map.addListener('click', function(e) { closeInformation() });
}

function closeInformation() {
    document.getElementById('biggysmalls').style = 'height: ' + ($(window).height() - 44) + 'px';
    document.getElementById('jobinfo').style.marginBottom = '';
    google.maps.event.clearListeners(map, 'click')
}

function toggleFilters() {
    if (document.getElementById('filter-box').getAttribute('class') == 'open') {
        document.getElementById('filter-box').setAttribute('class', '');
    }  else {
        document.getElementById('filter-box').setAttribute('class', 'open');
    }
}

function getDBData(type) {
    $.ajax({
        url: 'controllers/maps/find.php',
        method: 'post',
        dataType: 'json',
        data: {
            action: type
        }
    }).done(function(e) {
        var pos = '';
        for(var i = 0; i < e.length; i++) {
            pos = JSON.parse('{"lat": ' + e[i].lat + ', "lng": ' + e[i].lng + "}");
            createMarker(e[i].uid, pos);
        } 
    });
}

function getAllData() {
    createLoader();
    closeAllMarkers();
    if(document.getElementById("fJobs").checked) {
        getDBData('jobs');
    }
    if(document.getElementById("fInactive").checked) {
        getDBData('inactive');
    }
    if(document.getElementById("fActive").checked) {
        getDBData('active');
    }
    removeLoader();
}

init();