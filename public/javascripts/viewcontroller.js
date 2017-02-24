var open = false;
function test() {
    if (!open) {
        document.getElementById("sidebar-menu").style = "margin-left: 0px;"
        document.getElementById("burger").setAttribute("class", "fa fa-times");
        //document.getElementById("burger").style="display: none";
        open = true;
    } else {
        document.getElementById("sidebar-menu").style = "margin-left: -200px;"
        document.getElementById("burger").setAttribute("class", "fa fa-bars");
        //document.getElementById("burger").style="display: inline";
        open = false;
    }
    $(".under-menu").each(function() {
        $(this).removeClass('open');
    })
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

function contentLoader(s) {
    var req = $.ajax('controllers/vendor.php', {
        method: 'POST',
        dataType: 'html',
        data: {
            page: "vendor/" + s
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
