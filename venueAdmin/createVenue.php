<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}
?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../uploads/venue/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "120",
	'ResizeHeight' => "120",
	'ResizeFillColor' => "#FFFFFF" );
// WA_UploadResult1_1 End
// WA_UploadResult1_2 Start
$WA_UploadResult1_Params["WA_UploadResult1_2"] = array(
	'UploadFolder' => "../uploads/venue/thumbs/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "2",
	'ResizeWidth' => "100",
	'ResizeHeight' => "120",
	'ResizeFillColor' => "#FFFFFF" );
// WA_UploadResult1_2 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(isset($_POST["InsertLocation"]) || isset($_POST["InsertLocation_x"])){
	WA_DFP_UploadFiles("WA_UploadResult1", "logo_icon", "2", "[NewFileName]_[Increment]", "true", $WA_UploadResult1_Params);
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $InsertQuery = new WA_MySQLi_Query($battlecomm_sqli);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "venue";
  $InsertQuery->bindColumn("venue_Name", "s", "".((isset($_POST["locationName"]))?$_POST["locationName"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_logo_icon", "s", "".((isset($_FILES["logo_icon"]))?$_FILES["logo_icon"]["name"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_Street_Address", "s", "".((isset($_POST["streetAddress"]))?$_POST["streetAddress"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_city", "s", "".((isset($_POST["city"]))?$_POST["city"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_state", "s", "".((isset($_POST["state"]))?$_POST["state"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_zip_cc_code", "s", "".((isset($_POST["zip"]))?$_POST["zip"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_phone", "s", "".((isset($_POST["phone1"]))?$_POST["phone1"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_fax", "s", "".((isset($_POST["fax"]))?$_POST["fax"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_email", "s", "".((isset($_POST["email1"]))?$_POST["email1"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_website", "s", "".((isset($_POST["website"]))?$_POST["website"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_facebook", "s", "".((isset($_POST["facebook"]))?$_POST["facebook"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_about", "s", "".((isset($_POST["aboutLocation"]))?$_POST["aboutLocation"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_contact_name", "s", "".((isset($_POST["primaryContact"]))?$_POST["primaryContact"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_hours", "s", "".((isset($_POST["hours"]))?$_POST["hours"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_outriders", "s", "".((isset($_POST["outriders"]))?$_POST["outriders"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("venue_player_capacity", "s", "".((isset($_POST["playerCapacity"]))?$_POST["playerCapacity"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->saveInSession("venue_id");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Create/Add Location</title>
<link rel="stylesheet" type="text/css" href="../tool/bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../tool/bootstrap/3/css/bootstrap-theme.css" />
<link href="../tool/admin_temp.css" rel="stylesheet" type="text/css">
<link href="../clubsAdmin/CSS/formoid-default-skyblue.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../tool/ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript">
function dmxDataBindingsAction(action, target) { // v1.72
 var inst, evt = jQuery.event.fix(window.event || arguments.callee.caller.arguments[0]),
  args = Array.prototype.slice.call(arguments, 2);

 switch (action) {
  case 'refresh': inst = 'ds'; action = 'load'; break;
  case 'setPage': inst = 'ds'; break;
  case 'selectCurrent': inst = 'rp'; action = 'select'; break;
 }

 inst = (inst == 'ds')
  ? jQuery.dmxDataSet.dataSets[target]
  : jQuery(evt.target).closest('[data-binding-id="' + target + '"]').data('repeater')
  || jQuery.dmxDataBindings.regions[target];

 if (inst) inst[action].apply(inst, args);

 evt.preventDefault();
}

  /* dmxDataSet name "news" */
       jQuery.dmxDataSet(
         {"id": "news", "url": "../../dmxDatabaseSources/news.php", "data": {"sort": "news_date_published", "limit": "3"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "news" */

  /* dmxDataSet name "state" */
       jQuery.dmxDataSet(
         {"id": "state", "url": "../dmxDatabaseSources/state.php", "data": {"limit": "52"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "state" */
</script>
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="Header">
        <h2>BattleComm.com Create New Store/Venue</h2></h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"> <?php include("../tool/nav.php"); ?></div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Create New Store or Location</h2>
      <p>Instructions and so on. . .</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
     
      <p><form enctype="multipart/form-data" class="formoid-default-skyblue" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:800px;min-width:150px" method="post" name="InsertLocation" id="InsertLocation">
        <div class="element-input" title="Name of Location"><label class="title">Location Name<span class="required">*</span></label><input name="locationName" type="text" required="required" class="medium" id="locationName"/></div>
	<div class="element-input" title="Upload Logo or Icon"><label class="title">Logo/Icon</label><input name="logo_icon" type="file" class="file_input" id="logo_icon" /></div>
	<div class="element-input"><label class="title">Street Address</label><input name="streetAddress" type="text" class="medium" id="streetAddress" /></div>
	<div class="element-input"><label class="title">City</label><input name="city" type="text" class="medium" id="city" /></div>
	<div class="element-select"><label class="title">State
	  <select name="state" class="small" id="state" data-binding-repeat-children="{{state.data}}" data-binding-id="repeat2" >
	    <option value="{{state_id}}">{{state_abbr}} </option>
	    </select>
</label>
	  <div class="small"><span><i></i></span></div></div>
	<div class="element-input"><label class="title">Zip Code</label><input name="zip" type="text" class="small" id="zip" /></div>
	<div class="element-phone"><label class="title">Primary Phone</label><input class="small" type="tel" pattern="\d{3}-\d{3}-\d{4}" maxlength="24" name="phone1" placeholder="XXX-XXX-XXXX" value=""/></div>
	<div class="element-phone"><label class="title">Fax</label><input name="fax" type="tel" class="small" id="fax" placeholder="XXX-XXX-XXXX" pattern="\d{3}-\d{3}-\d{4}" value="" maxlength="24"/></div>
	<div class="element-email"><label class="title">Primary Email<span class="required">*</span></label><input name="email1" type="email" required="required" class="medium" value="" /></div>
	<div class="element-url"><label class="title">Website</label><input name="website" type="url" class="medium" id="website" value="http://" /></div>
	<div class="element-url"><label class="title">Facebook</label><input name="facebook" type="url" class="medium" id="facebook" value="http://" /></div>
	<div class="element-input" title="Primary Contact Name"><label class="title">Primary Contact Name<span class="required">*</span></label><input name="primaryContact" type="text" required="required" class="medium" id="primaryContact"/></div>
	<div class="element-separator"><hr><h3 class="section-break-title">Location Information</h3></div>
	<div class="element-textarea"><label class="title">About the Location</label><textarea name="aboutLocation" cols="20" rows="5" class="large" id="aboutLocation" ></textarea></div>
	<div class="element-input"><label class="title">Hours</label><input name="hours" type="text" class="small" id="hours" /></div>
	<div class="element-input"><label class="title">Outriders</label><input name="outriders" type="text" class="small" id="outriders" /></div>
	<div class="element-input"><label class="title">Player Capacity</label><input name="playerCapacity" type="text" class="small" id="playerCapacity" /></div>
<div class="submit"><input name="InsertLocation" type="submit" id="InsertLocation" form="InsertLocation" formmethod="POST" title="Add Location" value="Add Location"/></div></form> </p>
      <p>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>News</h2>
      <div id="newsWrapper" data-binding-id="repeat1" data-binding-repeat="{{news.data}}"><img src="" width="120" data-binding-src="{{featured_image}}" align="texttop" /><strong>{{news_title}}</strong> -{{news_date_published}} - {{news_callout.trunc( 50, true, "…" )}} <a href="#">[Read More...]</a></div>
    </div>
    <div class="col-lg-6">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
</body>
</html>