<?php require_once('../Connections/local.php'); ?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../uploads/player/".$_SESSION['SecurityAssist_id']  ."",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1_2 Start
$WA_UploadResult1_Params["WA_UploadResult1_2"] = array(
	'UploadFolder' => "../uploads/player/".$_SESSION['SecurityAssist_id']  ."",
	'FileName' => "[FileName]_thumb",
	'DefaultFileName' => "",
	'ResizeType' => "4",
	'ResizeWidth' => "100",
	'ResizeHeight' => "100",
	'ResizeFillColor' => "" );
// WA_UploadResult1_2 End
// WA_UploadResult1_3 Start
$WA_UploadResult1_Params["WA_UploadResult1_3"] = array(
	'UploadFolder' => "../uploads/player/".$_SESSION['SecurityAssist_id']  ."",
	'FileName' => "[FileName]_icon",
	'DefaultFileName' => "",
	'ResizeType' => "1",
	'ResizeWidth' => "37",
	'ResizeHeight' => "37",
	'ResizeFillColor' => "#FFFFFF" );
// WA_UploadResult1_3 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST)){
	WA_DFP_UploadFiles("WA_UploadResult1", "uploadIcon", "2", "[NewFileName]_[Increment]", "true", $WA_UploadResult1_Params);
}
?>
<?php
 require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../accessdenied.php");
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

$colname_userLogin = "-1";
if (isset($_SESSION['SecurityAssist_id'])) {
  $colname_userLogin = $_SESSION['SecurityAssist_id'];
}
mysql_select_db($database_local, $local);
$query_userLogin = sprintf("SELECT * FROM user_login WHERE id = %s", GetSQLValueString($colname_userLogin, "int"));
$userLogin = mysql_query($query_userLogin, $local) or die(mysql_error());
$row_userLogin = mysql_fetch_assoc($userLogin);
$totalRows_userLogin = mysql_num_rows($userLogin);
 require_once("../webassist/ckeditor/ckeditor.php"); ?>
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
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
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
</script><script type="text/javascript" src="../ScriptLibrary/dmxServerAction.js"></script>
</head>
<?php include '../Templates/parts/header.php'; ?>
		<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST)){
	WA_DFP_UploadFiles("WA_UploadResult1", "uploadIcon", "2", "[NewFileName]_[Increment]", "true", $WA_UploadResult1_Params);
}
?><?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
                        	<div class="full_width">
                            <div class="full_width">
                            <p><form action="" method="post" enctype="multipart/form-data" name="iconUpload" id="iconUpload">
                              <input name="uploadIcon" type="file" multiple id="uploadIcon" form="iconUpload">
                              <input name="userID" type="hidden" id="userID" value="<?php echo $_SESSION['SecurityAssist_id']; ?>">
<input type="submit" formaction="#" formenctype="multipart/form-data" formmethod="POST" onClick="dmxDatabaseActionControl('run','updateIcon',{},this)">
                            </form></p>
                            <p><img src="../uploads/player/<?php echo $_SESSION['SecurityAssist_id']; ?>/<?php echo $row_userLogin['user_icon']; ?>" alt="" width="300"/><?php echo $_SESSION['SecurityAssist_id']; ?></p>
            				</div>
		<?php include '../Templates/parts/container-bottom.php'; ?>
<?php include '../Templates/parts/footer.php'; ?>
<?php
mysql_free_result($userLogin);
?>
<script type="text/javascript">
/* dmxDatabaseAction name "updateIcon" */
       jQuery.dmxDatabaseAction(
         {"id": "updateIcon", "url": "../dmxDatabaseActions/updateIcon.php", "data": {"user_icon": "{{$FORM.uploadIcon}}", "id": ""}}
       );
  /* END dmxDatabaseAction name "updateIcon" */
        </script>