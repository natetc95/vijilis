<script src="public/javascripts/admin/registration.js"/>
<div class="contentvhr">
    <h1><i class="fa fa-map-o" aria-hidden="true"></i>&nbsp;Create a District</h1><hr/>
    <p style="margin: 0;">&nbsp;A district describes the strict coordinate bounded area which can be serviced. i.e. The service area of one dispatch office.</p>
</div>
<div class="contentvhr">
    <div class="interiorcontainer">
        <div class="interiorvhr">
            <h2>Basic Information:</h2><br/><hr style="margin-top: 10px;"/>
            <b>Contact Name: </b><br/>
            <center><input id="fname" class="resourceInputBox" type="text"></input></center>
            <b id='emV'>Email: </b><br/>
            <center><input id="email" class="resourceInputBox" type="text" onkeyup="validateEmail()"></input></center>
            <b id='tuV'>Telephone: </b><br/>
            <center><input id="telnu" class="resourceInputBox" type="text" onkeyup="validatePhone()"></input></center>
        </div>
        <div class="interiorvhr">
            <h2>Bounding Information:</h2>
            <div class="resourceIconAdd" title="Save" onClick="newNode()" style="margin-top: -6px;">
                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add
            </div>
            <div class="resourceIconDelete" title="Save" onClick="delNode()" style="margin-top: -6px; margin-right: 5px;">
                <i class="fa fa-minus" aria-hidden="true"></i>&nbsp;Remove
            </div>
            <br/><hr style="margin-top: 10px;"/>
            <div id="bounding-box">
                <div class="coords">
                    <b>Location 1: </b><br/>
                    <center><table>
                        <tr>
                            <td><input id="lat" class="resourceInputBox half" type="text"></input></td>
                            <td><input id="lng" class="resourceInputBox half" type="text"></input></td>
                        </tr>
                    </table></center>
                </div>
                <div class="coords">
                    <b>Location 2: </b><br/>
                    <center><table>
                        <tr>
                            <td><input id="lat" class="resourceInputBox half" type="text"></input></td>
                            <td><input id="lng" class="resourceInputBox half" type="text"></input></td>
                        </tr>
                    </table></center>
                </div>
                <div class="coords">
                    <b>Location 3: </b><br/>
                    <center><table>
                        <tr>
                            <td><input id="lat" class="resourceInputBox half" type="text"></input></td>
                            <td><input id="lng" class="resourceInputBox half" type="text"></input></td>
                        </tr>
                    </table></center>
                </div>
            </div>
            <a href="javascript:popModal()" style="float: right; text-decoration: none;"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;Import</a>
        </div>
        <div class="interiorvhr nomargin">
            <h2>Identifying Information:</h2><br/><hr style="margin-top: 10px;"/>
            <b>District Name: </b><br/>
            <center>
                <input id="dname" class="resourceInputBox" type="text"></input><br/><br/>
            </center>
            <b>District Color: </b><br/>
            <center>
                <input type="color" id="color" value="#ffffff" style="width:85%;">
            </center>
        </div>
    </div>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('resources/my_resources', false)">Cancel</button><button style="float: right" onClick="createDistrict()">Save</button>
</div>