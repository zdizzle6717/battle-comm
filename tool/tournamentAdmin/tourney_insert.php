<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Insert Tournament</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap-theme.css" />
<link href="../css/genForm.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../Styles/dmxCalendar2.css" />
<link rel="stylesheet" type="text/css" href="../Styles/jqueryui/black-tie/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="../../Styles/dmxEditor.css" />
<link rel="stylesheet" type="text/css" href="../../ScriptLibrary/dmxEditor/iconsets/modern/modern.css" />
<link rel="stylesheet" type="text/css" href="../../styles/dmxEditor/office/office.css" />
<script type="text/javascript" src="../../ScriptLibrary/require.js"></script>
<!--[if IE]><script type="text/javascript" src="../dmx/lib/excanvas-compressed.js"></script><![endif]-->
<link rel="stylesheet" type="text/css" href="../dmx/widgets/Lightbox/styles/default/style.css" />
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/jquery-ui-effects.min.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxCalendar2.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxEditor.min.js"></script>
<script type="text/javascript" src="../dmx/dmx.core.js"></script>
<script type="text/javascript" src="../dmx/widgets/Lightbox/dmx.lightbox.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "state" */
       jQuery.dmxDataSet(
         {"id": "state", "url": "../dmxDatabaseSources/state.php", "data": {"limit": ""}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "state" */

  /* dmxDataSet name "games" */
       jQuery.dmxDataSet(
         {"id": "games", "url": "../dmxDatabaseSources/gamesList.php", "data": {"limit": ""}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "games" */
function dmxDatabaseActionControl(action, id) { // v1.0
  if (jQuery.dmxDatabaseAction) {
    var da = jQuery.dmxDatabaseAction.get(id),
        args = Array.prototype.slice.call(arguments, 2);
    if (da) {
      da[action].apply(da, args);
    }
  }
}
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>
<script type="text/javascript" src="../../bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
   [Eventual Navigation]
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Create New Tournament</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 TTWForm-container">
      <p>
        <form action="" method="post" enctype="multipart/form-data" class="TTWForm ui-sortable-disabled" id="insertTournament"
     novalidate="">
           
           
          <div id="field1-container" class="field f_100 ui-resizable-disabled ">
               <label for="field1">
                    Tournament Name
                      <br>
               </label>
               <input type="text" name="tourneyName" id="field1">
          </div>
           
           
          <div id="field11-container" class="field f_75 ui-resizable-disabled ">
            <label for="field11">
                    Tournament Administrator
                      <br>
               </label>
               <input name="tourneyAdmin" type="text" id="field11" value="<?php echo $_SESSION['svAdminName'];?>" >
          </div>
           
           
          <div id="field2-container" class="field f_50 ui-resizable-disabled ">
               <label for="field2">
                    Start Date
                      <br>
               </label>
               <input class="dmxCalendar2" name="startDate" id="startDate" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#startDate").dmxCalendar2(
         {"altFormat": "yy-mm-dd", "condDates": [], "firstDay": 1, "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "yearRange": "c-10:c+10"}
       );
     }
 );
  // ]]>
</script>
          </div>
           
           
          <div id="field3-container" class="field f_50 ui-resizable-disabled ">
               <label for="field3">
                    End Date
                      <br>
               </label>
               <input class="dmxCalendar2" name="endDate" id="endDate" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#endDate").dmxCalendar2(
         {"altFormat": "yy-mm-dd", "condDates": [], "firstDay": 1, "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "yearRange": "c-10:c+10"}
       );
     }
 );
  // ]]>
