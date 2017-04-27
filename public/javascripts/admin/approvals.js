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