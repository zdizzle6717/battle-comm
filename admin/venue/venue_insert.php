<?php require_once("../../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_venueinsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateZC((isset($_POST["venue_zip_cc_code"])?$_POST["venue_zip_cc_code"]:"") . "",true,false,false,false,false,1);
  $WAFV_Errors .= WAValidatePN((isset($_POST["venue_phone"])?$_POST["venue_phone"]:"") . "",false,true,false,2);
  $WAFV_Errors .= WAValidatePN((isset($_POST["venue_fax"])?$_POST["venue_fax"]:"") . "",false,true,false,3);
  $WAFV_Errors .= WAValidateEM((isset($_POST["venue_email"])?$_POST["venue_email"]:"") . "",false,4);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"venueinsert");
   }
 }
 ?>
<?php require_once("../../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenuvenue_state = "SELECT state_name, state_abbr FROM tbl_state ORDER BY state_name ASC";
$WADAMenuvenue_state = mysql_query($query_WADAMenuvenue_state, $local) or die(mysql_error());
$row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state);
$totalRows_WADAMenuvenue_state = mysql_num_rows($WADAMenuvenue_state);
?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../../uploads/venue",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(isset($_POST["Insert"]) || isset($_POST["Insert_x"])){
	WA_DFP_UploadFiles("WA_UploadResult1", "venue_logo_icon", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "venue";
  $WA_sessionName = "WADA_Insert_venue";
  $WA_redirectURL = "venue_detail.php?venue_id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "venue_Name|venue_logo_icon|venue_Street_Address|venue_city|venue_state|venue_zip_cc_code|venue_phone|venue_fax|venue_email|venue_website|venue_contact_name|venue_about|venue_outriders|venue_player_capacity|venue_map_URL";
  $WA_fieldValuesStr = "".((isset($_POST["venue_Name"]))?$_POST["venue_Name"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["venue_Street_Address"]))?$_POST["venue_Street_Address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_city"]))?$_POST["venue_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_state"]))?$_POST["venue_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_zip_cc_code"]))?$_POST["venue_zip_cc_code"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_phone"]))?$_POST["venue_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_fax"]))?$_POST["venue_fax"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_email"]))?$_POST["venue_email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_website"]))?$_POST["venue_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_contact_name"]))?$_POST["venue_contact_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_about"]))?$_POST["venue_about"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_outriders"]))?$_POST["venue_outriders"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_player_capacity"]))?$_POST["venue_player_capacity"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_map_URL"]))?$_POST["venue_map_URL"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local;
  mysql_select_db($WA_connectionDB, $WA_connection);
  @session_start();
  $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj->WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues . ")";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  $_SESSION[$WA_sessionName] = mysql_insert_id($WA_connection);
  if ($WA_redirectURL != "")  {
    $WA_redirectURL = str_replace("[Insert_ID]",$_SESSION[$WA_sessionName],$WA_redirectURL);
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Battlecomm: Insert Tournament</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/form_clean.css">
    <link href="../../webassist/forms/fd_basic_defaultmod.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../webassist/jq_validation/Inspiration.css">
    <link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="../../webassist/forms/fd_basic_defaultmod/Datepicker/css/jquery-custom.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#tournament_startDate').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_tournament_startDate
	});
});
function closeDatePicker_tournament_startDate() {
	var tElm = $('#tournament_startDate');
	if (typeof tournament_startDate_Spry != null && typeof tournament_startDate_Spry != "undefined" && tournament_startDate_Spry.validate) {
		tournament_startDate_Spry.validate();
	}
	tElm.blur();
}
</script><link type="text/css" href="../../webassist/forms/fd_basic_defaultmod/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#Tournament_endDate').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_Tournament_endDate
	});
});
function closeDatePicker_Tournament_endDate() {
	var tElm = $('#Tournament_endDate');
	if (typeof Tournament_endDate_Spry != null && typeof Tournament_endDate_Spry != "undefined" && Tournament_endDate_Spry.validate) {
		Tournament_endDate_Spry.validate();
	}
	tElm.blur();
}
</script>
</head>
	<?php include '../includes/parts/header.php'; ?>
		<?php include '../includes/parts/container-top-create-venue.php'; ?>
<div id="Insert_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data"  class="Basic_Default" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
          <legend class="groupHeader">Enter New Venue Details</legend>
<div class="full_width">
	<h3>General Info:</h3>
    <div class="lineGroup"> <label for="venue_Name" class="sublabel" > Name:</label>
  <input id="venue_Name" name="venue_Name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_Name"):"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_logo_icon" class="sublabel" > Upload Logo:</label>
  <input name="venue_logo_icon" type="file" id="venue_logo_icon" size="30" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_Street_Address" class="sublabel" > Street Address:</label>
  <input id="venue_Street_Address" name="venue_Street_Address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_Street_Address"):"")); ?>" class="formTextfield_Large" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_city" class="sublabel" > City:</label>
  <input id="venue_city" name="venue_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_city"):"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_state" class="sublabel" > State:</label>
      <select class="formMenufield_Large" name="venue_state" id="venue_state" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_state"):"")); ?>" tabindex="5" title="Please enter a value.">
