<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once('../../Connections/local.php'); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_tournamentinsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["tournament_name"])?$_POST["tournament_name"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local_local"),$local_local,$database_local_local,"tournament","tournament_id","none,none,NULL","0","tournament_name","',none,''","".((isset($_POST["tournament_name"]))?$_POST["tournament_name"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateDT((isset($_POST["tournament_startDate"])?$_POST["tournament_startDate"]:"") . "",true,"","","",false,"","","",false,3);
  $WAFV_Errors .= WAValidateDT((isset($_POST["Tournament_endDate"])?$_POST["Tournament_endDate"]:"") . "",true,"","","",false,"","","",false,4);
  $WAFV_Errors .= WAValidateZC((isset($_POST["tournament_zip"])?$_POST["tournament_zip"]:"") . "",true,false,false,false,false,5);
  $WAFV_Errors .= WAValidatePN((isset($_POST["tournament_phone"])?$_POST["tournament_phone"]:"") . "",false,true,false,6);
  $WAFV_Errors .= WAValidateEM((isset($_POST["tournament_email"])?$_POST["tournament_email"]:"") . "",true,7);
  $WAFV_Errors .= WAValidateUR((isset($_POST["tournament_URL"])?$_POST["tournament_URL"]:"") . "","http://",false,8);
  $WAFV_Errors .= WAValidateNM((isset($_POST["tournament_rounds"])?$_POST["tournament_rounds"]:"") . "",1,100,0,",.",false,9);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"tournamentinsert");
   }
 }
 ?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php require_once( "../../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("tourneyAdmin")){
	WA_Auth_RestrictAccess("../../accessdenied.php");
}

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
	'UploadFolder' => "../uploads/tournament/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1_2 Start
$WA_UploadResult1_Params["WA_UploadResult1_2"] = array(
	'UploadFolder' => "../uploads/tournament/thumbs/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "2",
	'ResizeWidth' => "120",
	'ResizeHeight' => "120",
	'ResizeFillColor' => "#FFFFFF" );
