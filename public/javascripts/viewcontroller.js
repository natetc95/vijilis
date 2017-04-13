var open = false;
var currPage = 'news';
var wew = false;

function test() {
    if (!open) {
        document.getElementById("sidebar-menu").style = "margin-left: 0px;"
        document.getElementById("burger").setAttribute("class", "fa fa-times");
        //document.getElementById("burger").style="display: none";
        createClicky();
        open = true;
    } else {
        document.getElementById("sidebar-menu").style = "margin-left: -200px;"
        document.getElementById("burger").setAttribute("class", "fa fa-bars");
        removeClicky();
        //document.getElementById("burger").style="display: inline";
        open = false;
    }
    $(".under-menu").each(function() {
        $(this).removeClass('open');
    })
}

function createClicky() {
    var l = document.getElementsByClassName('hidden-clicky').length;
    if (l == 0) {
        var box = document.createElement('div');
        box.setAttribute('class', 'hidden-clicky');
        box.addEventListener('click', clickyListener);
        document.body.appendChild(box);
    }
}

function clickyListener() {
    test();
    removeClicky();
}

function removeClicky() {
    var l = document.getElementsByClassName('hidden-clicky');
    if (l.length > 0) {
        l[0].removeEventListener('click', clickyListener);
        document.body.removeChild(l[0]);
    }
}

function Logout() {
    $.ajax({
        url: 'controllers/logout.php',
        type: 'POST',
        dataType: 'text',
        success: function (success) {
            console.log("Logged Out!");
            window.location = "index.php";
        }
    });
}
function openMenu(type) {
    $(".under-menu").each(function() {
        if( !($(this).is("#" + type + "-under-menu"))) {
            $(this).removeClass('open');
        }
    })
    $("#" + type + "-under-menu").toggleClass('open');
}

function refresh() {
    $('#refresh').toggleClass('fa-spin');
    $('#content').innerHTML = "";
    contentLoader(currPage, false);
    setTimeout(function() {
        $('#refresh').toggleClass('fa-spin');
    }, 1000);
}

function contentLoader(s, menu=true) {
    createLoader();
    currPage = s;
    var req = $.ajax('controllers/vendor.php', {
        method: 'POST',
        dataType: 'html',
        data: {
            page: "v/" + s
        },
       statusCode: {
           403: function() {
                window.location = "errors/403.php";
           },
           404: function() {
               window.location = "errors/404.php";
           },
           418: function() {
               window.location = "errors/418.php";
           }
        }
    });
    req.done(function( msg ) {
        $("#content").html(msg);
        removeLoader();
    });
    if (menu) {
        test()
    }
}

function contentLoaderIM(s) {
    var req = $.ajax('controllers/vendor.php', {
        method: 'POST',
        dataType: 'html',
        data: {
            page: "im\\" + s
        },
       statusCode: {
           403: function() {
                window.location = "errors/403.php";
           },
           404: function() {
               window.location = "errors/404.php";
           },
           418: function() {
               window.location = "errors/418.php";
           }
        }
    });
    req.done(function( msg ) {
        $("#content").html(msg);
    });
    test()
}

function contentLoaderBilling(s) {
    var req = $.ajax('controllers/vendor.php', {
        method: 'POST',
        dataType: 'html',
        data: {
            page: "billing/" + s
        },
       statusCode: {
           403: function() {
                window.location = "errors/403.php";
           },
           404: function() {
               window.location = "errors/404.php";
           },
           418: function() {
               window.location = "errors/418.php";
           }
        }
    });
    req.done(function( msg ) {
        $("#content").html(msg);
    });
    test()
}

function selectBox(s) {
    $("#" + s + "box").toggleClass("hidden");
}

function opensub(s) {
    $(".subreq").each(function () {
        $(this).removeClass("open");
    });
    $("#subreq" + s).addClass("open");

    $(".tab").each(function () {
        $(this).removeClass("selected");
    });
    $("#tab" + s).addClass("selected");
}

var reqs = 2;

function addSub() {
    var newTab = document.createElement("a");
    newTab.setAttribute("href","javascript:void(0)");
    newTab.setAttribute("class", "tab");
    newTab.setAttribute("id", "tab" + reqs);
    newTab.setAttribute("onClick", "opensub(\'" + reqs + "\')");
    newTab.innerHTML = String(reqs);
    document.getElementById("th").appendChild(newTab);
    var newBox = document.createElement("div");
    newBox.setAttribute("id", "subreq" + reqs);
    newBox.setAttribute("class", "subreq");
    newBox.innerHTML = `<br/>
        <div class="description" onChange="selectBox('car')">
            <h2>Incident Type</h2><br/>
            <select class="wew">
                <option selected hidden> -- Choose One -- </option>
                <option>Car Crash</option>
                <option>Debris Cleanup</option>
            </select>
            <div class="description"><br/>
                <h2>Incident Description</h2><br/>
                <textarea></textarea>
            </div>
            <div class="description"><br/>
                <h2>Special Instructions</h2><br/>
                <textarea></textarea>
            </div>
        </div>`;
    document.getElementById("sr").appendChild(newBox);
    reqs++;
}

function FOBBY(uid, menu=false) {
    currPage = 'resources/my_resources';
    var req = $.ajax('v/checkins/addFob.php', {
        method: 'POST',
        dataType: 'html',
        data: {
            uid: uid
        }
    });
    req.done(function( msg ) {
        $("#content").html(msg);
    });
    if (menu) {
        test();
    }
}

function createLoader() {
    var bg = document.createElement('div');
    bg.setAttribute('id', 'loaderBackground');
    bg.innerHTML = '<i id="loader" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw" aria-hidden="true"></i>';
    document.body.appendChild(bg);
}

function removeLoader() {
    var x = document.getElementById('loaderBackground');
    if (x != undefined) {
        document.body.removeChild(x);
    }
}