move =function (field, nextFieldID) {
    if (field.value.length == 1) {
        document.getElementById(nextFieldID).focus();
    }
}
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        document.getElementById('geo_lat').value = position.coords.latitude;
        document.getElementById('geo_lng').value = position.coords.longitude;
    });
}

function getId(x) {
    return document.getElementById(x).value;
}

function checkin() {
    if(getId('q') != '' && getId('a') != '' && getId('b') != '' && getId('c')!= '') {
        $.ajax({
            url: 'controllers/checkin.php',
            method: 'post',
            dataType: 'json',
            data: {
                action: 'fob',
                pin : getId('q') + getId('a') + getId('b') + getId('c'),
                lat: document.getElementById('geo_lat').value,
                lng: document.getElementById('geo_lng').value,
                hash: document.getElementById('hash').value
            }, success: function(e) {
                if (e.status == "SUCC") {
                    window.close();
                    window.location = 'portal.php';
                } else {
                    document.getElementById('q').value = '';
                    document.getElementById('a').value = '';
                    document.getElementById('b').value = '';
                    document.getElementById('c').value = '';
                }
                
            }
        });
    }
}