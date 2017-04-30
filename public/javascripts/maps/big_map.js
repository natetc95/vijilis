var x = false;
var map = null;
var poly2 = null;
var infowindow = null;

var markers = [];

var oldmarkers = [];
var oldy = null;
var truths = [];

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
    getAllData();
    geolocate();
}

function createMarker(jobNumber, position, desc, type) {
    if (type == 'inactive' || type == 'active' || type == 'engaged') {
        func = 'getResourceInformation()';
        name = 'Resource';
    } else {
        func = 'getJobInformation()';
        name = 'Job';
    }
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: name + ' #' + jobNumber,
        icon: 'public/images/mapicons/' + type + '.png'
    });
    marker.addListener('click', function(e) {
        if (marker.icon != 'public/images/mapicons/jobs.png') {
            func = 'getResourceInformation()';
            name = 'Resource';
        } else {
            func = 'getJobInformation()';
            name = 'Job';
        }
        var curr = document.getElementsByClassName('map-modal');
        var contentString = '<h3 style="margin: 0">' + name + ' #' + jobNumber + '</h3><b>' +
                            desc + '</b><br/>' +
                            '<a href="javascript:' + func + '">More Information</a>' +
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
        closeJobInformation();
        closeResourceInformation();
    });
    markers.push(marker);
}

function closeAllMarkers() {
    if (oldmarkers.length != 0) {
        for (var i = 0; i < oldmarkers.length; i++) {
            oldmarkers[i].setMap(null);
        }
    }
    if (oldy != null) {
        oldy.setMap(null);
    }
    oldmarkers = [];
}

function getJobInformation() {
    document.getElementById('biggysmalls').style = 'height: ' + ($(window).height() - 294) + 'px';
    var jn = document.getElementById('ss').value;
    document.getElementById('jn').innerHTML = jn;
    infowindow.close();
    document.getElementById('jobinfo').style.marginBottom = '0px';
    map.addListener('click', function(e) { closeInformation() });
}

function getDistrict() {
    $.ajax({
        url: 'controllers/maps/find.php',
        method: 'post',
        dataType: 'json',
        data: {
            action: 'district'
        }
    }).done(function(e) {
        var polygoon = e.data;
        for (var i = 0; i < e.data.length; i++) {
            polygoon[i].lat = parseFloat(e.data[i].lat);
            polygoon[i].lng = parseFloat(e.data[i].lng);
        }
        var color = e.color;
        poly2 = new google.maps.Polygon({
          paths: polygoon,
          strokeColor: color,
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: color,
          fillOpacity: 0.05,
          map: map
        });
        truths[4] = true;
        if( toomanytruths() ) {
            closeAllMarkers();
        }
    });
}

function closeJobInformation() {
    document.getElementById('biggysmalls').style = 'height: ' + ($(window).height() - 44) + 'px';
    document.getElementById('jobinfo').style.marginBottom = '';
    google.maps.event.clearListeners(map, 'click')
}

function getResourceInformation() {
    var jn = document.getElementById('ss').value;
    $.ajax({
        url: 'controllers/maps/getinfo.php',
        method: 'post',
        dataType: 'json',
        data: {
            action: 'resource',
            uid: jn
        }
    }).done(function(e) {
        document.getElementById('Rappr').innerHTML = (e.resource.approved ? '<i class="fa fa-check" style="color: green" aria-hidden="true"></i>' : '<i class="fa fa-times" style="color: red" aria-hidden="true"></i>');
        document.getElementById('Ract').innerHTML = (e.resource.active ? '<i class="fa fa-check" style="color: green" aria-hidden="true"></i>' : '<i class="fa fa-times" style="color: red" aria-hidden="true"></i>');
        document.getElementById('Rtitle').innerHTML = '<xmp>' + e.resource.title + '</xmp>';
        document.getElementById('Rtype').innerHTML = e.resource.type;
        document.getElementById('Rnum').innerHTML = e.resource.uid;
        document.getElementById('Rlat').innerHTML = e.resource.location.lat;
        document.getElementById('Rlng').innerHTML = e.resource.location.lon;
        document.getElementById('Rdesc').innerHTML = '<xmp>' + e.resource.description + '</xmp>';
        document.getElementById('Rname').innerHTML = '<xmp>' + e.vendor.name + '</xmp>';
        document.getElementById('Rvid').innerHTML = e.vendor.uid;
        document.getElementById('Rimg').innerHTML = '<img height="180px" style="float: left; margin-right: 10px;" src="userfiles/u' + e.vendor.uuid + '/v' + e.vendor.uid + '/r' + e.resource.uid + '/img2.png"/>';
        document.getElementById('biggysmalls').style = 'height: ' + ($(window).height() - 294) + 'px';
        infowindow.close();
        document.getElementById('resinfo').style.marginBottom = '0px';
        map.addListener('click', function(e) { closeResourceInformation() });
    });
}

function closeResourceInformation() {
    document.getElementById('biggysmalls').style = 'height: ' + ($(window).height() - 44) + 'px';
    document.getElementById('resinfo').style.marginBottom = '';
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
        for(var i = 0; i < e.arr.length; i++) {
            pos = JSON.parse('{"lat": ' + e.arr[i].lat + ', "lng": ' + e.arr[i].lng + "}");
            createMarker(e.arr[i].uid, pos, e.arr[i].type, type);
        }
        truths[parseInt(e.type)] = true; 
        if( toomanytruths() ) {
            closeAllMarkers();
        }
    });
}

function toomanytruths() {
    return truths[0] & truths[1] & truths[2] & truths[3] & truths[4];
}

function getAllData() {
    createLoader();
    oldmarkers = markers.slice();
    oldy = poly2;
    var j = document.getElementById("fJobs").checked;
    var i = document.getElementById("fInactive").checked;
    var e = document.getElementById("fEngaged").checked;
    var a = document.getElementById("fActive").checked;
    var d = document.getElementById("fDistrict").checked;
    truths = [!j, !i, !e, !a, !d];
    if(j) {
        getDBData('jobs');
    }
    if(i) {
        getDBData('inactive');
    }
    if(e) {
        getDBData('engaged');
    }
    if(a) {
        getDBData('active');
    }
    if(d) {
        getDistrict();
    }
    removeLoader();
}

function geolocate() {

  var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
  };

  if (!navigator.geolocation){
    newToast("Geolocation is not supported by your browser");
  }

  function success(position) {
    map.setCenter(JSON.parse('{"lat": ' + position.coords.latitude + ', "lng": ' + position.coords.longitude + "}"));
    newToast("Map Centered on User!");
  }

  function error() {
    return newToast("Unable to retrieve your location");
  }
  navigator.geolocation.getCurrentPosition(success, error, options);
}

init();
