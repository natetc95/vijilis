
/* viewcontroller.js
* Handles all visuals for the site :P
* Included Functions:
* - test()
* - createClicky()
* - clickyListener()
* - removeClicky()
* - Logout()
* - openMenu(type)
* - refresh()
* - contentLoader(s, menu=true)
* - contentLoaderIM(s)
* - selectBox(s)
* - opensub(s)
* - addSub()
* - FOBBY(uid, menu=false)
* - createLoader()
* - removeLoader()
* - confirmation(message, header, callback)
* - alerter(message, header)
* - days(d)
* - clock()
* - newToast(message, duration)
*
* Also start the center clock on the index.php page
*
* VIJILIS: Emergency Response System
*
* Senior Design Team 16040
* University of Arizona
* Nathaniel Christianson & Travis Roser
*/

var open = false;
var currPage = 'news';
var wew = false;

function test() {
    console.log('menu open');
    if (!open) {
        document.getElementById('sidebar-menu').setAttribute('class', 'open')
        document.getElementById("burger").setAttribute("class", "fa fa-times");
        //document.getElementById("burger").style="display: none";
        createClicky();
        open = true;
    } else {
        document.getElementById('sidebar-menu').removeAttribute('class')
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

function refresh(q) {
    $('#refresh').toggleClass('fa-spin');
    $('#content').innerHTML = "";
    contentLoader(currPage, false, q);
    setTimeout(function() {
        $('#refresh').toggleClass('fa-spin');
    }, 1000);
}

function contentLoader(s, menu, q) {
    window.scrollTo(0, 0);
    createLoader();
    currPage = s;
    var req = $.ajax('controllers/vendor.php', {
        method: 'POST',
        dataType: 'html',
        data: {
            page: q + "/" + s
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
    createLoader();
    var req = $.ajax('controllers/vendor.php', {
        method: 'POST',
        dataType: 'html',
        data: {
            page: "im/" + s
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
      removeLoader();
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

var reqs = 1;

function addSub() {
    reqs++;
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
    //var parentID = document.getElementById("parentID").value;
    newBox.innerHTML = `<br/>
      <div class="description" onChange="selectBox('car')">
        <h2>Incident Type</h2><br/>
        <select class="wew" id="jobtype">
            <option selected hidden> -- Choose One -- </option>
            <option value='0'>Car Crash</option>
            <option value='1'>Debris Cleanup</option>
        </select>
        <br/><br/><h2>Priority</h2><br/>
        <select class="wew" id="priorityinp">
            <option selected hidden> -- Choose One -- </option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
        </select>
        <div class="description" ><br/>
            <h2>Incident Description</h2><br/>
            <textarea id="jobdesc"></textarea>
        </div>
        <div class="description"><br/>
            <h2>Special Instructions</h2><br/>
            <textarea id="jobspec"></textarea>
        </div>
      </div>

      <div style="margin-top:10px;margin-bottom:10px;">
        <center><button onClick="removeLinkedJob()">Remove Linked Job</button></center>
      </div>`;
    document.getElementById("sr").appendChild(newBox);
    opensub(reqs);
}

function FOBBY(uid, menu) {
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

function confirmation(message, header, cb) {

    message = message.replace(/(?:\r\n|\r|\n)/g, '<br/>');
    var output = false;

    $('body').css({'overflow':'hidden'});
    $(document).bind('scroll',function () {
        window.scrollTo(0,document.body.scrollTop);
    });
    var hgt = $(window).height();
    var bg = document.createElement("div");
    var prompt = document.createElement("div");
    bg.setAttribute("id", "promptBackground");
    bg.setAttribute("style", "top: " + document.body.scrollTop + "px;");
    bg.addEventListener("click", function(e) {
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll');
        $('body').css({'overflow':'visible'});
    });
    prompt.setAttribute("id", "promptDelete");
    prompt.setAttribute("style", "top: " + (document.body.scrollTop + hgt/3) + "px;");
    prompt.innerHTML = `<div id='promptTitle'><h1>Confirm ` + header + `</h1></div>
                        <p style="min-height: 66px; overflow: hidden;">` + message + `</p>
                        <div class="promptoptions">
                            <div class="promptAccept" id="pAid" title="Edit"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Ok</div>
                            <div class="promptDecline" id="pDid" title="Edit"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</div>
                        </div>`;
    document.body.appendChild(prompt);
    document.body.appendChild(bg);
    document.getElementById("pDid").addEventListener("click", function(e) {
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll');
        $('body').css({'overflow':'visible'});
    });
    document.getElementById("pAid").addEventListener("click", function(e) {

        cb();

        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll');
        $('body').css({'overflow':'visible'});
    });
}

function alerter(message, header) {

    message = message.replace(/(?:\r\n|\r|\n)/g, '<br/>');
    var output = false;

    $('body').css({'overflow':'hidden'});
    $(document).bind('scroll',function () {
        window.scrollTo(0,document.body.scrollTop);
    });
    var hgt = $(window).height();
    var bg = document.createElement("div");
    var prompt = document.createElement("div");
    bg.setAttribute("id", "promptBackground");
    bg.setAttribute("style", "top: " + document.body.scrollTop + "px;");
    bg.addEventListener("click", function(e) {
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll');
        document.body.style='';
    });
    prompt.setAttribute("id", "promptDelete");
    prompt.setAttribute("style", "top: " + (document.body.scrollTop + hgt/3) + "px;");
    prompt.innerHTML = `<div id='promptTitle'><h1>` + header + `</h1></div>
                        <div style="min-height: 77px; overflow: hidden; display: table; margin: 0 auto;"><div style="vertical-align: middle; display: table-cell;">` + message + `</div></div>
                        <div class="promptoptions">
                            <center><div class="promptAck" id="pAid" title="Edit"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Ok</div></center>
                        </div>`;
    document.body.appendChild(prompt);
    document.body.appendChild(bg);
    document.getElementById("pAid").addEventListener("click", function() {
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        $(document).unbind('scroll');
        document.body.style='';
    });
}

function days(d) {
    switch(d) {
        case 0:
            return 'Mon';
        case 1:
            return 'Tue';
        case 2:
            return 'Wed';
        case 3:
            return 'Thu';
        case 4:
            return 'Fri';
        case 5:
            return 'Sat';
        case 6:
            return 'Sun';
    }
}

var clk = null;

function clock_stop() {
    clearInterval(clk);
}

function clock() {
    clk = setInterval(function() {
        var dt = new Date();
        var q = (dt.getHours() < 12) ? "AM":"PM";
        var v = (Math.round(dt.getTimezoneOffset()/60) < 0) ? "-":"+";
        var s = (dt.getSeconds() < 10) ? ("0" + dt.getSeconds()):dt.getSeconds();
        var m = (dt.getMinutes() < 10) ? ("0" + dt.getMinutes()):dt.getMinutes();
        var clockface = days(dt.getDay()) + ' ' + dt.getMonth() + '/' + dt.getDate() + '/' + dt.getFullYear();
        clockface += '<br/>' + dt.getHours()%12 + ':' + m + ':' + s + ' '  + q + ' GMT' + v + Math.round(dt.getTimezoneOffset()/60);
        document.getElementById('clock').innerHTML = clockface;
        dt = null;
    }, 1);
}

window.onload = function() {
    clock();
}

function newToast(message) {
    var toast = document.createElement('div');
    toast.setAttribute('class', 'toast');
    toast.setAttribute('id', 'toast');
    toast.innerHTML = message;
    document.body.appendChild(toast);
    setTimeout(function() {
        toast.style.marginLeft = '-' + $('#toast').width()/2 + 'px';
    }, 100);
    $('#toast').fadeIn('slow');
    setTimeout(function() {
        $('#toast').fadeOut('slow');
        setTimeout(function() {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);

}
