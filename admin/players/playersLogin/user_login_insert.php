<?php
mysql_select_db($database_local, $local);
$query_WADAMenuvenueAdmin = "SELECT choiceTitle FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenuvenueAdmin = mysql_query($query_WADAMenuvenueAdmin, $local) or die(mysql_error());
$row_WADAMenuvenueAdmin = mysql_fetch_assoc($WADAMenuvenueAdmin);
$totalRows_WADAMenuvenueAdmin = mysql_num_rows($WADAMenuvenueAdmin);
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
$query_WADAMenuEventAdmin = "SELECT choiceValue FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenuEventAdmin = mysql_query($query_WADAMenuEventAdmin, $local) or die(mysql_error());
$row_WADAMenuEventAdmin = mysql_fetch_assoc($WADAMenuEventAdmin);
$totalRows_WADAMenuEventAdmin = mysql_num_rows($WADAMenuEventAdmin);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenutourneyAdmin = "SELECT choiceTitle FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenutourneyAdmin = mysql_query($query_WADAMenutourneyAdmin, $local) or die(mysql_error());
$row_WADAMenutourneyAdmin = mysql_fetch_assoc($WADAMenutourneyAdmin);
$totalRows_WADAMenutourneyAdmin = mysql_num_rows($WADAMenutourneyAdmin);
?>
<?php require_once("../../../webassist/security_assist/wa_md5encryption.php"); ?>
<?php require_once("../../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_sessionName = "WADA_Insert_user_login";
  $WA_redirectURL = "user_login_detail.php?id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "email|password|activation_key|activation_state|firstName|lastName|join_date|tourneyAdmin|EventAdmin|NewsContributor|venueAdmin";
  $WA_fieldValuesStr = "".((isset($_POST["email"]))?$_POST["email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["password"]))?WA_MD5Encryption($_POST["password"]):"")  ."" . $WA_AB_Split . "".((isset($_POST["activation_key"]))?$_POST["activation_key"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["activation_state"]))?$_POST["activation_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["firstName"]))?$_POST["firstName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["lastName"]))?$_POST["lastName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["join_date"]) && $_POST["join_date"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["join_date"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["tourneyAdmin"]))?$_POST["tourneyAdmin"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["EventAdmin"]))?$_POST["EventAdmin"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["NewsContributor"]))?$_POST["NewsContributor"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venueAdmin"]))?$_POST["venueAdmin"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''";
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
<?php require_once('../../../Connections/local.php'); ?>
<?php require_once("../../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_userlogininsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_POST["email"])?$_POST["email"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","0","email","',none,''","".((isset($_POST["email"]))?$_POST["email"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["password"])?$_POST["password"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateDT((isset($_POST["join_date"])?$_POST["join_date"]:"") . "",true,"","","",false,"","","",false,4);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userlogininsert");
   }
 }
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../../webassist/jq_validation/Bloom.css">
<link type="text/css" href="../../../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
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
<link href="../../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Insert_Basic_Default_ProgressWrapper">
<form class="Basic_Default" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
          <legend class="groupHeader">Insert</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
    <div class="lineGroup"> <label for="email" class="sublabel" > Email:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="email" name="email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","email"):"")); ?>" class="formTextfield_Medium" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="email_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(1,2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="password" class="sublabel" > password:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="password" name="password" type="password" value="" class="formPasswordfield_Large" tabindex="2" title="Please enter a value." confirm="" required="true">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="password_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="activation_key" class="sublabel" > activation_key:</label>
  <input id="activation_key" name="activation_key" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","activation_key"):"")); ?>" class="formTextfield_Large" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="activation_state" class="sublabel" > activation_state:</label>
      <select class="formMenufield_Large" name="activation_state" id="activation_state" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","activation_state"):"")); ?>" tabindex="4" title="Please enter a value.">
      </select>
    </div> 
    <div class="lineGroup"> <label for="firstName" class="sublabel" > First Name:</label>
  <input id="firstName" name="firstName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","firstName"):"")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="lastName" class="sublabel" > Last Name:</label>
  <input id="lastName" name="lastName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","lastName"):"")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="join_date" class="sublabel" > Date Joined:</label>
  <input id="join_date" name="join_date" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","join_date"):"")); ?>" class="formTextfield_Medium" tabindex="7" title="Please enter a value.">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="join_date_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(4:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="tourneyAdmin" class="sublabel" > Tournament Admin:</label>
      <select class="formMenufield_Medium" name="tourneyAdmin" id="tourneyAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","tourneyAdmin"):"")); ?>" tabindex="8" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenutourneyAdmin['choiceTitle']?>"<?php if (!(strcmp($row_WADAMenutourneyAdmin['choiceTitle'], (isset($_GET["invalid"])?ValidatedField("userlogininsert","tourneyAdmin"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenutourneyAdmin['choiceTitle']?></option>
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
      <select class="formMenufield_Medium" name="EventAdmin" id="EventAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","EventAdmin"):"")); ?>" tabindex="9" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuEventAdmin['choiceValue']?>"<?php if (!(strcmp($row_WADAMenuEventAdmin['choiceValue'], (isset($_GET["invalid"])?ValidatedField("userlogininsert","EventAdmin"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuEventAdmin['choiceValue']?></option>
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
      <select class="formMenufield_Medium" name="NewsContributor" id="NewsContributor" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","NewsContributor"):"")); ?>" tabindex="10" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuNewsContributor['choiceTitle']?>"<?php if (!(strcmp($row_WADAMenuNewsContributor['choiceTitle'], (isset($_GET["invalid"])?ValidatedField("userlogininsert","NewsContributor"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuNewsContributor['choiceTitle']?></option>
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
      <select class="formMenufield_Medium" name="venueAdmin" id="venueAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","venueAdmin"):"")); ?>" tabindex="11" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuvenueAdmin['choiceTitle']?>"<?php if (!(strcmp($row_WADAMenuvenueAdmin['choiceTitle'], (isset($_GET["invalid"])?ValidatedField("userlogininsert","venueAdmin"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuvenueAdmin['choiceTitle']?></option>
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
          <input type="submit" value="Insert" class="formButton Modular" id="Insert" name="Insert" />
        </span>
        </fieldset>
</form></div><div id="Insert_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Default', 'Insert_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Insert_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Insert_Basic_Default_Opts = {
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
function Insert_Basic_Default_Validate() {
    $("#Insert_Basic_Default").h5Validate(Insert_Basic_Default_Opts);
  }
$(document).ready(function () {
  Insert_Basic_Default_Validate()
  ConvertServerErrors(Insert_Basic_Default_Opts);
});
</script>

</body>
</html>
<?php
mysql_free_result($WADAMenuvenueAdmin);
?>
<?php
mysql_free_result($WADAMenuNewsContributor);
?>
<?php
mysql_free_result($WADAMenuEventAdmin);
?>
<?php
mysql_free_result($WADAMenutourneyAdmin);
?>
