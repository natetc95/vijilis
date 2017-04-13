<script src="public/javascripts/aRegistration.js"/>
<div class="contentvhr">
    <h1> <i class="fa fa-truck" aria-hidden="true"></i>&nbsp;Create a Vendor</h1><hr/>
    <div class="interiorcontainer">
        <div class="interiorvhr">
            <h2>Contact Information:</h2><br/><hr/>
            <b>Username: </b><br/>
            <center><input id="fname" class="resourceInputBox" type="text"></input></center>
            <b>Email: </b><br/>
            <center><input id="fname" class="resourceInputBox" type="text"></input></center>
            <b>Telephone: </b><br/>
            <center><input id="fname" class="resourceInputBox" type="text"></input></center>
        </div>
        <div class="interiorvhr">
            <h2>Basic Information:</h2><br/><hr/>
            <b>First Name: </b><br/>
            <center><input id="fname" class="resourceInputBox" type="text"></input></center>
            <b>Last Name: </b><br/>
            <center><input id="fname" class="resourceInputBox" type="text"></input></center>
        </div>
        <div class="interiorvhr nomargin">
            <h2>Passwords:</h2><br/><hr/>
            <b>Password: </b><br/>
            <center>
                <input id="gpass" class="resourceInputBox" type="text"></input><br/><br/>
                <button onclick="generatePassword()">Generate Password</button>
            </center>
        </div>
    </div>
</div>
<div class="contentvhr">
    <h1>Profile Image</h1><hr/>
    <center>
            <input id="fname" class="resourceInputBox" type="file"></input><br/>
    </center>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('resources/my_resources', false)">Cancel</button><button style="float: right" onClick="addResource()">Save</button>
</div>