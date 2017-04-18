<!DOCTYPE html>
<html>
  <head>
    <title>Big Maperoo</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
       body {
           overflow: hidden;
       }
      #biggysmalls {
        position: relative;
        height: 100%;
        width: 100%;
        margin: -15px 0px 0px -15px;
        margin: 
      }
    </style>
    <script src="public/javascripts/maps/big_map.js"></script>
  </head>
  <body>
    <div id="biggysmalls"></div>
    <div id="filter-box">
       <div onclick="toggleFilters()" style="margin-bottom: 5px; text-align: center;">Filters</div>
       <label>Show:</label>
       <div>
            <input id="fJobs" type="checkbox" checked/>Jobs<br/>
            <input id="fInactive" type="checkbox"/>Active Resources<br/>
            <input id="fActive" type="checkbox"/>Inactive Resources<br/>
        </div>
        <center><button style="margin-top: 5px" onClick="getAllData()">Apply</button></center>
    </div>
    <div id="jobinfo">
        <i class="fa fa-times fa-lg close-information" aria-hidden="true" onclick="closeInformation()"></i>
        <div style='float: left'>
            <h1 style="margin: 0; padding: 0;">Job Information</h1>
            <table>
                <tr>
                    <td>Job Number:</td>
                    <td id="jn"></td>
                </tr>
                <tr>
                    <td>Latitude:</td>
                    <td id="lat">40.674</td>
                </tr>
                <tr>
                    <td>Longitude:</td>
                    <td id="lon">-73.945</td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td id="lon" style='width: 300px'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras convallis lectus id nunc consequat luctus. Quisque ullamcorper tortor id nisl volutpat, vitae interdum eros dictum. Aenean vulputate nulla vestibulum, elementum lacus sit amet, pulvinar arcu.</td>
                </tr>
            </table>
            <div id="googbox">Maps courtesy of </div><img src="public\images\google_attr.png" id="googattr"></img>
            
        </div>
        <div style='float: left'>
            <h1 style="margin: 0; padding: 0;">Vendor Information</h1>
            <table>
                <tr>
                    <td>Name:</td>
                    <td id="jn">Nate Christianson</td>
                </tr>
                <tr>
                    <td>Company:</td>
                    <td id="jn">N/A</td>
                </tr>
                <tr>
                    <td>Vendor ID:</td>
                    <td id="jn">590</td>
                </tr>
                <tr>
                    <td>Resource:</td>
                    <td id="lat">Tow Truck</td>
                </tr>
                <tr>
                    <td>Towing Class:</td>
                    <td id="lon">C</td>
                </tr>
            </table>
        </div>
        <div style='float: left; margin-left: 25px;'>
            <h1 style="margin: 0; padding: 0;">Available Images</h1>
            <img style='float: left; margin-right: 10px;' src='public/images/crash.png' height='180px'/>
        </div>
    </div>
  </body>
</html>