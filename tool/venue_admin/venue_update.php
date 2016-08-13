<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_venueupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateZC((isset($_POST["venue_zip_cc_code"])?$_POST["venue_zip_cc_code"]:"") . "",true,false,false,false,false,1);
  $WAFV_Errors .= WAValidatePN((isset($_POST["venue_phone"])?$_POST["venue_phone"]:"") . "",false,true,false,2);
  $WAFV_Errors .= WAValidatePN((isset($_POST["venue_fax"])?$_POST["venue_fax"]:"") . "",false,true,false,3);
  $WAFV_Errors .= WAValidateEM((isset($_POST["venue_email"])?$_POST["venue_email"]:"") . "",false,4);
  $WAFV_Errors .= WAValidateUR((isset($_POST["venue_website"])?$_POST["venue_website"]:"") . "","http://",false,5);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"venueupdate");
   }
 }
 ?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
$Paramvenue_id_WADAvenue = "-1";
if (isset($_GET['venue_id'])) {
  $Paramvenue_id_WADAvenue = $_GET['venue_id'];
}
mysql_select_db($database_local_local, $local_local);
$query_WADAvenue = sprintf("SELECT venue_id, venue_Name, venue_logo_icon, venue_Street_Address, venue_city, venue_state, venue_zip_cc_code, venue_phone, venue_fax, venue_email, venue_website, venue_contact_name, venue_notes, venue_outriders, venue_player_capacity, venue_map_URL FROM venue WHERE venue_id = %s", GetSQLValueString($Paramvenue_id_WADAvenue, "int"));
$WADAvenue = mysql_query($query_WADAvenue, $local_local) or die(mysql_error());
$row_WADAvenue = mysql_fetch_assoc($WADAvenue);
$totalRows_WADAvenue = mysql_num_rows($WADAvenue);
?>
<?php
mysql_select_db($database_local_local, $local_local);
$query_WADAMenuvenue_state = "SELECT state_abbr FROM tbl_state ORDER BY state_abbr ASC";
$WADAMenuvenue_state = mysql_query($query_WADAMenuvenue_state, $local_local) or die(mysql_error());
$row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state);
$totalRows_WADAMenuvenue_state = mysql_num_rows($WADAMenuvenue_state);
?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../uploads/venue",
	'FileName' => "[FileName]",
	'DefaultFileName' => "".($row_WADAvenue["venue_logo_icon"])  ."",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(isset($_POST["Update"]) || isset($_POST["Update_x"])){
	WA_DFP_UploadFiles("WA_UploadResult1", "venue_logo_icon", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "venue";
  $WA_redirectURL = "venue_detail.php?venue_id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAvenue"])?"&pageNum_WADAvenue=".intval($_GET["pageNum_WADAvenue"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "venue_id";
  $WA_fieldNamesStr = "venue_Name|venue_logo_icon|venue_Street_Address|venue_city|venue_state|venue_zip_cc_code|venue_phone|venue_fax|venue_email|venue_website|venue_contact_name|venue_notes|venue_outriders|venue_player_capacity|venue_map_URL";
  $WA_fieldValuesStr = "".((isset($_POST["venue_Name"]))?$_POST["venue_Name"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["venue_Street_Address"]))?$_POST["venue_Street_Address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_city"]))?$_POST["venue_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_state"]))?$_POST["venue_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_zip_cc_code"]))?$_POST["venue_zip_cc_code"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_phone"]))?$_POST["venue_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_fax"]))?$_POST["venue_fax"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_email"]))?$_POST["venue_email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_website"]))?$_POST["venue_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_contact_name"]))?$_POST["venue_contact_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_notes"]))?$_POST["venue_notes"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_outriders"]))?$_POST["venue_outriders"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_player_capacity"]))?$_POST["venue_player_capacity"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venue_map_URL"]))?$_POST["venue_map_URL"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE ";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  
  $WA_where_fieldValuesStr = "".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."";
  $WA_where_columnTypesStr = "',none,''";
  $WA_where_comparisonStr = "=";
  $WA_where_fieldNames = explode("|", $WA_indexField);
  $WA_where_fieldValues = explode($WA_AB_Split, $WA_where_fieldValuesStr);
  $WA_where_columns = explode("|", $WA_where_columnTypesStr);
  $WA_where_comparisons = explode("|", $WA_where_comparisonStr);
  
  $WA_connectionDB = $database_local_local;
  mysql_select_db($WA_connectionDB, $WA_connection);
  @session_start();
  $updateParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WhereObj = WA_AB_generateWhereClause($WA_where_fieldNames, $WA_where_columns, $WA_where_fieldValues,  $WA_where_comparisons );
  $WA_Sql = "UPDATE `" . $WA_table . "` SET " . $updateParamsObj->WA_setValues . " WHERE " . $WhereObj->sqlWhereClause . "";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  if ($WA_redirectURL != "")  {
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../webassist/jq_validation/Modular.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="file:///C|/xampp/htdocs/tourneyTool/webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Update_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data"  class="Basic_Default" id="Update_Basic_Default" name="Update_Basic_Default" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Default" id="Update">
          <legend class="groupHeader">Update</legend>
    <div class="lineGroup"> <label for="venue_Name" class="sublabel" > Name:</label>
  <input id="venue_Name" name="venue_Name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_Name"):"".$row_WADAvenue["venue_Name"]."")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_logo_icon" class="sublabel" > Logo/Icon:</label>
  <input name="venue_logo_icon" type="file" id="venue_logo_icon" size="30" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_Street_Address" class="sublabel" > Street Address:</label>
  <input id="venue_Street_Address" name="venue_Street_Address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_Street_Address"):"".$row_WADAvenue["venue_Street_Address"]."")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_city" class="sublabel" > City:</label>
  <input id="venue_city" name="venue_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_city"):"".$row_WADAvenue["venue_city"]."")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_state" class="sublabel" > State:</label>
      <select class="formMenufield_Small" name="venue_state" id="venue_state" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_state"):"".$row_WADAvenue["venue_state"]."")); ?>" tabindex="5" title="Please enter a value.">