// WA_UploadResult1_2 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(isset($_POST["Insert"]) || isset($_POST["Insert_x"])){
	WA_DFP_UploadFiles("WA_UploadResult1", "tournament_logo_icon", "2", "[ExistingFileName]_[Increment]", "true", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "tournament";
  $WA_sessionName = "WADA_Insert_tournament";
  $WA_redirectURL = "../index.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "tournament_name|tournament_startDate|tournament_startTime|Tournament_endDate|Tournament_endTime|tournament_store_location|tournament_logo_icon|tournament_address|tournament_city|tournament_state|tournament_zip|tournament_phone|tournament_email|tournament_URL|tournament_admin_id|tournament_info|tournament_rounds|factions_cap|No_of_Games|game_id|game_title|WinPointValue|DrawPointValue|LossPointValue|tournament_owner";
  $WA_fieldValuesStr = "".((isset($_POST["tournament_name"]))?$_POST["tournament_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_startDate"]) && $_POST["tournament_startDate"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["tournament_startDate"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_startTime"]))?$_POST["tournament_startTime"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["Tournament_endDate"]) && $_POST["Tournament_endDate"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["Tournament_endDate"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["Tournament_endTime"]))?$_POST["Tournament_endTime"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_store_location"]))?$_POST["tournament_store_location"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["tournament_address"]))?$_POST["tournament_address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_city"]))?$_POST["tournament_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_state"]))?$_POST["tournament_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_zip"]))?$_POST["tournament_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_phone"]))?$_POST["tournament_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_email"]))?$_POST["tournament_email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_URL"]))?$_POST["tournament_URL"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_admin_id"]))?$_POST["tournament_admin_id"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_info"]))?$_POST["tournament_info"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_rounds"]))?$_POST["tournament_rounds"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["factions_cap"]))?$_POST["factions_cap"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["No_of_Games"]))?$_POST["No_of_Games"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_id"]))?$_POST["game_id"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_title"]))?$_POST["game_title"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["WinPointValue"]))?$_POST["WinPointValue"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["DrawPointValue"]))?$_POST["DrawPointValue"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["LossPointValue"]))?$_POST["LossPointValue"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournament_admin_id"]))?$_POST["tournament_admin_id"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,NULL|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|none,none,NULL|none,none,NULL|none,none,NULL|none,none,NULL";
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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Battlecomm: Create Tournament</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/magnificent-popup/magnificent-popup.css">
    <link href="../admin_temp.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
    <script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../webassist/jq_validation/Modular.css">
    <link type="text/css" href="../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet">
    <link href="../../Styles/form_clean.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../Scripts/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="../../Scripts/mobile-toggle.js"></script>
    <script type="text/javascript" src="../../Scripts/backtotop.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  </script>
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
</script><link type="text/css" href="../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
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
<style>

form.DetailsPage {
    width: auto;	
}
.WADAResults, .WADANoResults {
  border-top-width: 1px;
  border-top-style: solid;
  border-top-color: #BABDC2;
}
.WADAResultsNavigation {
  padding-top: 5px;
  padding-bottom: 10px;
}
.WADAResultsCount {
  font-size: 11px;
}
.WADAResultsNavTop, .WADAResultsInsertButton {
  clear :none;
}
.WADAResultsNavTop, WADAResultsNavBottom {
  width: 60%;
  float: left;
}
div.WADAResultsInsertButton {
  width: 30%;
  float: right;
  text-align: right;
}
.WADAResultsNavButtonCell, .WADAResultsInsertButton {
  padding-top: 2px;
  padding-right: 2px;
  padding-bottom: 2px;
  padding-left: 2px;
}
.WADAResultsTable {
  font-size: 11px;
  clear: both;
  padding-top: 1px;
  padding-bottom: 1px;
}
.WADAResultsTableHeader {
  text-align: left;
  padding-left: 13px;
  padding-right: 13px;
}
.WADAResultsTableCell {
  text-align: left;
  padding-left: 14px;
  padding-right: 14px;
}
.WADAResultsEditButtons {
  text-align: right;
  border-right-width: 1px;
  border-right-style: solid;
  border-right-color: #BABDC2;
  border-left-width: 1px;
  border-left-style: solid;
  border-left-color: #BABDC2;
}

form .WADAResultsContainer input.formButton.ResultsNavButton {
  margin: 2px 0;
  padding: 2px;
  -moz-border-radius: 6px;
  -webkit-border-radius: 6px;
  -khtml-border-radius: 6px;
  border-radius: 6px;
  outline: 0;
}

form .WADAResultsContainer input.formButton.ResultsPageButton {
  margin: 2px;
  padding: 0;
  -moz-border-radius: 6px;
  -webkit-border-radius: 6px;
  -khtml-border-radius: 6px;
  border-radius: 6px;
  outline:0;
}

.WADAResultThumbArea {
	float:left;
}
.WADAResultInfoArea {
	margin-left: 170px;
}
.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}
.messageContainer {
	display: none;
	position: absolute;
	top:0;
	width: 100%;
	z-index:1002;
	text-align:center;
	height:100%;
	#position: relative;
	overflow: hidden;
}
.messageWrapper {
	#position: absolute; 
	#top: 50%;
	display: table-cell; 
	vertical-align: middle;	
}
.messageContent {
	background-color:white;
    display: inline-block;
	padding: 16px;
	border: 16px solid grey;
	z-index:1002;
	overflow: auto;
	margin: auto;
	#position: relative; 
	#top: -50%;
}
.WADAResultsTable th{
  color: #FFFFFF;
  background-color: #262626;
}
.WADAResultsTableWrapper {
  clear: left;
  border: 1px solid #262626;
}
.WADAResultsRowDark {
  color:table;
  background-color: #E5E5E5;
}

