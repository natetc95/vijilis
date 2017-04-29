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
            document.getElementById('zip').innerHTML = '85719';
        },
        failure: function(e) {
            removeLoader();
            console.log(e);
        }
    });
}