<option value="">Choose State...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuvenue_state['state_abbr']?>"<?php if (!(strcmp($row_WADAMenuvenue_state['state_abbr'], (isset($_GET["invalid"])?ValidatedField("venueupdate","venue_state"):"".$row_WADAvenue["venue_state"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuvenue_state['state_abbr']?></option>
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
  <input id="venue_zip_cc_code" name="venue_zip_cc_code" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_zip_cc_code"):"".$row_WADAvenue["venue_zip_cc_code"]."")); ?>" class="formTextfield_Medium" tabindex="6" pattern="(\d{5}([\-]\d{4})?)" title="Please enter a value.">
	   <?php
if (ValidatedField('venueupdate','venueupdate'))  {
  if ((strpos((",".ValidatedField("venueupdate","venueupdate").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="venue_zip_cc_code_ServerError">Please enter a value.</span><?php //WAFV_Conditional venue_update.php venueupdate(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="venue_phone" class="sublabel" > Phone:</label>
  <input id="venue_phone" name="venue_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_phone"):"".$row_WADAvenue["venue_phone"]."")); ?>" class="formTextfield_Medium" tabindex="7" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Update_Basic_Default').venue_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Update_Basic_Default').venue_phone,0,true);">
	   <?php
if (ValidatedField('venueupdate','venueupdate'))  {
  if ((strpos((",".ValidatedField("venueupdate","venueupdate").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="venue_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional venue_update.php venueupdate(2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="venue_fax" class="sublabel" > Ffax:</label>
  <input id="venue_fax" name="venue_fax" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_fax"):"".$row_WADAvenue["venue_fax"]."")); ?>" class="formTextfield_Medium" tabindex="8" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Update_Basic_Default').venue_fax,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Update_Basic_Default').venue_fax,0,true);">
	   <?php
if (ValidatedField('venueupdate','venueupdate'))  {
  if ((strpos((",".ValidatedField("venueupdate","venueupdate").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="venue_fax_ServerError">Please enter a value.</span><?php //WAFV_Conditional venue_update.php venueupdate(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="venue_email" class="sublabel" > Email:</label>
  <input id="venue_email" name="venue_email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_email"):"".$row_WADAvenue["venue_email"]."")); ?>" class="formTextfield_Medium" tabindex="9" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value.">
	   <?php
if (ValidatedField('venueupdate','venueupdate'))  {
  if ((strpos((",".ValidatedField("venueupdate","venueupdate").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="venue_email_ServerError">Please enter a value.</span><?php //WAFV_Conditional venue_update.php venueupdate(4:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="venue_website" class="sublabel" > Website:</label>
  <input id="venue_website" name="venue_website" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_website"):"".$row_WADAvenue["venue_website"]."")); ?>" class="formTextfield_Medium" tabindex="10" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('venueupdate','venueupdate'))  {
  if ((strpos((",".ValidatedField("venueupdate","venueupdate").","), "," . "5" . ",") !== false || "5" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="venue_website_ServerError">Please enter a value.</span><?php //WAFV_Conditional venue_update.php venueupdate(5:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="venue_contact_name" class="sublabel" > Main Contact Name:</label>
  <input id="venue_contact_name" name="venue_contact_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_contact_name"):"".$row_WADAvenue["venue_contact_name"]."")); ?>" class="formTextfield_Medium" tabindex="11" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_notes" class="sublabel" > venue_notes:</label>
  <textarea name="venue_notes" id="venue_notes" class="formTextarea_Large" rows="1" cols="1" tabindex="12" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_notes"):"".$row_WADAvenue["venue_notes"]."")); ?></textarea>
    </div> 
    <div class="lineGroup"> <label for="venue_outriders" class="sublabel" > Outriders:</label>
  <input id="venue_outriders" name="venue_outriders" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_outriders"):"".$row_WADAvenue["venue_outriders"]."")); ?>" class="formTextfield_Medium" tabindex="13" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_player_capacity" class="sublabel" > Max Number of Players:</label>
  <input id="venue_player_capacity" name="venue_player_capacity" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_player_capacity"):"".$row_WADAvenue["venue_player_capacity"]."")); ?>" class="formTextfield_Small" tabindex="14" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_map_URL" class="sublabel" > Google Map URL:</label>
  <textarea name="venue_map_URL" id="venue_map_URL" class="formTextarea_Small" rows="1" cols="1" tabindex="15" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","venue_map_URL"):"".$row_WADAvenue["venue_map_URL"]."")); ?></textarea>
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Update" class="" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("venueupdate","WADAUpdateRecordID"):$_GET["venue_id"])); ?>" />
</form></div><div id="Update_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Default', 'Update_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Update_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../webassist/forms/wa_clientvalidation.js" type="text/javascript"></script>
<script src="../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Update_Basic_Default_Opts = {
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
function Update_Basic_Default_Validate() {
    $("#Update_Basic_Default").h5Validate(Update_Basic_Default_Opts);
  }
$(document).ready(function () {
  Update_Basic_Default_Validate()
  ConvertServerErrors(Update_Basic_Default_Opts);
});
</script>

</body>
</html>
<?php
mysql_free_result($WADAvenue);
?>
<?php
mysql_free_result($WADAMenuvenue_state);
?>