form.Basic_Default input.formButton.Dark.DetailButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../images/Icons/view_details_white.png), url(../webassist/forms/gradient.php?from=262626&to=3E3E3E);
	background-image:url(../images/Icons/view_details_white.png),  -moz-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/view_details_white.png),  -o-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/view_details_white.png),  -webkit-linear-gradient(#262626, #3E3E3E);
	
	background-image:url(../images/Icons/view_details_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #262626), color-stop(1, #3E3E3E));
	
	background-image:url(../images/Icons/view_details_white.png),  linear-gradient(top, #262626, #3E3E3E);
	filter:none;
}
form.Basic_Default input.formButton.Dark.DetailButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}


form.Basic_Default input.formButton.Dark.UpdateButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../images/Icons/edit_white.png), url(../webassist/forms/gradient.php?from=262626&to=3E3E3E);
	background-image:url(../images/Icons/edit_white.png),  -moz-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/edit_white.png),  -o-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/edit_white.png),  -webkit-linear-gradient(#262626, #3E3E3E);
	
	background-image:url(../images/Icons/edit_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #262626), color-stop(1, #3E3E3E));
	
	background-image:url(../images/Icons/edit_white.png),  linear-gradient(top, #262626, #3E3E3E);
	filter:none;
}
form.Basic_Default input.formButton.Dark.UpdateButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}


form.Basic_Default input.formButton.Dark.DeleteButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../images/Icons/delete_white.png), url(../webassist/forms/gradient.php?from=262626&to=3E3E3E);
	background-image:url(../images/Icons/delete_white.png),  -moz-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/delete_white.png),  -o-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/delete_white.png),  -webkit-linear-gradient(#262626, #3E3E3E);
	
	background-image:url(../images/Icons/delete_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #262626), color-stop(1, #3E3E3E));
	
	background-image:url(../images/Icons/delete_white.png),  linear-gradient(top, #262626, #3E3E3E);
	filter:none;
}
form.Basic_Default input.formButton.Dark.DeleteButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}

/* Details page CSS */
form.DetailsPage {
    width: auto;	
}

.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}
.messageContainer {
	display: none;
	position: absolute;
	top:0;
	width: 100%;
	z-index:1002;
	text-align:center;
	height:100%;
	#position: relative;
	overflow: hidden;
}
.messageWrapper {
	#position: absolute; 
	#top: 50%;
	display: table-cell; 
	vertical-align: middle;	
}
.messageContent {
	background-color:white;
    display: inline-block;
	padding: 16px;
	border: 16px solid grey;
	z-index:1002;
	overflow: auto;
	margin: auto;
	#position: relative; 
	#top: -50%;
}
</style>
<!--[if lte ie 8]>
<style>

form.Basic_Default input.formButton.Dark.DetailButton {
	background-image:url(../images/Icons/view_details_white.png);
	background-color:#262626
}
form.Basic_Default input.formButton.Dark:hover.DetailButton {
	}

form.Basic_Default input.formButton.Dark.UpdateButton {
	background-image:url(../images/Icons/edit_white.png);
	background-color:#262626
}
form.Basic_Default input.formButton.Dark:hover.UpdateButton {
	}

form.Basic_Default input.formButton.Dark.DeleteButton {
	background-image:url(../images/Icons/delete_white.png);
	background-color:#262626
}
form.Basic_Default input.formButton.Dark:hover.DeleteButton {
	}