<option value="">Choose State...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuvenue_state['state_abbr']?>"<?php if (!(strcmp($row_WADAMenuvenue_state['state_abbr'], (isset($_GET["invalid"])?ValidatedField("venueinsert","venue_state"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuvenue_state['state_name']?></option>
        <?php
} while ($row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state));
  $rows = mysql_num_rows($WADAMenuvenue_state);
  if($rows > 0) {
      mysql_data_seek($WADAMenuvenue_state, 0);
	  $row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="venue_zip_cc_code" class="sublabel" > Zip Code:</label>
  <input id="venue_zip_cc_code" name="venue_zip_cc_code" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_zip_cc_code"):"")); ?>" class="formTextfield_Medium" tabindex="6" pattern="(\d{5}([\-]\d{4})?)" title="Please enter a value.">
	   <?php
if (ValidatedField('venueinsert','venueinsert'))  {
  if ((strpos((",".ValidatedField("venueinsert","venueinsert").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="venue_zip_cc_code_ServerError">Please enter a value.</span><?php //WAFV_Conditional venue_insert.php venueinsert(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="venue_phone" class="sublabel" > Phone:</label>
  <input id="venue_phone" name="venue_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_phone"):"")); ?>" class="formTextfield_Medium" tabindex="7" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').venue_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').venue_phone,0,true);">
	   <?php
if (ValidatedField('venueinsert','venueinsert'))  {
  if ((strpos((",".ValidatedField("venueinsert","venueinsert").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="venue_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional venue_insert.php venueinsert(2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="venue_fax" class="sublabel" > Fax:</label>
  <input id="venue_fax" name="venue_fax" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_fax"):"")); ?>" class="formTextfield_Medium" tabindex="8" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').venue_fax,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').venue_fax,0,true);">
	   <?php
if (ValidatedField('venueinsert','venueinsert'))  {
  if ((strpos((",".ValidatedField("venueinsert","venueinsert").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="venue_fax_ServerError">Please enter a value.</span><?php //WAFV_Conditional venue_insert.php venueinsert(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="venue_email" class="sublabel" > Email:</label>
  <input id="venue_email" name="venue_email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_email"):"")); ?>" class="formTextfield_Medium" tabindex="9" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value.">
	   <?php
if (ValidatedField('venueinsert','venueinsert'))  {
  if ((strpos((",".ValidatedField("venueinsert","venueinsert").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="venue_email_ServerError">Please enter a value.</span><?php //WAFV_Conditional venue_insert.php venueinsert(4:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="venue_website" class="sublabel" > Website:</label>
  <input id="venue_website" name="venue_website" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_website"):"")); ?>" class="formTextfield_Medium" tabindex="10" title="Please enter a value.">
    </div>
    <div class="lineGroup"> <label for="venue_contact_name" class="sublabel" > Main Contact:</label>
  <input id="venue_contact_name" name="venue_contact_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_contact_name"):"")); ?>" class="formTextfield_Medium" tabindex="11" title="Please enter a value.">
    </div> 
 </div> 
 <div class="full_width">
    <div class="lineGroup"> <h3 for="venue_about" class="sublabel" > About:</h3><div style="display:inline-block"><?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_about",false):""))  ."";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "Full";
$CKEditor_config["wa_preset_file"] = "Full.xml";
$CKEditor_config["width"] = "514px";
$CKEditor_config["height"] = "350px";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 4;
$CKEditor_config["toolbar"] = array(
array( 'Cut','Copy','Paste','SpellCheck'),
array( 'Undo','Redo'),
array( 'Bold','Italic','Underline','Subscript','Superscript'),
array( 'NumberedList','BulletedList','-','Outdent','Indent'),
array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'Link','Unlink','Anchor'),
array( 'Table','Rule','SpecialChar'),
array( 'FontName','FontSize'),
array( 'TextColor','BGColor'));
$CKEditor_config["contentsLangDirection"] = "ltr";
$CKEditor_config["entities"] = false;
$CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
$CKEditor_config["pasteFromWordRemoveStyles"] = false;
$CKEditor->editor("venue_about", $CKEditor_initialValue, $CKEditor_config);
?></div>
    </div> 
</div>
<div class="full_width">
    <div class="lineGroup"> <label for="venue_outriders" class="sublabel" > Outriders:</label>
  <input id="venue_outriders" name="venue_outriders" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_outriders"):"")); ?>" class="formTextfield_Small" tabindex="12" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_player_capacity" class="sublabel" > Player Capacity:</label>
  <input id="venue_player_capacity" name="venue_player_capacity" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_player_capacity"):"")); ?>" class="formTextfield_Small" tabindex="13" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_map_URL" class="sublabel" > Google Map URL:</label>
  <input id="venue_map_URL" name="venue_map_URL" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueinsert","venue_map_URL"):"")); ?>" class="formTextfield_XLarge" tabindex="14" title="Please enter a value.">
    </div> 
</div>
        <span class="buttonFieldGroup" >
          <input type="submit" value="Save" class="formButton Modular" id="Insert" name="Insert" />
        </span>
        </fieldset>
</form></div><div id="Insert_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Default', 'Insert_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Insert_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../webassist/forms/wa_clientvalidation.js" type="text/javascript"></script>
<script src="../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Insert_Basic_Default_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Modular",
    pointedAt: "right",
    fieldOffset: 0,
    fieldMargin: 0,
    position: "left",
    direction: "right",
    border: 1,
    offset: 20,
    closeText: "✖",
    percentWidth: 100,
    orientation: "bottom"
  };
function Insert_Basic_Default_Validate() {
    $("#Insert_Basic_Default").h5Validate(Insert_Basic_Default_Opts);
  }
$(document).ready(function () {
  Insert_Basic_Default_Validate()
  ConvertServerErrors(Insert_Basic_Default_Opts);
});
</script>

		<?php include '../includes/parts/container-bottom.php'; ?>
	<?php include '../includes/parts/footer.php'; ?>
<?php
mysql_free_result($WADAMenuvenue_state);
?>
