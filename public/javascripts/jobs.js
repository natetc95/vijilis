function submitJob() {
    $.ajax({
        url: 'controllers/jobs/edit-create.php',
        method: 'post',
        dataType: 'json',
        data: {
            action: 'create',
            location: JSON.parse('{"lat": ' + parseFloat(document.getElementById('locbox_x').value) + ', "lng": ' + parseFloat(document.getElementById('locbox_y').value) + "}"),
            type: document.getElementById("jobtype").value,
            desc: document.getElementById("jobdesc").value,
            spec: document.getElementById("jobspec").value,
            parent: false
        }
    }).done(function(e) {
        contentLoader('district/news', true, 'im');
        alerter('A new request has been created. #' + e.code, 'Request Tool');
    });
}