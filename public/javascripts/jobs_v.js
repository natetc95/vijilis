function openBoxMenu(uid) {
    closeBoxMenu();
    var e = document.getElementById('j' + uid);
    if(e.innerHTML != '<i class="fa fa-times" aria-hidden="true"></i>') {
        var list = document.getElementsByClassName('resourceMenu');
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = '<i class="fa fa-bars" aria-hidden="true"></i>';
        }
        e.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        var menu = document.createElement('div');
        menu.setAttribute('id', 'jobMenu');
        menu.innerHTML = '<ul>' +
                            '<li onClick="uhoh(' + uid + ')"><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;&nbsp;Uh-Oh!</li>' +
                            '<li onClick="getDirections(' + uid + ')" id="director"><i class="fa fa-map-o" aria-hidden="true"></i>&nbsp;&nbsp;Get Directions</li>' +
                            '<li onClick="openEditor(' + uid + ')"><i class="fa fa-street-view" aria-hidden="true"></i>&nbsp;&nbsp;Check In</li>' +
                            '<li style="border: none" onClick="deleteResource(' + uid + ');closeBoxMenu();"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;After Action Report</li>' +
                        '</ul>';
        e.parentElement.appendChild(menu);
        $('#jobMenu').slideDown('fast');
    } else {
        e.innerHTML = '<i class="fa fa-bars" aria-hidden="true"></i>';
    }
}

function closeBoxMenu() {
    var menu = document.getElementById('jobMenu');
    if( menu != undefined) {
        menu.parentElement.removeChild(menu);
    }
}

function submitFilter() {
    var f = document.getElementById('filter').value;
    var list = document.getElementsByClassName('q');
    if(f != '-1') {
        for(var i = 0; i < list.length; i++) {
            list[i].setAttribute('style', 'display: none;');
        }
        list = document.getElementsByClassName('r' + f);
        for(var i = 0; i < list.length; i++) {
            $(list[i]).slideDown();
        }
    } else {
        for(var i = 0; i < list.length; i++) {
            $(list[i]).slideDown();
        }
    }
}

function getDirections(uid) {
    document.getElementById('director').innerHTML = '<i class="fa fa-cog fa-spin" aria-hidden="true"></i>&nbsp;&nbsp;Loading...</li>';
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
                $.ajax({
                    url: 'controllers/director.php',
                    method: 'post',
                    dataType: 'text',
                    data: {
                        n: uid,
                        action: 'dir',
                        who: 'vendor',
                        geo_lat: geolocation.lat,
                        geo_lng: geolocation.lng
                    },
                    success: function(e) {
                        document.getElementById('director').innerHTML = '<i class="fa fa-arrow-right" style="color: green" aria-hidden="true"></i>&nbsp;&nbsp;<a style="text-decoration: none; color: #193864" href="' + e.link + '">Go!</a></li>';
                        document.getElementById('director').removeAttribute('onClick');
                    }
                });
        }, function(error) {
            document.getElementById('director').innerHTML = '<i class="fa fa-exclamation" style="color: red" aria-hidden="true"></i>&nbsp;&nbsp;Error Occured!</li>';
        });
    }
}

function uhoh(uid) {
    var why = ` <select id='hidden-box' class='wew' style='width: 180px'>
                    <option value='-1' selected hidden>Select a Reason</option>
                    <option value='0'>Too Far</option>
                    <option value='1'>Ill Equiped</option>
                    <option value='2'>Other</option>
                </select><br/>Are you sure?
              `;
    confirmation(why, 'Cancel', function(){
        console.log(document.getElementById('hidden-box').value);
    });
}