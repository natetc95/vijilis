<script src="public/javascripts/aRegistration.js"/>
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
            <b>Contact Email: </b><br/>
            <center><input id="fname" class="resourceInputBox" type="text"></input></center>
            <b>Contact Telephone: </b><br/>
            <center><input id="fname" class="resourceInputBox" type="text"></input></center>
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
                            <td><input id="fname" class="resourceInputBox half" type="text"></input></td>
                            <td><input id="fname" class="resourceInputBox half" type="text"></input></td>
                        </tr>
                    </table></center>
                </div>
                <div class="coords">
                    <b>Location 2: </b><br/>
                    <center><table>
                        <tr>
                            <td><input id="fname" class="resourceInputBox half" type="text"></input></td>
                            <td><input id="fname" class="resourceInputBox half" type="text"></input></td>
                        </tr>
                    </table></center>
                </div>
                <div class="coords">
                    <b>Location 3: </b><br/>
                    <center><table>
                        <tr>
                            <td><input id="fname" class="resourceInputBox half" type="text"></input></td>
                            <td><input id="fname" class="resourceInputBox half" type="text"></input></td>
                        </tr>
                    </table></center>
                </div>
            </div>
        </div>
        <div class="interiorvhr nomargin">
            <h2>Identifying Information:</h2><br/><hr style="margin-top: 10px;"/>
            <b>District Name: </b><br/>
            <center>
                <input id="gpass" class="resourceInputBox" type="text"></input><br/><br/>
            </center>
        </div>
    </div>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('resources/my_resources', false)">Cancel</button><button style="float: right" onClick="addResource()">Save</button>
</div>