<center>
    <h1> JavaScript Testing! </h1>
    <input id="entry" type='text' placeholder="Enter your test string here and then press a button!"></input><br/><br/>
    <div style='max-width: 450px'>
        <button style="float: left; margin-right: 10px" onclick='newToast(document.getElementById("entry").value)'>Toast</button>
        <button style="float: left; margin-right: 10px" onclick='alerter(document.getElementById("entry").value, "Alerter")'>Alerter</button>
        <button style="float: left; margin-right: 10px" onclick='confirmation(document.getElementById("entry").value, "Stuff", function(){})'>Confirmation</button>
    </div>
</center>