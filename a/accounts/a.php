<script src="public/javascripts/admin/registration.js"/>
<div class="contentvhr">
    <h1> <i class="fa fa-user-secret" aria-hidden="true"></i>&nbsp;Create an Admin</h1><hr/>
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
    <h1>Privelege Levels:</h1>
    <hr/>
    <center>
        <select <div class="description">
            <option>Admin</option>
            <option>Super Admin</option>
            <option>Billing</option>
            <option>Approval</option>
        </select>
    </center>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('news', false, 'a')">Cancel</button>
    <button style="float: right" onClick="createAdmin()">Save</button>
</div>