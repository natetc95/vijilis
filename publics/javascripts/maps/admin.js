var pointList = [];
var mapStuff = new google.maps.MVCArray();
var working = false;
var poly = null;

function adminPoints() {
    var e = document.getElementById('districttool');
    if(!working) {
        e.innerHTML = '<i class="fa fa-check fa-lg" style="margin-top: 5px;" aria-hidden="true"></i>';
        working = true;
        poly = new google.maps.Polygon({
          paths: pointList,
          strokeColor: '#FFFFFF',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FFFFFF',
          fillOpacity: 0.05,
          map: map
        });
        map.addListener('click', function(evento) {
            if(pointList.length < 7) {
                pointList.push(JSON.parse('{"lat": ' + evento.latLng.lat() + ', "lng": ' + evento.latLng.lng() + '}'));
                e.style = 'background: limegreen; right: 210px;';
                e.innerHTML = pointList.length;
                if(pointList.length < 7) {
                    setTimeout(function() {
                        e.style = 'background: white; right: 210px;';
                        e.innerHTML = '<i class="fa fa-check fa-lg" style="margin-top: 5px;" aria-hidden="true"></i>';
                    }, 300);   
                } else {
                    adminPoints();
                }
            }
            poly.setPaths(pointList);
        });
    } else {
        poly.setMap(null);
        google.maps.event.clearInstanceListeners(map, 'click');
        e.innerHTML = '<i class="fa fa-hand-lizard-o fa-lg" style="margin-top: 5px;" aria-hidden="true"></i>';
        e.style = 'background: white; right: 210px;';
        if(pointList.length < 3) {
            alerter('Too Few Points in Array to create a District!', 'District Tool');
        } else {
            var x = [];
            for (var i = 0; i < pointList.length; i ++) {
                x.push(JSON.stringify(pointList[i]));
            }
            alerter('Copy and paste this snippet into the import tool in the district area.<textarea style="margin-top: 5px;height: 250px">[' + x + ']</textarea>', 'District Tool');
        }
        working = false;
    }
    pointList = [];
}