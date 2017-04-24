<script src="public/javascripts/admin/registration.js"/>
<div class="contentvhr">
    <h1> <i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Create a Vendor</h1><hr/>
    <p style="margin: 0;">&nbsp;Vendors service the requests as they come in. They are the main workforce of the system.</p>
</div>
<div class="contentvhr">
    <div class="interiorcontainer">
        <div class="interiorvhr">
            <h2>Basic Information:</h2><br/><hr/>
            <b>First Name: </b><br/>
            <center><input id="fname" class="resourceInputBox" type="text"></input></center>
            <b>Last Name: </b><br/>
            <center><input id="lname" class="resourceInputBox" type="text"></input></center>
        </div>
        <div class="interiorvhr">
            <h2>Contact Information:</h2><br/><hr/>
            <b id='emV'>Email: </b><br/>
            <center><input id="email" class="resourceInputBox" type="text" onkeyup="validateEmail()"></input></center>
            <b id='tuV'>Telephone: </b><br/>
            <center><input id="telnu" class="resourceInputBox" type="text" onkeyup="validatePhone()"></input></center>
        </div>
        <div class="interiorvhr nomargin">
            <h2>Login Information:</h2><br/><hr/>
            <b>Username: </b><br/>
            <center>
                <input id="guser" class="resourceInputBox" style="width: 160px; float: left;" type="text"></input>
                <button style="margin-left: 5px; margin-top: -8px; float: left;width: 100px;" onclick="generateUsername()">Generate Username</button>
            </center><br/><br/>
            <b>Password: </b><br/>
            <center>
                <input id="gpass" class="resourceInputBox" style="width: 160px; float: left;" type="text"></input>
                <button style="margin-left: 5px; margin-top: -8px; float: left;width: 100px;" onclick="generatePassword()">Generate Password</button>
            </center>
        </div>
    </div>
</div>
<div class="contentvhr">
    <h1>Profile Image</h1>
    <hr/>
    <center>
        <input id="fname" class="resourceInputBox" type="file"></input><br/>
    </center>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('news', false, 'a')">Cancel</button>
    <button style="float: right" onClick="createVendor()">Save</button>
</div>