</style>
<![endif]-->
<link type="text/css" href="../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet">
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
</script>
<link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>
	<?php include '../../Templates/parts/header.php'; ?>
		<?php include '../../Templates/parts/container-top.php'; ?>
        <div id="PlayerNav">
                <a href="/players/index.php">Player Home</a> | <a href="/players/mydashboard.php">My Dashboard</a> | 
                <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
                <a href="/clubsAdmin/index.php">Tournament Admin</a> |
                  <?php } // End Show Region ?>
                <a href="/players/user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Edit Account</a> |
                <a href="/players/editProfileA.php">Edit Profile (A)</a> |
                <?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
                  <a href="/admin/index.php"> System Administrator</a>
                  <?php } // End Show Region ?>
                 | 
                <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
                <a href="/clubsAdmin/index.php">Club Admin</a>
                <?php } // End Show Region ?>
            </div>
            <h2>Create/Update Tournament</h2>
<div id="Insert_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data"  class="clean" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
<ol>
  <li>
    <fieldset>
      <legend>Basic Info</legend>
		<ol>
         <span class="fieldsetDescription">
         Required *
         </span>
            <li> <label for="tournament_name" class="sublabel" > Tournament Name:<span class="requiredIndicator">&nbsp;*</span></label>
          <input id="tournament_name" name="tournament_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_name"):"")); ?>" class="formTextfield_XLarge" tabindex="1" title="Please enter a value." required>
               <?php
        if (ValidatedField('tournamentinsert','tournamentinsert'))  {
          if ((strpos((",".ValidatedField("tournamentinsert","tournamentinsert").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("tournamentinsert","tournamentinsert").","), "," . "2" . ",") !== false || "2" == ""))  {
            if (!(false))  {
        ?>
                 <span class="serverInvalidState" id="tournament_name_ServerError">Please enter a value.</span>
                 <?php //WAFV_Conditional tournament_insert.php tournamentinsert(1,2:)
            }
          }
        }?>
            </li> 
            <li> <label for="tournament_startDate" class="sublabel" > Start Date:</label>
          <input id="tournament_startDate" name="tournament_startDate" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_startDate"):"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
               <?php
        if (ValidatedField('tournamentinsert','tournamentinsert'))  {
          if ((strpos((",".ValidatedField("tournamentinsert","tournamentinsert").","), "," . "3" . ",") !== false || "3" == ""))  {
            if (!(false))  {
        ?>
                 <span class="serverInvalidState" id="tournament_startDate_ServerError">Please enter a value.</span>
                 <?php //WAFV_Conditional tournament_insert.php tournamentinsert(3:)
            }
          }
        }?>
            </li>
            <li> <label for="tournament_startTime" class="sublabel" > Start Time:</label>
          <input id="tournament_startTime" name="tournament_startTime" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_startTime"):"")); ?>" class="formTextfield_Small" tabindex="3" title="Please enter a value.">
            </li> 
            <li> <label for="Tournament_endDate" class="sublabel" > End Date:</label>
          <input id="Tournament_endDate" name="Tournament_endDate" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","Tournament_endDate"):"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
               <?php
        if (ValidatedField('tournamentinsert','tournamentinsert'))  {
          if ((strpos((",".ValidatedField("tournamentinsert","tournamentinsert").","), "," . "4" . ",") !== false || "4" == ""))  {
            if (!(false))  {
        ?>
                 <span class="serverInvalidState" id="Tournament_endDate_ServerError">Please enter a value.</span>
                 <?php //WAFV_Conditional tournament_insert.php tournamentinsert(4:)
            }
          }
        }?>
            </li> 
            <li> <label for="Tournament_endTime" class="sublabel" > End Time:</label>
          <input id="Tournament_endTime" name="Tournament_endTime" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","Tournament_endTime"):"")); ?>" class="formTextfield_Small" tabindex="5" title="Please enter a value.">
            </li> 
            <li> <label for="tournament_logo_icon" class="sublabel" > Upload Logo/Icon:</label>
          <input name="tournament_logo_icon" type="file" id="tournament_logo_icon" size="30" tabindex="6" title="Please enter a value.">
            </li> 
    </li>
  		</ol>
  	  </fieldset>
    <li>
    <fieldset>
      <legend>Location</legend>
		<ol>
            <li> <label for="tournament_location _name" class="sublabel" > Location Name:</label>
          <input id="tournament_location _name" name="tournament_location _name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_location _name"):"")); ?>" class="formTextfield_Large" tabindex="7" title="Please enter a value.">
            </li> 
            <li> <label for="tournament_address" class="sublabel" > Address:</label>
          <input id="tournament_address" name="tournament_address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_address"):"")); ?>" class="formTextfield_Large" tabindex="8" title="Please enter a value.">
            </li> 
            <li> <label for="tournament_city" class="sublabel" > City:</label>
          <input id="tournament_city" name="tournament_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_city"):"")); ?>" class="formTextfield_Medium" tabindex="9" title="Please enter a value.">
            </li> 
            <li> <label for="tournament_state" class="sublabel" > State:</label>
              <select class="formMenufield_Small" name="tournament_state" id="tournament_state" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_state"):"")); ?>" tabindex="10" title="Please enter a value.">
        <option value="">Choose State:</option>
        <?php
        do {  
        ?>
                <option value="<?php echo $row_WADAMenutournament_state['state_abbr']?>"<?php if (!(strcmp($row_WADAMenutournament_state['state_abbr'], (isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_state"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenutournament_state['state_abbr']?></option>
                <?php
        } while ($row_WADAMenutournament_state = mysql_fetch_assoc($WADAMenutournament_state));
          $rows = mysql_num_rows($WADAMenutournament_state);
          if($rows > 0) {
              mysql_data_seek($WADAMenutournament_state, 0);
              $row_WADAMenutournament_state = mysql_fetch_assoc($WADAMenutournament_state);
          }
        ?>
        </select>
            </li> 
            <li> <label for="tournament_zip" class="sublabel" > Zip:</label>
          <input id="tournament_zip" name="tournament_zip" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_zip"):"")); ?>" class="formTextfield_Medium" tabindex="11" pattern="(\d{5}([\-]\d{4})?)" title="Please enter a value.">
               <?php
        if (ValidatedField('tournamentinsert','tournamentinsert'))  {
          if ((strpos((",".ValidatedField("tournamentinsert","tournamentinsert").","), "," . "5" . ",") !== false || "5" == ""))  {
            if (!(false))  {
        ?>
                 <span class="serverInvalidState" id="tournament_zip_ServerError">Please enter a value.</span>
                 <?php //WAFV_Conditional tournament_insert.php tournamentinsert(5:)
            }
          }
        }?>
            </li>
    </li>
  		</ol>
  	  </fieldset>
    <li>
    <fieldset>
      <legend>Contact in Additional Info</legend>
		<ol>
            <li> <label for="tournament_phone" class="sublabel" > Phone:</label>
          <input id="tournament_phone" name="tournament_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_phone"):"")); ?>" class="formTextfield_Medium" tabindex="12" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').tournament_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').tournament_phone,0,true);">
               <?php
        if (ValidatedField('tournamentinsert','tournamentinsert'))  {
          if ((strpos((",".ValidatedField("tournamentinsert","tournamentinsert").","), "," . "6" . ",") !== false || "6" == ""))  {
            if (!(false))  {
        ?>
                 <span class="serverInvalidState" id="tournament_phone_ServerError">Please enter a value.</span>
                 <?php //WAFV_Conditional tournament_insert.php tournamentinsert(6:)
            }
          }
        }?>
            </li> 
            <li> <label for="tournament_email" class="sublabel" > Main Contact Email:<span class="requiredIndicator">&nbsp;*</span></label>
          <input id="tournament_email" name="tournament_email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_email"):"")); ?>" class="formTextfield_Large" tabindex="13" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required>
               <?php
        if (ValidatedField('tournamentinsert','tournamentinsert'))  {
          if ((strpos((",".ValidatedField("tournamentinsert","tournamentinsert").","), "," . "7" . ",") !== false || "7" == ""))  {
            if (!(false))  {
        ?>
                 <span class="serverInvalidState" id="tournament_email_ServerError">Please enter a value.</span>
                 <?php //WAFV_Conditional tournament_insert.php tournamentinsert(7:)
            }
          }
        }?>
            </li> 
            <li> <label for="tournament_URL" class="sublabel" > Tournament Website:</label>
          <input id="tournament_URL" name="tournament_URL" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_URL"):"")); ?>" class="formTextfield_Large" tabindex="14" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
               <?php
        if (ValidatedField('tournamentinsert','tournamentinsert'))  {
          if ((strpos((",".ValidatedField("tournamentinsert","tournamentinsert").","), "," . "8" . ",") !== false || "8" == ""))  {
            if (!(false))  {
        ?>
                 <span class="serverInvalidState" id="tournament_URL_ServerError">Please enter a value.</span>
                 <?php //WAFV_Conditional tournament_insert.php tournamentinsert(8:)
            }
          }
        }?>
            </li> 
            <li> <label for="tournament_info" class="sublabel" > Tournament Information:</label><div style="display:inline-block; width:100%;">
              <?php
        // The initial value to be displayed in the editor.
        $CKEditor_initialValue = "".((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_info",false):""))  ."";
        $CKEditor = new CKEditor();
        $CKEditor->basePath = "../webassist/ckeditor/";
        $CKEditor_config = array();
        $CKEditor_config["wa_preset_name"] = "Battlecomm";
        $CKEditor_config["wa_preset_file"] = "Battlecomm.xml";
        $CKEditor_config["width"] = "100%";
        $CKEditor_config["height"] = "400px";
        $CKEditor_config["docType"] = "<" ."!" ."DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">";
        $CKEditor_config["dialog_startupFocusTab"] = false;
        $CKEditor_config["fullPage"] = false;
        $CKEditor_config["tabSpaces"] = 4;
        $CKEditor_config["filebrowserBrowseUrl"] = "../webassist/kfm/index.php?uicolor=".urlencode(isset($CKEditor_config["uiColor"])?str_replace("#","#",$CKEditor_config["uiColor"]):"#eee")."&theme=webassist_v2&startup_folder=/tournament/";
        $CKEditor_config["toolbar"] = array(
        array( 'Cut','Copy','Paste','SpellCheck'),
        array( 'Undo','Redo'),
        array( 'Bold','Italic','Underline','Subscript','Superscript'),
        array( 'NumberedList','BulletedList','-','Outdent','Indent'),
        array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
        array( 'Link','Unlink','Anchor'),
        array( 'Table','Rule','SpecialChar'),
        array( 'FontName','FontSize'),
        array( 'Image','Flash','HorizontalRule','Smiley','PageBreak'),
        array( 'TextColor','BGColor'));
        $CKEditor_config["contentsLangDirection"] = "ltr";
        $CKEditor_config["entities"] = false;
        $CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
        $CKEditor_config["pasteFromWordRemoveStyles"] = false;
        $CKEditor->editor("tournament_info", $CKEditor_initialValue, $CKEditor_config);
        ?>
            </div>
            </li> 
    </li>
  		</ol>
  	  </fieldset>
    <li>
    <fieldset>
      <legend>Rules</legend>
		<ol>
            <li> <label for="tournament_rounds" class="sublabel" > # of Rounds:</label>
          <input id="tournament_rounds" name="tournament_rounds" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_rounds"):"")); ?>" class="formTextfield_Small" tabindex="15" title="Please enter a value." min="100">
               <?php
        if (ValidatedField('tournamentinsert','tournamentinsert'))  {
          if ((strpos((",".ValidatedField("tournamentinsert","tournamentinsert").","), "," . "9" . ",") !== false || "9" == ""))  {
            if (!(false))  {
        ?>
                 <span class="serverInvalidState" id="tournament_rounds_ServerError">Please enter a value.</span>
                 <?php //WAFV_Conditional tournament_insert.php tournamentinsert(9:)
            }
          }
        }?>
            </li> 
            <li> <label for="factions_cap" class="sublabel" > Factions Cap:</label>
          <input id="factions_cap" name="factions_cap" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","factions_cap"):"")); ?>" class="formTextfield_Small" tabindex="16" title="Please enter a value.">
            </li> 
            <li> <label for="No_of_Games" class="sublabel" > Number of Games (per Round):</label>
          <input id="No_of_Games" name="No_of_Games" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","No_of_Games"):"")); ?>" class="formTextfield_Small" tabindex="17" title="Please enter a value.">
            </li> 
            <li> <label for="game_id" class="sublabel" > Game System:</label>
              <select class="formMenufield_Medium" name="game_id" id="game_id" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","game_id"):"")); ?>" tabindex="18" title="Please enter a value.">
                <option value="" <?php if (!(strcmp("", (isset($_GET["invalid"])?ValidatedField("tournamentinsert","game_id"):"")))) {echo "selected=\"selected\"";} ?>>Choose Game...</option>
                <?php
        do {  
        ?>
        <option value="<?php echo $row_WADAMenugame_id['game_system_id']?>"<?php if (!(strcmp($row_WADAMenugame_id['game_system_id'], (isset($_GET["invalid"])?ValidatedField("tournamentinsert","game_id"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugame_id['game_system_Title']?></option>
                <?php
        } while ($row_WADAMenugame_id = mysql_fetch_assoc($WADAMenugame_id));
          $rows = mysql_num_rows($WADAMenugame_id);
          if($rows > 0) {
              mysql_data_seek($WADAMenugame_id, 0);
              $row_WADAMenugame_id = mysql_fetch_assoc($WADAMenugame_id);
          }
        ?>
        </select>
              <input name="tournamentOwner" type="hidden" id="tournamentOwner" value="<?php echo $_SESSION['SecurityAssist_id']; ?>">
            </li> 
             <li> <label for="WinPointValue" class="sublabel" > Win Point Value:</label>
          <input id="WinPointValue" name="WinPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","WinPointValue"):"")); ?>" class="formTextfield_Medium" tabindex="20" title="Please enter a value.">
            </li> 
            <li> <label for="DrawPointValue" class="sublabel" > Draw Point Value:</label>
          <input id="DrawPointValue" name="DrawPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","DrawPointValue"):"")); ?>" class="formTextfield_Medium" tabindex="21" title="Please enter a value.">
            </li> 
            <li> <label for="LossPointValue" class="sublabel" > Loss Point Value:</label>
          <input id="LossPointValue" name="LossPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","LossPointValue"):"")); ?>" class="formTextfield_Medium" tabindex="22" title="Please enter a value.">
            </li> 
      </ol>
    </fieldset>
                    <span class="buttonFieldGroup" >
          <input id="tournament_store_location" name="tournament_store_location" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","tournament_store_location"):"")); ?>">
          <input id="tournament_admin_id" name="tournament_admin_id" type="hidden" value="<?php echo $_SESSION['SecurityAssist_id']; ?>">
          <input id="game_title" name="game_title" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamentinsert","game_title"):"")); ?>">
        <input type="submit" value="Insert" id="Insert" name="Insert" />
                </span>
  </li>
</ol>
</form></div><div id="Insert_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Default', 'Insert_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Insert_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>
<div class="full_width">	
	
</div>

<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../webassist/forms/wa_clientvalidation.js" type="text/javascript"></script>
<script src="../webassist/jq_validation/jquery.h5validate.js"></script>
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

		<?php include '../../Templates/parts/container-bottom.php'; ?>
	<?php include '../../Templates/parts/footer.php'; ?>
<?php
mysql_free_result($WADAMenutournament_state);
?>
<?php
mysql_free_result($WADAMenugame_id);
?>
