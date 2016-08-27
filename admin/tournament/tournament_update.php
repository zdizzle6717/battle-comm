<?php require_once("../../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_tournamentupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["tournament_name"])?$_POST["tournament_name"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateDT((isset($_POST["tournament_startDate"])?$_POST["tournament_startDate"]:"") . "",true,"","","",false,"","","",false,2);
  $WAFV_Errors .= WAValidateDT((isset($_POST["Tournament_endDate"])?$_POST["Tournament_endDate"]:"") . "",true,"","","",false,"","","",false,3);
  $WAFV_Errors .= WAValidateZC((isset($_POST["tournament_zip"])?$_POST["tournament_zip"]:"") . "",true,false,false,false,false,4);
  $WAFV_Errors .= WAValidatePN((isset($_POST["tournament_phone"])?$_POST["tournament_phone"]:"") . "",false,true,false,5);
  $WAFV_Errors .= WAValidateEM((isset($_POST["tournament_email"])?$_POST["tournament_email"]:"") . "",true,6);
  $WAFV_Errors .= WAValidateUR((isset($_POST["tournament_URL"])?$_POST["tournament_URL"]:"") . "","http://",false,7);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"tournamentupdate");
   }
 }
 ?>
<?php require_once("../../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
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
$Paramtournament_id_WADAtournament = "-1";
if (isset($_GET['tournament_id'])) {
  $Paramtournament_id_WADAtournament = $_GET['tournament_id'];
}
mysql_select_db($database_local, $local);
$query_WADAtournament = sprintf("SELECT tournament_id, tournament_name, tournament_startDate, tournament_startTime, Tournament_endDate, Tournament_endTime, tournament_store_location, tournament_add_new_location, `tournament_location _name`, tournament_logo_icon, tournament_address, tournament_city, tournament_state, tournament_zip, tournament_phone, tournament_email, tournament_URL, tournament_admin_id, tournament_admin_name, tournament_info, tournament_notes, tournament_rounds, factions_cap, No_of_Games, game_id, game_title, WinPointValue, DrawPointValue, LossPointValue FROM tournament WHERE tournament_id = %s", GetSQLValueString($Paramtournament_id_WADAtournament, "int"));
$WADAtournament = mysql_query($query_WADAtournament, $local) or die(mysql_error());
$row_WADAtournament = mysql_fetch_assoc($WADAtournament);
$totalRows_WADAtournament = mysql_num_rows($WADAtournament);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenutournament_state = "SELECT state_abbr FROM tbl_state ORDER BY state_abbr ASC";
$WADAMenutournament_state = mysql_query($query_WADAMenutournament_state, $local) or die(mysql_error());
$row_WADAMenutournament_state = mysql_fetch_assoc($WADAMenutournament_state);
$totalRows_WADAMenutournament_state = mysql_num_rows($WADAMenutournament_state);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenugame_id = "SELECT game_system_Title, game_system_id FROM game_system ORDER BY game_system_Title ASC";
$WADAMenugame_id = mysql_query($query_WADAMenugame_id, $local) or die(mysql_error());
$row_WADAMenugame_id = mysql_fetch_assoc($WADAMenugame_id);
$totalRows_WADAMenugame_id = mysql_num_rows($WADAMenugame_id);
?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../../",
	'FileName' => "[FileName]",
	'DefaultFileName' => "".($row_WADAtournament["tournament_logo_icon"])  ."",
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
	WA_DFP_UploadFiles("WA_UploadResult1", "tournament_logo_icon", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "tournament";
  $WA_redirectURL = "tournament_detail.php?tournament_id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAtournament"])?"&pageNum_WADAtournament=".intval($_GET["pageNum_WADAtournament"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "tournament_id";
  $WA_fieldNamesStr = "tournament_name|tournament_startDate|tournament_startTime|Tournament_endDate|Tournament_endTime|tournament_store_location|tournament_add_new_location|tournament_location _name|tournament_logo_icon|tournament_address|tournament_city|tournament_state|tournament_zip|tournament_phone|tournament_email|tournament_URL|tournament_admin_id|tournament_admin_name|tournament_info|tournament_notes|tournament_rounds|factions_cap|No_of_Games|game_id|game_title|WinPointValue|DrawPointValue|LossPointValue";
  $WA_fieldValuesStr = "".((isset($_POST["tournament_name"]))?$_POST["tournament_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_startDate"]) && $_POST["tournament_startDate"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["tournament_startDate"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_startTime"]))?$_POST["tournament_startTime"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["Tournament_endDate"]) && $_POST["Tournament_endDate"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["Tournament_endDate"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["Tournament_endTime"]))?$_POST["Tournament_endTime"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_store_location"]))?$_POST["tournament_store_location"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_add_new_location"]))?$_POST["tournament_add_new_location"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_location _name"]))?$_POST["tournament_location _name"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["tournament_address"]))?$_POST["tournament_address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_city"]))?$_POST["tournament_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_state"]))?$_POST["tournament_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_zip"]))?$_POST["tournament_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_phone"]))?$_POST["tournament_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_email"]))?$_POST["tournament_email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_URL"]))?$_POST["tournament_URL"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_admin_id"]))?$_POST["tournament_admin_id"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_admin_name"]))?$_POST["tournament_admin_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_info"]))?$_POST["tournament_info"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_notes"]))?$_POST["tournament_notes"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_rounds"]))?$_POST["tournament_rounds"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["factions_cap"]))?$_POST["factions_cap"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["No_of_Games"]))?$_POST["No_of_Games"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_id"]))?$_POST["game_id"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_title"]))?$_POST["game_title"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["WinPointValue"]))?$_POST["WinPointValue"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["DrawPointValue"]))?$_POST["DrawPointValue"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["LossPointValue"]))?$_POST["LossPointValue"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,NULL|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | = | LIKE | = | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE ";
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
  
  $WA_connectionDB = $database_local;
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
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../webassist/forms/fd_basic_defaultmod.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../webassist/jq_validation/Inspiration.css">
<link type="text/css" href="../../webassist/forms/fd_basic_defaultmod/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
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
</script><link type="text/css" href="../../webassist/forms/fd_basic_defaultmod/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="file:///C|/xampp/htdocs/testBC/webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Update_Basic_Defaultmod_ProgressWrapper">
<form enctype="multipart/form-data"  class="Basic_Defaultmod" id="Update_Basic_Defaultmod" name="Update_Basic_Defaultmod" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Defaultmod" id="Update">
          <legend class="groupHeader">Update</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
    <div class="lineGroup"> <label for="tournament_name" class="sublabel" > Name:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="tournament_name" name="tournament_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_name"):"".$row_WADAtournament["tournament_name"]."")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('tournamentupdate','tournamentupdate'))  {
  if ((strpos((",".ValidatedField("tournamentupdate","tournamentupdate").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="tournament_name_ServerError">Please enter a value.</span><?php //WAFV_Conditional tournament_update.php tournamentupdate(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="tournament_startDate" class="sublabel" > Start Date:</label>
  <input id="tournament_startDate" name="tournament_startDate" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_startDate"):"".(($row_WADAtournament["tournament_startDate"])?date("n/d/Y",strtotime($row_WADAtournament["tournament_startDate"])):"")."")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
	   <?php
if (ValidatedField('tournamentupdate','tournamentupdate'))  {
  if ((strpos((",".ValidatedField("tournamentupdate","tournamentupdate").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="tournament_startDate_ServerError">Please enter a value.</span><?php //WAFV_Conditional tournament_update.php tournamentupdate(2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="tournament_startTime" class="sublabel" > Time:</label>
  <input id="tournament_startTime" name="tournament_startTime" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_startTime"):"".(($row_WADAtournament["tournament_startTime"])?date("g:i A",strtotime($row_WADAtournament["tournament_startTime"])):"")."")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="Tournament_endDate" class="sublabel" > End Date:</label>
  <input id="Tournament_endDate" name="Tournament_endDate" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","Tournament_endDate"):"".(($row_WADAtournament["Tournament_endDate"])?date("n/d/Y",strtotime($row_WADAtournament["Tournament_endDate"])):"")."")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
	   <?php
if (ValidatedField('tournamentupdate','tournamentupdate'))  {
  if ((strpos((",".ValidatedField("tournamentupdate","tournamentupdate").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="Tournament_endDate_ServerError">Please enter a value.</span><?php //WAFV_Conditional tournament_update.php tournamentupdate(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="Tournament_endTime" class="sublabel" > End Time:</label>
  <input id="Tournament_endTime" name="Tournament_endTime" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","Tournament_endTime"):"".(($row_WADAtournament["Tournament_endTime"])?date("g:i A",strtotime($row_WADAtournament["Tournament_endTime"])):"")."")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="tournament_location _name" class="sublabel" > Location Name: :</label>
  <input id="tournament_location _name" name="tournament_location _name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_location _name"):"".$row_WADAtournament["tournament_location _name"]."")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="tournament_logo_icon" class="sublabel" > Logo/Icon:</label>
  <input name="tournament_logo_icon" type="file" id="tournament_logo_icon" size="30" tabindex="7" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="tournament_address" class="sublabel" > Address:</label>
  <input id="tournament_address" name="tournament_address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_address"):"".$row_WADAtournament["tournament_address"]."")); ?>" class="formTextfield_Large" tabindex="8" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="tournament_city" class="sublabel" > City:</label>
  <input id="tournament_city" name="tournament_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_city"):"".$row_WADAtournament["tournament_city"]."")); ?>" class="formTextfield_Medium" tabindex="9" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="tournament_state" class="sublabel" > State:</label>
      <select class="formMenufield_Small" name="tournament_state" id="tournament_state" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_state"):"".$row_WADAtournament["tournament_state"]."")); ?>" tabindex="10" title="Please enter a value.">
<option value="">Choose State...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenutournament_state['state_abbr']?>"<?php if (!(strcmp($row_WADAMenutournament_state['state_abbr'], (isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_state"):"".$row_WADAtournament["tournament_state"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenutournament_state['state_abbr']?></option>
        <?php
} while ($row_WADAMenutournament_state = mysql_fetch_assoc($WADAMenutournament_state));
  $rows = mysql_num_rows($WADAMenutournament_state);
  if($rows > 0) {
      mysql_data_seek($WADAMenutournament_state, 0);
	  $row_WADAMenutournament_state = mysql_fetch_assoc($WADAMenutournament_state);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="tournament_zip" class="sublabel" > Zip:</label>
  <input id="tournament_zip" name="tournament_zip" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_zip"):"".$row_WADAtournament["tournament_zip"]."")); ?>" class="formTextfield_Medium" tabindex="11" pattern="(\d{5}([\-]\d{4})?)" title="Please enter a value.">
	   <?php
if (ValidatedField('tournamentupdate','tournamentupdate'))  {
  if ((strpos((",".ValidatedField("tournamentupdate","tournamentupdate").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="tournament_zip_ServerError">Please enter a value.</span><?php //WAFV_Conditional tournament_update.php tournamentupdate(4:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="tournament_phone" class="sublabel" > Phone:</label>
  <input id="tournament_phone" name="tournament_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_phone"):"".$row_WADAtournament["tournament_phone"]."")); ?>" class="formTextfield_Medium" tabindex="12" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Update_Basic_Defaultmod').tournament_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Update_Basic_Defaultmod').tournament_phone,0,true);">
	   <?php
if (ValidatedField('tournamentupdate','tournamentupdate'))  {
  if ((strpos((",".ValidatedField("tournamentupdate","tournamentupdate").","), "," . "5" . ",") !== false || "5" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="tournament_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional tournament_update.php tournamentupdate(5:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="tournament_email" class="sublabel" > Email:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="tournament_email" name="tournament_email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_email"):"".$row_WADAtournament["tournament_email"]."")); ?>" class="formTextfield_Medium" tabindex="13" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('tournamentupdate','tournamentupdate'))  {
  if ((strpos((",".ValidatedField("tournamentupdate","tournamentupdate").","), "," . "6" . ",") !== false || "6" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="tournament_email_ServerError">Please enter a value.</span><?php //WAFV_Conditional tournament_update.php tournamentupdate(6:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="tournament_URL" class="sublabel" > URL:</label>
  <input id="tournament_URL" name="tournament_URL" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_URL"):"".$row_WADAtournament["tournament_URL"]."")); ?>" class="formTextfield_Medium" tabindex="14" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('tournamentupdate','tournamentupdate'))  {
  if ((strpos((",".ValidatedField("tournamentupdate","tournamentupdate").","), "," . "7" . ",") !== false || "7" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="tournament_URL_ServerError">Please enter a value.</span><?php //WAFV_Conditional tournament_update.php tournamentupdate(7:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="tournament_admin_name" class="sublabel" > Tournament Admin Name:</label>
  <input id="tournament_admin_name" name="tournament_admin_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_admin_name"):"".$row_WADAtournament["tournament_admin_name"]."")); ?>" class="formTextfield_Medium" tabindex="15" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="tournament_info" class="sublabel" > Tournament Information:</label><div style="display:inline-block"><?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_info",false):"".$row_WADAtournament["tournament_info"].""))  ."";
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
$CKEditor->editor("tournament_info", $CKEditor_initialValue, $CKEditor_config);
?></div>
    </div> 
    <div class="lineGroup"> <label for="tournament_notes" class="sublabel" > Notes:</label>
  <textarea name="tournament_notes" id="tournament_notes" class="formTextarea_Large" rows="1" cols="1" tabindex="16" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_notes"):"".$row_WADAtournament["tournament_notes"]."")); ?></textarea>
    </div> 
    <div class="lineGroup"> <label for="tournament_rounds" class="sublabel" > Tournament Rounds:</label>
  <input id="tournament_rounds" name="tournament_rounds" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_rounds"):"".$row_WADAtournament["tournament_rounds"]."")); ?>" class="formTextfield_Medium" tabindex="17" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="factions_cap" class="sublabel" > Factions Cap:</label>
  <input id="factions_cap" name="factions_cap" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","factions_cap"):"".$row_WADAtournament["factions_cap"]."")); ?>" class="formTextfield_Small" tabindex="18" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="No_of_Games" class="sublabel" > Number of Concurrent Games Per Round:</label>
  <input id="No_of_Games" name="No_of_Games" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","No_of_Games"):"".$row_WADAtournament["No_of_Games"]."")); ?>" class="formTextfield_Small" tabindex="19" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_id" class="sublabel" > Game:</label>
      <select class="formMenufield_Medium" name="game_id" id="game_id" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","game_id"):"".$row_WADAtournament["game_id"]."")); ?>" tabindex="20" title="Please enter a value.">
<option value="">Choose Game</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenugame_id['game_system_id']?>"<?php if (!(strcmp($row_WADAMenugame_id['game_system_id'], (isset($_GET["invalid"])?ValidatedField("tournamentupdate","game_id"):"".$row_WADAtournament["game_id"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugame_id['game_system_Title']?></option>
        <?php
} while ($row_WADAMenugame_id = mysql_fetch_assoc($WADAMenugame_id));
  $rows = mysql_num_rows($WADAMenugame_id);
  if($rows > 0) {
      mysql_data_seek($WADAMenugame_id, 0);
	  $row_WADAMenugame_id = mysql_fetch_assoc($WADAMenugame_id);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="WinPointValue" class="sublabel" > Win Point Value:</label>
  <input id="WinPointValue" name="WinPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","WinPointValue"):"".$row_WADAtournament["WinPointValue"]."")); ?>" class="formTextfield_Medium" tabindex="21" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="DrawPointValue" class="sublabel" > Draw Point Value:</label>
  <input id="DrawPointValue" name="DrawPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","DrawPointValue"):"".$row_WADAtournament["DrawPointValue"]."")); ?>" class="formTextfield_Medium" tabindex="22" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="LossPointValue" class="sublabel" > Loss Point Value:</label>
  <input id="LossPointValue" name="LossPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","LossPointValue"):"".$row_WADAtournament["LossPointValue"]."")); ?>" class="formTextfield_Medium" tabindex="23" title="Please enter a value.">
    </div> 
        <span class="buttonFieldGroup" >
  <input id="tournament_store_location" name="tournament_store_location" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_store_location"):"".$row_WADAtournament["tournament_store_location"]."")); ?>">
  <input id="tournament_add_new_location" name="tournament_add_new_location" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_add_new_location"):"".$row_WADAtournament["tournament_add_new_location"]."")); ?>">
  <input id="tournament_admin_id" name="tournament_admin_id" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","tournament_admin_id"):"".$row_WADAtournament["tournament_admin_id"]."")); ?>">
  <input id="game_title" name="game_title" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","game_title"):"".$row_WADAtournament["game_title"]."")); ?>">
<input type="submit" value="Update" class="formButton Spacious" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentupdate","WADAUpdateRecordID"):$_GET["tournament_id"])); ?>" />
</form></div><div id="Update_Basic_Defaultmod_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Defaultmod', 'Update_Basic_Defaultmod_ProgressMessageWrapper', WADFP_Theme_Options['Bar:Nautica']);
</script>
<div id="Update_Basic_Defaultmod_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/nautica-bar.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../webassist/forms/wa_clientvalidation.js" type="text/javascript"></script>
<script src="../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Update_Basic_Defaultmod_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Inspiration",
    pointedAt: "right",
    fieldOffset: -2,
    fieldMargin: 0,
    position: "left",
    direction: "center",
    border: 1,
    offset: 5,
    closeText: "✖",
    percentWidth: 100,
    orientation: "bottom"
  };
function Update_Basic_Defaultmod_Validate() {
    $("#Update_Basic_Defaultmod").h5Validate(Update_Basic_Defaultmod_Opts);
  }
$(document).ready(function () {
  Update_Basic_Defaultmod_Validate()
  ConvertServerErrors(Update_Basic_Defaultmod_Opts);
});
</script>

</body>
</html>
<?php
mysql_free_result($WADAtournament);
?>
<?php
mysql_free_result($WADAMenutournament_state);
?>
<?php
mysql_free_result($WADAMenugame_id);
?>
