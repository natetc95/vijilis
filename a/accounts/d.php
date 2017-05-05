<script src="public/javascripts/admin/registration.js"/>
<div class="contentvhr">
    <h1><i class="fa fa-map-o" aria-hidden="true"></i>&nbsp;Create a Polygon</h1><hr/>
    <p style="margin: 0;">&nbsp;A polygon describes the strict coordinate bounded area which can be serviced. i.e. The service area of one dispatch office.</p>
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
                <input id="dname" class="resourceInputBox" type="text"></input><br/>
            </center>
            <b>District Color: </b><br/>
            <center>
                <input type="color" id="color" value="#ffffff" style="width:85%;" class="resourceInputBox" >
            </center>
            <b>District City & State: </b><br/>
            <center>
                <input type="text" id="city" style="width:85%;" class="resourceInputBox" ><select class="resourceInputBox" id='state'>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>		
            </center>
        </div>
    </div>
</div>
<div class="contentvhr">
    <button style="float: left" onClick="contentLoader('resources/my_resources', false)">Cancel</button><button style="float: right" onClick="createDistrict()">Save</button>
</div>