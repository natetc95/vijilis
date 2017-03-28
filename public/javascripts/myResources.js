
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
    var title = document.getElementById("title").value;
    var type = document.getElementById("type").value;
    var desc = document.getElementById("desc").value;
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
                    desc: desc
                },
                success: function(e) {
                    if (e == "SUCC") {
                        contentLoader("resources/my_resources", false);
                    } else {
                        console.log(e);
                    }
                }
            });
    } else {
        console.log("FAILURE 2");
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
    var title = document.getElementById("title").value;
    var type = document.getElementById("type").value;
    var desc = document.getElementById("desc").value;
    if(title.length > 0 && type > -1) {
        $.ajax({
                url: 'controllers/resources.php',
                type: 'POST',
                dataType: 'text',
                data: {
                    action: 'editResource',
                    uid: uid,
                    title: title,
                    type: type,
                    desc: desc
                },
                success: function(e) {
                    if (e == "SUCC") {
                        contentLoader("resources/my_resources", false);
                    } else {
                        console.log("FAILURE: " + e);
                    }
                }
            });
    } else {
        console.log("FAILURE");
    }
}

function vecHandler() {
    var value = parseInt(document.getElementById("type").value, 10);
    yearMaker();
    $( function() {
        $( "#expiration" ).datepicker();
    } );
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

document.getElementById("myRange").addEventListener('mousemove', function() {
    document.getElementById("capacity").value = document.getElementById("myRange").value;
});