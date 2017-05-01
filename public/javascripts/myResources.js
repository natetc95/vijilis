
function yearMaker() {
    var start = new Date().getFullYear();
    var end = 1950;
    var options = "";
    for(var year = start ; year >=end; year--){
    options += "<option>"+ year +"</option>";
    }
    document.getElementById("year").innerHTML = options;
}

function deleteResource(uidOfResource) {
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
    prompt.innerHTML = `<div id='promptTitle'><h1>Confirm Deletion</h1></div>
                        <p>Are you sure you would like to delete this resource? This is <b>permanent</b> and cannot be undone!</p>
                        <div class="promptoptions">
                            <div class="promptAccept" id="pAid" title="Edit"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Delete</div>
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
        $.ajax({
            url: 'controllers/resources.php',
            type: 'POST',
            dataType: 'text',
            data: {
                action: 'deleteResource',
                resourceToDelete: uidOfResource
            }
        });
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        refresh();
        $(document).unbind('scroll'); 
        $('body').css({'overflow':'visible'});
    });
}

function addResource() {
    var A = document.getElementById('img1') != undefined && $('#img1')[0].files[0];
    var B = document.getElementById('img2') != undefined && $('#img2')[0].files[0];
    var C = document.getElementById('img3') != undefined && $('#img3')[0].files[0];
    if (A && B && C) {
        var title = document.getElementById("title").value;
        var type = document.getElementById("type").value;
        var desc = document.getElementById("desc").value;
        if (document.getElementById("vec_info").getAttribute("class") == "resourceAddtInfo open") {
        var make = document.getElementById("make").value;
        var model = document.getElementById("model").value;
        var year = document.getElementById("year").value;
        } else {
            var make = "NULL";
            var model = "NULL";
            var year = 0;
        }
        if (document.getElementById("tow_info").getAttribute("class") == "resourceAddtInfo open") {
            var tclass = "Z";
            var val = parseInt(document.getElementById("capacity").value);
            if (val <= 7000) {
                tclass = "A";
            } else if (val > 7000 && val <= 17000) {
                tclass = "B";
            } else {
                tclass = "C";
            }
        } else {
            var tclass = "Z";
        }
        if (document.getElementById("food_info").getAttribute("class") == "resourceAddtInfo open") {
            var cxim = document.getElementById("expiration").value;
        } else {
            var cxim = "00/00/0000";
        }
        console.log(title+type+desc);
        if(title.length > 0 && type > -1) {
            $.ajax({
                    url: 'controllers/resources.php',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        action: 'addResource',
                        title: title,
                        type: type,
                        desc: desc,
                        make: make,
                        model: model,
                        year: year,
                        class: tclass,
                        cxim: cxim
                    },
                    success: function(e) {
                        if (e != "FAIL") {
                            console.log(e);
                            addImage(e, 'img1');
                            addImage(e, 'img2');
                            addImage(e, 'img3');
                            setTimeout(function() {
                                contentLoader("resources/my_resources", false);
                            }, 100);
                        } else {
                            console.log(e);
                        }
                    }
                });
        } else {
            console.log("FAILURE 2");
        }
    } else {
        console.log('No Images Submitted!');
    }
}

function addImage(id, imgtype) {
    if($('#' + imgtype)[0].files[0] && $('#' + imgtype)[0].files[0].size <= 2097152) {
        var formData = new FormData();
        formData.append('file', $('#' + imgtype)[0].files[0]);
        formData.append('action', 'img');
        formData.append('uid', id);
        formData.append('imgtype', imgtype);
        $.ajax({
            url : 'controllers/resources.php',
            type : 'POST',
            data : formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success : function(data) {
                // console.log(data);
            }
        });
    } else if ($('#' + imgtype)[0].files[0].size > 2097152) {
        alert("The file you attempted to upload (" + $('#' + imgtype)[0].files[0].name + ") was too large!");
    } else {
        alert("You didn't add a file to " + imgtype + "!");
    }
}

function openEditor(uid) {
    currPage = 'resources/my_resources';
    var req = $.ajax('v/resources/edit_resource.php', {
        method: 'POST',
        dataType: 'html',
        data: {
            uid: uid
        }
    });
    req.done(function( msg ) {
        $("#content").html(msg);
    });
}

function editResource(uid) {
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
    prompt.innerHTML = `<div id='promptTitle'><h1>Confirm Edit</h1></div>
                        <p>Are you sure you would like to edit this resource? This resource will need to be reapproved!</p>
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
        var title = document.getElementById("title").value;
        var type = document.getElementById("type").value;
        var desc = document.getElementById("desc").value;
        if (document.getElementById("vec_info").getAttribute("class") == "resourceAddtInfo open") {
            var make = document.getElementById("make").value;
            var model = document.getElementById("model").value;
            var year = document.getElementById("year").value;
        } else {
            var make = "NULL";
            var model = "NULL";
            var year = 0;
        }
        if (document.getElementById("tow_info").getAttribute("class") == "resourceAddtInfo open") {
            var tclass = "Z";
            var val = parseInt(document.getElementById("capacity").value);
            if (val <= 7000) {
                tclass = "A";
            } else if (val > 7000 && val <= 17000) {
                tclass = "B";
            } else {
                tclass = "C";
            }
        } else {
            var tclass = "Z";
        }

        if (document.getElementById("food_info").getAttribute("class") == "resourceAddtInfo open") {
            var cxim = document.getElementById("expiration").value;
        } else {
            var cxim = "00/00/0000";
        }

        if(document.getElementById('cbox1').checked) {
            var rfv = 1;
        } else {
            var rfv = 0;
        }

        if(title.length > 0 && type > -1) {
            if (document.getElementById('img1') != undefined && $('#img1')[0].files[0]) {
                addImage(uid, 'img1');
            }
            if (document.getElementById('img2') != undefined && $('#img2')[0].files[0]) {
                addImage(uid, 'img2');
            }
            if (document.getElementById('img3') != undefined && $('#img3')[0].files[0]) {
                addImage(uid, 'img3');
            }
            $.ajax({
                    url: 'controllers/resources.php',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        action: 'editResource',
                        uid: uid,
                        title: title,
                        type: type,
                        desc: desc,
                        make: make,
                        rfv: rfv,
                        model: model,
                        year: year,
                        class: tclass,
                        cxim: cxim
                    },
                    success: function(e) {
                        if (e == "SUCC") {
                            console.log(e);
                            contentLoader("resources/my_resources", false);
                        } else {
                            console.log("FAILURE: " + e);
                        }
                    }
                });
        } else {
            console.log("FAILURE");
        }
        var m = document.getElementById("promptBackground");
        document.body.removeChild(m);
        var y = document.getElementById("promptDelete");
        document.body.removeChild(y);
        refresh();
        $(document).unbind('scroll'); 
        $('body').css({'overflow':'visible'});
    });
}

