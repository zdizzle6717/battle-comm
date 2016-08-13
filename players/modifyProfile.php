<?php require_once('../Connections/local.php'); ?>
<?php require_once("../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_userloginupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_POST["email"])?$_POST["email"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"0")  ."","email","',none,''","".((isset($_POST["email"]))?$_POST["email"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["user_handle"])?$_POST["user_handle"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"0")  ."","user_handle","',none,''","".((isset($_POST["user_handle"]))?$_POST["user_handle"]:"")  ."",true,4);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_main_phone"])?$_POST["user_main_phone"]:"") . "",false,true,false,5);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_mobile_phone"])?$_POST["user_mobile_phone"]:"") . "",false,true,false,6);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_work_phone"])?$_POST["user_work_phone"]:"") . "",false,true,false,7);
  $WAFV_Errors .= WAValidateZC((isset($_POST["user_zip"])?$_POST["user_zip"]:"") . "",true,false,false,false,false,8);
  $WAFV_Errors .= WAValidateDT((isset($_POST["user_Date_of_Birth"])?$_POST["user_Date_of_Birth"]:"") . "",true,"","","",false,"","","",false,9);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userloginupdate");
   }
 }
 ?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php 
//*** Pure PHP File Upload 3.1.0
// Process form iconUpload
$ppu = new pureFileUpload();
$ppu->nameConflict = "over";
$ppu->storeType = "path";
$ppu->progressBar = "html5.htm";
$ppu->progressWidth = 350;
$ppu->progressHeight = 150;
$ppu->path = "../uploads/player";
$ppu->allowedExtensions = "GIF,JPG,JPEG,BMP,PNG"; // "custom"
$ppu->maxWidth = 2000;
$ppu->maxHeight = 2000;
$ppu->redirectUrl = "modifyProfile.php";
$ppu->checkVersion("3.1.0");
$ppu->doUpload();
if ($ppu->done) {
  $_POST["undefined"] = undefined;
  $_POST["undefined"] = undefined;
}
?>
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
$Paramid_WADAuser_login = "-1";
if (isset($_GET['id'])) {
  $Paramid_WADAuser_login = $_GET['id'];
}
mysql_select_db($database_local, $local);
$query_WADAuser_login = sprintf("SELECT id, email, password, firstName, lastName, user_handle, user_main_phone, user_mobile_phone, user_work_phone, user_street_address, user_apt_suite, user_city, user_state, user_zip, user_Date_of_Birth, user_bio, user_facebook, user_twitter, user_instagram, user_google_plus, user_youtube, user_twitch, user_website, user_points, user_visibility, user_share_contact, user_share_name, user_share_status, user_newsletter, user_marketing, user_sms, user_allow_play, user_icon FROM user_login WHERE id = %s", GetSQLValueString($Paramid_WADAuser_login, "-1"));
$WADAuser_login = mysql_query($query_WADAuser_login, $local) or die(mysql_error());
$row_WADAuser_login = mysql_fetch_assoc($WADAuser_login);
$totalRows_WADAuser_login = mysql_num_rows($WADAuser_login);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenuuser_state = "SELECT state_name, state_abbr FROM tbl_state ORDER BY state_name ASC";
$WADAMenuuser_state = mysql_query($query_WADAMenuuser_state, $local) or die(mysql_error());
$row_WADAMenuuser_state = mysql_fetch_assoc($WADAMenuuser_state);
$totalRows_WADAMenuuser_state = mysql_num_rows($WADAMenuuser_state);
?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../uploads/player/".$_SESSION['SecurityAssist_id']  ."/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "".($row_WADAuser_login["user_icon"])  ."",
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
	WA_DFP_UploadFiles("WA_UploadResult1", "user_icon", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_redirectURL = "user_login_insert.php?id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAuser_login"])?"&pageNum_WADAuser_login=".intval($_GET["pageNum_WADAuser_login"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "email|password|firstName|lastName|user_handle|user_main_phone|user_mobile_phone|user_work_phone|user_street_address|user_apt_suite|user_city|user_state|user_zip|user_Date_of_Birth|user_bio|user_facebook|user_twitter|user_instagram|user_google_plus|user_youtube|user_twitch|user_website|user_points|user_visibility|user_share_contact|user_share_name|user_share_status|user_newsletter|user_marketing|user_sms|user_allow_play|user_icon";
  $WA_fieldValuesStr = "".((isset($_POST["email"]))?$_POST["email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["password"]))?WA_MD5Encryption($_POST["password"]):"")  ."" . $WA_AB_Split . "".((isset($_POST["firstName"]))?$_POST["firstName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["lastName"]))?$_POST["lastName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_handle"]))?$_POST["user_handle"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_main_phone"]))?$_POST["user_main_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_mobile_phone"]))?$_POST["user_mobile_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_work_phone"]))?$_POST["user_work_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_street_address"]))?$_POST["user_street_address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_apt_suite"]))?$_POST["user_apt_suite"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_city"]))?$_POST["user_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_state"]))?$_POST["user_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_zip"]))?$_POST["user_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_Date_of_Birth"]) && $_POST["user_Date_of_Birth"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["user_Date_of_Birth"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["user_bio"]))?$_POST["user_bio"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_facebook"]))?$_POST["user_facebook"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitter"]))?$_POST["user_twitter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_instagram"]))?$_POST["user_instagram"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_google_plus"]))?$_POST["user_google_plus"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_youtube"]))?$_POST["user_youtube"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitch"]))?$_POST["user_twitch"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_website"]))?$_POST["user_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_points"]))?$_POST["user_points"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_visibility"]))?$_POST["user_visibility"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_contact"]))?$_POST["user_share_contact"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_name"]))?$_POST["user_share_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_status"]))?$_POST["user_share_status"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_newsletter"]))?$_POST["user_newsletter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_marketing"]))?$_POST["user_marketing"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_sms"]))?$_POST["user_sms"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_allow_play"]))?$_POST["user_allow_play"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | = | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE ";
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
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Shop</title>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../webassist/jq_validation/Bloom.css">
<link type="text/css" href="../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script src="../ScriptLibrary/incPU3.js" type="text/javascript"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript"><?php echo $ppu->generateScriptCode() ?></script>
<script type="text/javascript">
$(function(){
	$('#user_Date_of_Birth').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_user_Date_of_Birth
	});
});
function closeDatePicker_user_Date_of_Birth() {
	var tElm = $('#user_Date_of_Birth');
	if (typeof user_Date_of_Birth_Spry != null && typeof user_Date_of_Birth_Spry != "undefined" && user_Date_of_Birth_Spry.validate) {
		user_Date_of_Birth_Spry.validate();
	}
	tElm.blur();
}

  /* dmxDataSet name "userIcon" */
       jQuery.dmxDataSet(
         {"id": "userIcon", "url": "../dmxDatabaseSources/icon.php", "data": {"id": "{{$URL.id}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "userIcon" */
function dmxDatabaseActionControl(action, id) { // v1.0
  if (jQuery.dmxDatabaseAction) {
    var da = jQuery.dmxDatabaseAction.get(id),
        args = Array.prototype.slice.call(arguments, 2);
    if (da) {
      da[action].apply(da, args);
    }
  }
}
</script>
</head>
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
                        	<div class="full_width">
                            <div class="full_width">
                            <p><form action="<?php echo $DMX_uploadAction ?>" method="post" enctype="multipart/form-data" name="iconUpload" id="iconUpload" onSubmit="<?php echo $ppu->getSubmitCode() ?>;return document.MM_returnValue">
                              <?php echo $ppu->getProgressField() ?>
                              <input name="uploadIcon" type="file" multiple id="uploadIcon" form="iconUpload" onChange="<?php echo $ppu->getValidateCode() ?>;return document.MM_returnValue">
                              <input type="submit" formaction="#" formenctype="multipart/form-data" formmethod="POST" onClick="dmxDatabaseActionControl('run','updateIcon',{},this)">
                            </form></p>
                            <p> <img src="{{userIcon.data[0].user_icon}}" alt=""/></p>
            				</div>
		<?php include '../Templates/parts/container-bottom.php'; ?>
<?php include '../Templates/parts/footer.php'; ?>
    <script type="text/javascript">
/* dmxDatabaseAction name "updateIcon" */
       jQuery.dmxDatabaseAction(
         {"id": "updateIcon", "url": "../dmxDatabaseActions/updateIcon.php", "data": {"user_icon": "{{$FORM.uploadIcon}}", "id": ""}}
       );
  /* END dmxDatabaseAction name "updateIcon" */
        </script>