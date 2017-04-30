function openuser(uid) {
    createLoader();
    $.ajax({
        url: 'controllers/admin/users.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'pullUserData',
            uid: uid
        },
        success: function(e) {
            removeLoader();
            document.getElementById('name').innerHTML = e.code.name;
            document.getElementById('uid').innerHTML = e.code.uid;
            document.getElementById('email').innerHTML = e.code.email;
            document.getElementById('telnum').innerHTML = e.code.telnum;
            document.getElementById('x').removeAttribute('disabled');
            document.getElementById('x').setAttribute('onclick', 'declineUser(' + uid + ')');
            document.getElementById('y').removeAttribute('disabled');
            document.getElementById('y').setAttribute('onclick', 'approveUser(' + uid + ')');
            document.getElementById('zip').innerHTML = '85719';
        },
        failure: function(e) {
            removeLoader();
            console.log(e);
        }
    });
}

function stopNotify() {
    if (!document.getElementById('notify').checked) {
        confirmation('Are you sure that you don\'t want to notify this user?', 'Notify', function() {
            document.getElementById('notify').checked = true;
        });
    }
}

function approveUser(uid) {
    if (uid == parseInt(document.getElementById('uid').innerHTML)) {
        createLoader();
        $.ajax({
            url: 'controllers/admin/users.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'approveUser',
                uid: uid,
                poly: document.getElementById('poly').value,
                type: document.getElementById('type').value,
                notify: document.getElementById('notify').checked,
                msg: document.getElementById('custmsg').value,
                meth: document.getElementById('contactmethod').value
            },
            success: function(e) {
                removeLoader();
                alerter('User ' + uid + " has been approved.", 'Approved!');
                refresh('a');
            },
            failure: function(e) {
                removeLoader();
                console.log(e);
            }
        });
    }
}

function declineUser(uid) {
    if (uid == parseInt(document.getElementById('uid').innerHTML)) {
        createLoader();
        $.ajax({
            url: 'controllers/admin/users.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'declineUser',
                uid: uid,
                notify: document.getElementById('notify').checked,
                msg: document.getElementById('custmsg').value
            },
            success: function(e) {
                removeLoader();
                alerter('User ' + uid + " has been declined.", 'Declined!');
                refresh('a');
            },
            failure: function(e) {
                removeLoader();
                console.log(e);
            }
        });
    }
}

function openResource(uid) {
    createLoader();
    $.ajax({
        url: 'controllers/admin/resources.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'getResource',
            uid: uid
        },
        success: function(e) {
            removeLoader();
            document.getElementById('uid').innerHTML = e.code.uid;
            document.getElementById('title').innerHTML = e.code.rTitle;
            document.getElementById('type').innerHTML = e.code.rType;
            document.getElementById('desc').innerHTML = e.code.rDesc;
            document.getElementById('make').innerHTML = e.code.make;
            document.getElementById('model').innerHTML = e.code.model;
            document.getElementById('year').innerHTML = e.code.year;
            document.getElementById('exp-date').innerHTML = e.code.food;
            document.getElementById('name').innerHTML = e.code.name;
            document.getElementById('uuid').innerHTML = e.code.uuid;
            document.getElementById('vid').innerHTML = e.code.vid;
            document.getElementById('email').innerHTML = e.code.email;
            document.getElementById('telnum').innerHTML = e.code.telnum;
            document.getElementById('x').removeAttribute('disabled');
            document.getElementById('x').setAttribute('onclick', 'declineResource(' + uid + ')');
            document.getElementById('y').removeAttribute('disabled');
            document.getElementById('y').setAttribute('onclick', 'approveResource(' + uid + ')');
            document.getElementById('zip').innerHTML = '85719';
        },
        failure: function(e) {
            removeLoader();
            console.log(e);
        }
    });
}

function approveResource(uid) {
    if (uid == parseInt(document.getElementById('uid').innerHTML)) {
        createLoader();
        $.ajax({
            url: 'controllers/admin/resources.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'approveMe',
                uid: uid,
                notify: document.getElementById('notify').checked,
                msg: document.getElementById('custmsg').value,
                email: document.getElementById('email').innerHTML,
                fname: document.getElementById('name').innerHTML
            },
            success: function(e) {
                removeLoader();
                alerter('<br/>User ' + uid + " has been approved.<br/><br/>", 'Approved!');
                refresh('a');
            },
            failure: function(e) {
                removeLoader();
                console.log(e);
            }
        });
    }
}

function declineResource(uid) {
    if (uid == parseInt(document.getElementById('uid').innerHTML)) {
        createLoader();
        $.ajax({
            url: 'controllers/admin/resources.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'declineMe',
                uid: uid,
                notify: document.getElementById('notify').checked,
                msg: document.getElementById('custmsg').value,
                email: document.getElementById('email').innerHTML,
                fname: document.getElementById('name').innerHTML
            },
            success: function(e) {
                removeLoader();
                alerter('<br/>User ' + uid + " has been declined.<br/><br/>", 'Declined!');
                refresh('a');
            },
            failure: function(e) {
                removeLoader();
                console.log(e);
            }
        });
    }
}