if(document.getElementById('type') != undefined) {
    document.getElementById('type').addEventListener('change', function() {
        vecHandler();
    });
}

function vecHandler() {
    var value = parseInt(document.getElementById("type").value, 10);
    yearMaker();
    $( function() {
        $( "#expiration" ).datepicker();
    } );
    value = parseInt(value);
    console.log(value);
    if (value > -1 && value < 3) {
        document.getElementById("vec_info").setAttribute("class", "resourceAddtInfo open");
    } else {
        document.getElementById("vec_info").setAttribute("class", "resourceAddtInfo");
    }
    if (value == 0) {
        document.getElementById("tow_info").setAttribute("class", "resourceAddtInfo open");
    } else {
        document.getElementById("tow_info").setAttribute("class", "resourceAddtInfo");
    }
    if (value == 3) {
        document.getElementById("food_info").setAttribute("class", "resourceAddtInfo open");
    } else {
        document.getElementById("food_info").setAttribute("class", "resourceAddtInfo");
    }
}
if(document.getElementById("myRange") != undefined) {
    document.getElementById("myRange").addEventListener('mousemove', function() {
        document.getElementById("capacity").value = document.getElementById("myRange").value;
    });
}

function changeLocationSetting() {
    if(!document.getElementById('cbox1').checked) {
        document.getElementById('locdata').setAttribute("class", "open");
        document.getElementById('forcbox1').innerHTML = "Resource Follows Vendor?&nbsp;<a href='javascript:console.log(\"jasdlfh\")'>Find Me!</a>";
    } else {
        document.getElementById('locdata').setAttribute("class", "");
        document.getElementById('forcbox1').innerHTML = "Resource Follows Vendor?";
    }
}

var menuEvent = null;

function openBoxMenu(uid, active) {
    closeBoxMenu();
    var e = document.getElementById('r' + uid);
    if(e.innerHTML != '<i class="fa fa-times" aria-hidden="true"></i>') {
        var activeContent = (active == 0 ? '<li onClick="activate(' + uid + ', 1)" style="border: none"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Make Active</li>' : '<li onClick="activate(' + uid + ', 0)" style="border: none"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;Make Inactive</li>')
        var list = document.getElementsByClassName('resourceMenu');
        for (var i = 0; i < list.length; i++) {
            list[i].innerHTML = '<i class="fa fa-bars" aria-hidden="true"></i>';
        }
        e.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
        var menu = document.createElement('div');
        menu.setAttribute('id', 'resourceMenu');
        menu.innerHTML = '<ul>' +
                            '<li onClick="openEditor(' + uid + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;Edit</li>' +
                            '<li onClick="deleteResource(' + uid + ');closeBoxMenu();"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;Delete</li>' +
                            activeContent +
                        '</ul>';
        e.parentElement.appendChild(menu);
        $('#resourceMenu').slideDown('fast');
    } else {
        e.innerHTML = '<i class="fa fa-bars" aria-hidden="true"></i>';
    }
}

function closeBoxMenu() {
    var menu = document.getElementById('resourceMenu');
    if( menu != undefined) {
        menu.parentElement.removeChild(menu);
    }
}

function activate(uid, yes) {
    $.ajax({
        url: 'controllers/resources.php',
        method: 'post',
        dataType: 'json',
        data: {
            action: 'activate',
            uid: uid,
            do: (yes == 1 ? true : false)
        }
    }).done(function(e) {
        refresh();
        if (yes) {
            alerter('Resource #' + uid + ' has been activated.<br/>All others have been deactivated!', 'Activation Done');
        } else {
            alerter('All resources have been deactivated!', 'Activation Done');
        }
    })
}