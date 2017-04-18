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
        $('body').css({'overflow':'visible'});
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
        $('body').css({'overflow':'visible'});
    });
}
