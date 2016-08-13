<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_userprofileupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["username"])?$_POST["username"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateEM((isset($_POST["user_email"])?$_POST["user_email"]:"") . "",true,2);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userprofileupdate");
   }
 }
 ?>
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
$Paramiduser_profile_WADAuser_profile = "-1";
if (isset($_GET['iduser_profile'])) {
  $Paramiduser_profile_WADAuser_profile = $_GET['iduser_profile'];
}
mysql_select_db($database_local_local, $local_local);
$query_WADAuser_profile = sprintf("SELECT iduser_profile, username, user_firstName, user_lastName, user_email FROM user_profile WHERE iduser_profile = %s", GetSQLValueString($Paramiduser_profile_WADAuser_profile, "int"));
$WADAuser_profile = mysql_query($query_WADAuser_profile, $local_local) or die(mysql_error());
$row_WADAuser_profile = mysql_fetch_assoc($WADAuser_profile);
$totalRows_WADAuser_profile = mysql_num_rows($WADAuser_profile);
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "user_profile";
  $WA_redirectURL = "user_profile_detail.php?iduser_profile=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAuser_profile"])?"&pageNum_WADAuser_profile=".intval($_GET["pageNum_WADAuser_profile"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "iduser_profile";
  $WA_fieldNamesStr = "username|user_firstName|user_lastName|user_email";
  $WA_fieldValuesStr = "".((isset($_POST["username"]))?$_POST["username"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_firstName"]))?$_POST["user_firstName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_lastName"]))?$_POST["user_lastName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_email"]))?$_POST["user_email"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE ";
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
<form class="Basic_Default" id="Update_Basic_Default" name="Update_Basic_Default" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Default" id="Update">
          <legend class="groupHeader">Update</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
    <div class="lineGroup"> <label for="username" class="sublabel" > Username:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="username" name="username" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","username"):"".$row_WADAuser_profile["username"]."")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userprofileupdate','userprofileupdate'))  {
  if ((strpos((",".ValidatedField("userprofileupdate","userprofileupdate").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="username_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_update.php userprofileupdate(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_firstName" class="sublabel" > First Name:</label>
  <input id="user_firstName" name="user_firstName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_firstName"):"".$row_WADAuser_profile["user_firstName"]."")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_lastName" class="sublabel" > Last Name:</label>
  <input id="user_lastName" name="user_lastName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_lastName"):"".$row_WADAuser_profile["user_lastName"]."")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_email" class="sublabel" > Email:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="user_email" name="user_email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_email"):"".$row_WADAuser_profile["user_email"]."")); ?>" class="formTextfield_Large" tabindex="4" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userprofileupdate','userprofileupdate'))  {
  if ((strpos((",".ValidatedField("userprofileupdate","userprofileupdate").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_email_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_update.php userprofileupdate(2:)
    }
  }
}?>
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Update" class="" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","WADAUpdateRecordID"):$_GET["iduser_profile"])); ?>" />
</form></div><div id="Update_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Default', 'Update_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Update_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
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
mysql_free_result($WADAuser_profile);
?>
