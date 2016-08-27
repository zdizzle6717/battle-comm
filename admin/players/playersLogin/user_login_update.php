<?php require_once('../../../Connections/local.php'); ?>
<?php require_once("../../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../../../webassist/form_validations/wavt_validatedform_php.php"); ?>
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
  $WAFV_Errors .= WAValidateRQ((isset($_POST["password"])?$_POST["password"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateDT((isset($_POST["join_date"])?$_POST["join_date"]:"") . "",true,"","","",false,"","","",false,4);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userloginupdate");
   }
 }
 ?>
<?php require_once("../../../webassist/database_management/wa_appbuilder_php.php"); ?>
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
$query_WADAuser_login = sprintf("SELECT id, email, password, activation_key, activation_state, firstName, lastName, join_date, tourneyAdmin, EventAdmin, NewsContributor, venueAdmin FROM user_login WHERE id = %s", GetSQLValueString($Paramid_WADAuser_login, "int"));
$WADAuser_login = mysql_query($query_WADAuser_login, $local) or die(mysql_error());
$row_WADAuser_login = mysql_fetch_assoc($WADAuser_login);
$totalRows_WADAuser_login = mysql_num_rows($WADAuser_login);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenutourneyAdmin = "SELECT choiceTitle FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenutourneyAdmin = mysql_query($query_WADAMenutourneyAdmin, $local) or die(mysql_error());
$row_WADAMenutourneyAdmin = mysql_fetch_assoc($WADAMenutourneyAdmin);
$totalRows_WADAMenutourneyAdmin = mysql_num_rows($WADAMenutourneyAdmin);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenuEventAdmin = "SELECT choiceValue FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenuEventAdmin = mysql_query($query_WADAMenuEventAdmin, $local) or die(mysql_error());
$row_WADAMenuEventAdmin = mysql_fetch_assoc($WADAMenuEventAdmin);
$totalRows_WADAMenuEventAdmin = mysql_num_rows($WADAMenuEventAdmin);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenuNewsContributor = "SELECT choiceTitle FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenuNewsContributor = mysql_query($query_WADAMenuNewsContributor, $local) or die(mysql_error());
$row_WADAMenuNewsContributor = mysql_fetch_assoc($WADAMenuNewsContributor);
$totalRows_WADAMenuNewsContributor = mysql_num_rows($WADAMenuNewsContributor);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenuvenueAdmin = "SELECT choiceTitle FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenuvenueAdmin = mysql_query($query_WADAMenuvenueAdmin, $local) or die(mysql_error());
$row_WADAMenuvenueAdmin = mysql_fetch_assoc($WADAMenuvenueAdmin);
$totalRows_WADAMenuvenueAdmin = mysql_num_rows($WADAMenuvenueAdmin);
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_redirectURL = "user_login_detail.php?id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAuser_login"])?"&pageNum_WADAuser_login=".intval($_GET["pageNum_WADAuser_login"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "email|password|activation_key|activation_state|firstName|lastName|join_date|tourneyAdmin|EventAdmin|NewsContributor|venueAdmin";
  $WA_fieldValuesStr = "".((isset($_POST["email"]))?$_POST["email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["password"]))?WA_MD5Encryption($_POST["password"]):"")  ."" . $WA_AB_Split . "".((isset($_POST["activation_key"]))?$_POST["activation_key"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["activation_state"]))?$_POST["activation_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["firstName"]))?$_POST["firstName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["lastName"]))?$_POST["lastName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["join_date"]) && $_POST["join_date"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["join_date"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["tourneyAdmin"]))?$_POST["tourneyAdmin"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["EventAdmin"]))?$_POST["EventAdmin"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["NewsContributor"]))?$_POST["NewsContributor"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venueAdmin"]))?$_POST["venueAdmin"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | = | LIKE | LIKE | LIKE | LIKE ";
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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Untitled Document</title>
    <link href="../../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../../webassist/jq_validation/Bloom.css">
    <link type="text/css" href="../../../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="../../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('#join_date').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_join_date
	});
});
function closeDatePicker_join_date() {
	var tElm = $('#join_date');
	if (typeof join_date_Spry != null && typeof join_date_Spry != "undefined" && join_date_Spry.validate) {
		join_date_Spry.validate();
	}
	tElm.blur();
}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="file:///C|/xampp/htdocs/testBC/webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Update_Basic_Default_ProgressWrapper">
<form class="Basic_Default" id="Update_Basic_Default" name="Update_Basic_Default" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Default" id="Update">
          <legend class="groupHeader">Update</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
    <div class="lineGroup"> <label for="email" class="sublabel" > Email:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="email" name="email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","email"):"".$row_WADAuser_login["email"]."")); ?>" class="formTextfield_Medium" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="email_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(1,2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="password" class="sublabel" > password:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="password" name="password" type="password" value="" class="formPasswordfield_Large" tabindex="2" title="Please enter a value." confirm="" required="true">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="password_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="activation_key" class="sublabel" > activation_key:</label>
  <input id="activation_key" name="activation_key" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","activation_key"):"".$row_WADAuser_login["activation_key"]."")); ?>" class="formTextfield_Large" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="activation_state" class="sublabel" > activation_state:</label>
      <select class="formMenufield_Large" name="activation_state" id="activation_state" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","activation_state"):"".$row_WADAuser_login["activation_state"]."")); ?>" tabindex="4" title="Please enter a value.">
      </select>
    </div> 
    <div class="lineGroup"> <label for="firstName" class="sublabel" > First Name:</label>
  <input id="firstName" name="firstName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","firstName"):"".$row_WADAuser_login["firstName"]."")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="lastName" class="sublabel" > Last Name:</label>
  <input id="lastName" name="lastName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","lastName"):"".$row_WADAuser_login["lastName"]."")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="join_date" class="sublabel" > Date Joined:</label>
  <input id="join_date" name="join_date" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","join_date"):"".(($row_WADAuser_login["join_date"])?date("n/d/Y",strtotime($row_WADAuser_login["join_date"])):"")."")); ?>" class="formTextfield_Medium" tabindex="7" title="Please enter a value.">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="join_date_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(4:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="tourneyAdmin" class="sublabel" > Tournament Admin:</label>
      <select class="formMenufield_Medium" name="tourneyAdmin" id="tourneyAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","tourneyAdmin"):"".$row_WADAuser_login["tourneyAdmin"]."")); ?>" tabindex="8" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenutourneyAdmin['choiceTitle']?>"<?php if (!(strcmp($row_WADAMenutourneyAdmin['choiceTitle'], (isset($_GET["invalid"])?ValidatedField("userloginupdate","tourneyAdmin"):"".$row_WADAuser_login["tourneyAdmin"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenutourneyAdmin['choiceTitle']?></option>
        <?php
} while ($row_WADAMenutourneyAdmin = mysql_fetch_assoc($WADAMenutourneyAdmin));
  $rows = mysql_num_rows($WADAMenutourneyAdmin);
  if($rows > 0) {
      mysql_data_seek($WADAMenutourneyAdmin, 0);
	  $row_WADAMenutourneyAdmin = mysql_fetch_assoc($WADAMenutourneyAdmin);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="EventAdmin" class="sublabel" > Event Admin:</label>
      <select class="formMenufield_Medium" name="EventAdmin" id="EventAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","EventAdmin"):"".$row_WADAuser_login["EventAdmin"]."")); ?>" tabindex="9" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuEventAdmin['choiceValue']?>"<?php if (!(strcmp($row_WADAMenuEventAdmin['choiceValue'], (isset($_GET["invalid"])?ValidatedField("userloginupdate","EventAdmin"):"".$row_WADAuser_login["EventAdmin"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuEventAdmin['choiceValue']?></option>
        <?php
} while ($row_WADAMenuEventAdmin = mysql_fetch_assoc($WADAMenuEventAdmin));
  $rows = mysql_num_rows($WADAMenuEventAdmin);
  if($rows > 0) {
      mysql_data_seek($WADAMenuEventAdmin, 0);
	  $row_WADAMenuEventAdmin = mysql_fetch_assoc($WADAMenuEventAdmin);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="NewsContributor" class="sublabel" > News Contributor:</label>
      <select class="formMenufield_Medium" name="NewsContributor" id="NewsContributor" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","NewsContributor"):"".$row_WADAuser_login["NewsContributor"]."")); ?>" tabindex="10" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuNewsContributor['choiceTitle']?>"<?php if (!(strcmp($row_WADAMenuNewsContributor['choiceTitle'], (isset($_GET["invalid"])?ValidatedField("userloginupdate","NewsContributor"):"".$row_WADAuser_login["NewsContributor"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuNewsContributor['choiceTitle']?></option>
        <?php
} while ($row_WADAMenuNewsContributor = mysql_fetch_assoc($WADAMenuNewsContributor));
  $rows = mysql_num_rows($WADAMenuNewsContributor);
  if($rows > 0) {
      mysql_data_seek($WADAMenuNewsContributor, 0);
	  $row_WADAMenuNewsContributor = mysql_fetch_assoc($WADAMenuNewsContributor);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="venueAdmin" class="sublabel" > Venue/Store Admin:</label>
      <select class="formMenufield_Medium" name="venueAdmin" id="venueAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","venueAdmin"):"".$row_WADAuser_login["venueAdmin"]."")); ?>" tabindex="11" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuvenueAdmin['choiceTitle']?>"<?php if (!(strcmp($row_WADAMenuvenueAdmin['choiceTitle'], (isset($_GET["invalid"])?ValidatedField("userloginupdate","venueAdmin"):"".$row_WADAuser_login["venueAdmin"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuvenueAdmin['choiceTitle']?></option>
        <?php
} while ($row_WADAMenuvenueAdmin = mysql_fetch_assoc($WADAMenuvenueAdmin));
  $rows = mysql_num_rows($WADAMenuvenueAdmin);
  if($rows > 0) {
      mysql_data_seek($WADAMenuvenueAdmin, 0);
	  $row_WADAMenuvenueAdmin = mysql_fetch_assoc($WADAMenuvenueAdmin);
  }
?>
</select>
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Update" class="formButton Modular" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","WADAUpdateRecordID"):$_GET["id"])); ?>" />
</form></div><div id="Update_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Default', 'Update_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Update_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Update_Basic_Default_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Bloom",
    pointedAt: "left",
    fieldOffset: 10,
    fieldMargin: 2,
    position: "left",
    direction: "left",
    border: 1,
    offset: 25,
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
mysql_free_result($WADAuser_login);
?>
<?php
mysql_free_result($WADAMenutourneyAdmin);
?>
<?php
mysql_free_result($WADAMenuEventAdmin);
?>
<?php
mysql_free_result($WADAMenuNewsContributor);
?>
<?php
mysql_free_result($WADAMenuvenueAdmin);
?>