</script>
          </div>
           
           
          <div id="field18-container" class="field f_100 ui-resizable-disabled ">
               <label for="field18">
                    Upload Logo/Icon/Banner
               </label>
               <input type="file" class="f_75" name="upload" id="field18">
          </div>
           
           
          <div id="field4-container" class="field f_100 ui-resizable-disabled ">
               <label for="field4">
                    Tournament Location<br>
               </label>
               <input type="text" name="tourneyLocation" id="field4">
          </div>
           
           
          <div id="field5-container" class="field f_100 ui-resizable-disabled ">
               <label for="field5">
                    Address
                      <br>
               </label>
               <input type="text" name="address" id="field5">
          </div>
           
           
          <div id="field6-container" class="field f_50 ui-resizable-disabled ">
               <label for="field6">
                    City
                      <br>
               </label>
               <input type="text" name="city" id="field6">
          </div>
           
           
          <div id="field7-container" class="field f_25 ui-resizable-disabled ">
               <label for="field7">
                    State
                      <br>
               </label>
               
               <select name="State" id="State" data-binding-repeat-children="{{state.data}}" data-binding-id="State">
                 <option value="{{state_abbr}}">{{state_abbr}}</option>
               </select>
          </div>
           
           
          <div id="field8-container" class="field f_25 ui-resizable-disabled ">
               <label for="field8">
                    Zip Code<br>
               </label>
               <input type="text" name="zipcode" id="field8" >
          </div>
           
           
          <div id="field9-container" class="field f_50 ui-resizable-disabled ">
               <label for="field9">
                    Phone
                      <br>
               </label>
               <input type="text" name="phone" id="field9">
          </div>
           
           
          <div id="field10-container" class="field f_50 ui-resizable-disabled ">
               <label for="field10">
                    Main Contact Email
                      <br>
               </label>
               <input type="email" name="email" id="field10">
          </div>
           
           
          <div id="field12-container" class="field f_100 ui-resizable-disabled ">
               <label for="field12">
                    Tournament Website<br>
               </label>
               <input type="url" name="website" id="field12">
          </div>
           
           
          <div id="field13-container" class="field f_100 ui-resizable-disabled ">
               <label for="field13">
                    Tournament Information<br>
               </label>
               <textarea id="tourneyInfo" name="tourneyInfo" class="dmxEditor office" style="width:600px;height:300px"></textarea>
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#tourneyInfo").dmxEditor(
         {"allowLightbox": true, "allowUpload": true, "uploadPath": "../uploads/tournament", "subFolder": "tourneyID", "uploadProcessor": "php", "allowResize": true, "resizeMaxWidth": 300, "resizeMaxHeight": 400, "iconSet": "modern", "includeCss": "../bootstrap/3/css/bootstrap-theme.css", "skin": "office", "toolbars": {"Common": {"items": {"close": true}}}}
       );
     }
 );
  // ]]>
</script>
          </div>
           
           
          <div id="field14-container" class="field f_25 ui-resizable-disabled ">
               <label for="field14">
                    # of Rounds<br>
               </label>
               <input type="number" name="Rounds" id="field14" min="1" max="100">
          </div>
           
           
          <div id="field16-container" class="field f_25 ui-resizable-disabled ">
               <label for="field16">
                    # of Tables
                      <br>
               </label>
               <input type="number" name="Tables" id="field16"  min="1">
          </div>
           
            <div id="field16-container" class="field f_25 ui-resizable-disabled ">
               <label for="field16">
                   Factions Cap
                      <br>
               </label>
               <input type="number" name="FactionsCap" id="field16"  min="1">
          </div>
           
          <div id="field17-container" class="field f_50 ui-resizable-disabled ">
               <label for="field17">
                    Game System
                      <br>
               </label>
               <select name="gameSystem" id="gameSystem" data-binding-repeat-children="{{games.data}}" data-binding-id="gameSystem">
                 <option value="{{game_system_id}}">{{game_system_Title}} </option>
               </select>
          </div>
           
           
          <div id="form-submit" class="field f_100 clearfix submit">
               <input name="Submit" type="Button" id="Submit" formmethod="POST" onClick="dmxDatabaseActionControl('run','addTournament',{},this)" value="Submit">
          </div>
     </form>
      </p>
          </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>Footer Left</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
    <div class="col-lg-6">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
<script type="text/javascript">
  /* dmxDatabaseAction name "addTournament" */
       jQuery.dmxDatabaseAction(
         {"id": "addTournament", "url": "../dmxDatabaseActions/insertTournament.php", "data": {"tournament_name": "{{$FORM.tourneyName}}", "tournament_startDate": "{{$FORM.startDate}}", "tournament_startTime": "", "Tournament_endDate": "{{$FORM.endDate}}", "Tournament_endTime": "", "tournament_store_location": "", "tournament_add_new_location": "", "tournament_location _name": "{{$FORM.tourneyLocation}}", "tournament_logo_icon": "{{$FORM.upload}}", "tournament_address": "{{$FORM.address}}", "tournament_city": "{{$FORM.city}}", "tournament_state": "{{$FORM.State}}", "tournament_zip": "{{$FORM.zipcode}}", "tournament_phone": "{{$FORM.phone}}", "tournament_email": "{{$FORM.email}}", "tournament_URL": "{{$FORM.website}}", "tournament_admin_id": "", "tournament_admin_name": "{{$FORM.tourneyAdmin}}", "tournament_info": "{{$FORM.tourneyInfo}}", "tournament_notes": "", "tournament_rounds": "{{$FORM.Rounds}}", "factions_cap": "{{$FORM.FactionsCap}}", "No_of_Games": "{{$FORM.Tables}}", "game_id": "{{$FORM.gameSystem}}", "game_title": ""}, "success": "MM_goToURL('parent','../index.php');"}
       );
  /* END dmxDatabaseAction name "addTournament" */
</script>
</body>
</html>