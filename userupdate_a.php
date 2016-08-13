<?php require_once('Connections/local.php'); ?>
<?php require_once("webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once("webassist/security_assist/wa_md5encryption.php"); ?>
<?php require_once( "webassist/security_assist/helper_php.php" ); ?>
<?php require_once("webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
 if ((isset($_POST["UserUpdate_submit"]) || isset($_POST["UserUpdate_submit_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_userupdatea_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_POST["User_Update_group_Email_Address"])?$_POST["User_Update_group_Email_Address"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","".((isset($_SESSION["SecurityAssist_id"]))?$_SESSION["SecurityAssist_id"]:"0")  ."","email","',none,''","".((isset($_POST["User_Update_group_Email_Address"]))?$_POST["User_Update_group_Email_Address"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateEL((isset($_POST["User_Update_group_2_Password"])?$_POST["User_Update_group_2_Password"]:"") . "",6,500,false,3);
  $WAFV_Errors .= WAValidateLE((isset($_POST["User_Update_group_3_Confirm"])?$_POST["User_Update_group_3_Confirm"]:"") . "",(isset($_POST["User_Update_group_3_Confirm"])?$_POST["User_Update_group_3_Confirm"]:"") . "",false,4);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["User_Update_group_6_Handle_Nickname"])?$_POST["User_Update_group_6_Handle_Nickname"]:"") . "",true,5);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","".((isset($_SESSION["SecurityAssist_id"]))?$_SESSION["SecurityAssist_id"]:"0")  ."","user_handle","',none,''","".((isset($_POST["User_Update_group_6_Handle_Nickname"]))?$_POST["User_Update_group_6_Handle_Nickname"]:"")  ."",true,6);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userupdatea");
   }
 }
 ?>
<?php
if ((isset($_POST["UserUpdate_submit"])&&(isset($_COOKIE["RememberMePWD"]))&&(isset($_POST["User_Update_group_2_Password"])) && $_POST["User_Update_group_2_Password"] != "")) {
	setcookie("RememberMePWD", "".((isset($_POST["User_Update_group_2_Password"]))?$_POST["User_Update_group_2_Password"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["UserUpdate_submit"])&&(isset($_COOKIE["RememberMeUN"]))&&(isset($_POST["User_Update_group_Email_Address"])) && $_POST["User_Update_group_Email_Address"] != "")) {
	setcookie("RememberMeUN", "".((isset($_POST["User_Update_group_Email_Address"]))?$_POST["User_Update_group_Email_Address"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["UserUpdate_submit"])&&(isset($_COOKIE["AutoLoginPWD"]))&&(isset($_POST["User_Update_group_2_Password"])) && $_POST["User_Update_group_2_Password"] != "")) {
	setcookie("AutoLoginPWD", "".((isset($_POST["User_Update_group_2_Password"]))?$_POST["User_Update_group_2_Password"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["UserUpdate_submit"])&&(isset($_COOKIE["AutoLoginUN"]))&&(isset($_POST["User_Update_group_Email_Address"])) && $_POST["User_Update_group_Email_Address"] != "")) {
	setcookie("AutoLoginUN", "".((isset($_POST["User_Update_group_Email_Address"]))?$_POST["User_Update_group_Email_Address"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if (!WA_Auth_RulePasses("Logged in to user_login")){
	WA_Auth_RestrictAccess("login.php");
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
$Paramid_SecurityAssistuserlogin = "-1";
if (isset($_SESSION["SecurityAssist_id"])) {
  $Paramid_SecurityAssistuserlogin = $_SESSION["SecurityAssist_id"];
}
mysql_select_db($database_local, $local);
$query_SecurityAssistuserlogin = sprintf("SELECT * FROM user_login WHERE id = %s", $Paramid_SecurityAssistuserlogin);
$SecurityAssistuserlogin = mysql_query($query_SecurityAssistuserlogin, $local) or die(mysql_error());
$row_SecurityAssistuserlogin = mysql_fetch_assoc($SecurityAssistuserlogin);
$totalRows_SecurityAssistuserlogin = mysql_num_rows($SecurityAssistuserlogin);?>
<?php 
// WA DataAssist Update
if ((isset($_POST["UserUpdate_submit"]) && $_POST["UserUpdate_submit"] != "")) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_redirectURL = "userupdate_a.php?success=1";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "email|password|firstName|lastName|user_handle";
  $WA_fieldValuesStr = "".((isset($_POST["User_Update_group_Email_Address"]))?$_POST["User_Update_group_Email_Address"]:"")  ."" . $WA_AB_Split . "".((($_POST["User_Update_group_2_Password"] != ""))?WA_MD5Encryption($_POST["User_Update_group_2_Password"]):$row_SecurityAssistuserlogin["password"])  ."" . $WA_AB_Split . "".((isset($_POST["User_Update_group_4_First_Name"]))?$_POST["User_Update_group_4_First_Name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["User_Update_group_5_Last_Name"]))?$_POST["User_Update_group_5_Last_Name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["User_Update_group_6_Handle_Nickname"]))?$_POST["User_Update_group_6_Handle_Nickname"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE | LIKE ";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  
  $WA_where_fieldValuesStr = "".((isset($_SESSION["SecurityAssist_id"]))?$_SESSION["SecurityAssist_id"]:"")  ."";
  $WA_where_columnTypesStr = "none,none,NULL";
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
<title>Update User Information</title>
<script src="webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<link href="webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="webassist/jq_validation/Bloom.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
</head>

<body>
<?php if(WA_Auth_RulePasses("Validated form")){ // Begin Show Region ?>
<p>Invalid information, please check your entries and try again.
  <?php
if (ValidatedField('userupdate_a','userupdate_a'))  {
  if ((strpos((",".ValidatedField("userupdate_a","userupdate_a").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
    The value you entered for the Email Address field is already contained in our records.
  <?php //WAFV_Conditional userupdate_a.php userupdate_a(2:)
    }
  }
}?>
  <?php
if (ValidatedField('userupdate_a','userupdate_a'))  {
  if ((strpos((",".ValidatedField("userupdate_a","userupdate_a").","), "," . "6" . ",") !== false || "6" == ""))  {
    if (!(false))  {
?>
    The value you entered for the Handle/Nickname field is already contained in our records.
  <?php //WAFV_Conditional userupdate_a.php userupdate_a(6:)
    }
  }
}?>
</p>
<?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Successful update")){ // Begin Show Region ?>
<p>Information updated successfully</p>
<?php } // End Show Region ?>
<div id="UpdateContainer" class="WAATK">
  <?php if ($totalRows_SecurityAssistuserlogin > 0) { // Show if recordset not empty ?>
    <div id="UserUpdate_Basic_Default_ProgressWrapper">
      <form class="Basic_Default" id="UserUpdate_Basic_Default" name="UserUpdate_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="User_Update">
          <legend class="groupHeader">User Update</legend>
          <span class="fieldsetDescription"> Required * </span>
          <div class="lineGroup">
            <label for="User_Update_group_Email_Address" class="sublabel" > Email Address:<span class="requiredIndicator">&nbsp;*</span></label>
            <input id="User_Update_group_Email_Address" name="User_Update_group_Email_Address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userupdatea","User_Update_group_Email_Address"):"".$row_SecurityAssistuserlogin["email"]  ."")); ?>" class="formTextfield_Large" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
            <?php
if (ValidatedField('userupdatea','userupdatea'))  {
  if ((strpos((",".ValidatedField("userupdatea","userupdatea").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("userupdatea","userupdatea").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
              <span class="serverInvalidState" id="User_Update_group_Email_Address_ServerError">Please enter a value.</span>
              <?php //WAFV_Conditional userupdate_a.php userupdatea(1,2:)
    }
  }
}?>
          </div>
          <div class="lineGroup">
            <label for="User_Update_group_2_Password" class="sublabel" > Password:</label>
            <input id="User_Update_group_2_Password" name="User_Update_group_2_Password" type="password" value="" class="formPasswordfield_Large" tabindex="2" title="Password strength requirement not met. @@strengthmessage@@" confirm="">
            <?php
if (ValidatedField('userupdatea','userupdatea'))  {
  if ((strpos((",".ValidatedField("userupdatea","userupdatea").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?>
              <span class="serverInvalidState" id="User_Update_group_2_Password_ServerError">Password strength requirement not met. @@strengthmessage@@</span>
              <?php //WAFV_Conditional userupdate_a.php userupdatea(3:)
    }
  }
}?>
          </div>
          <div class="lineGroup">
            <label for="User_Update_group_3_Confirm" class="sublabel" > Confirm:</label>
            <input id="User_Update_group_3_Confirm" name="User_Update_group_3_Confirm" type="password" value="" class="formPasswordfield_Large" tabindex="3" title="A value is required." confirm="User_Update_group_2_Password">
            <?php
if (ValidatedField('userupdatea','userupdatea'))  {
  if ((strpos((",".ValidatedField("userupdatea","userupdatea").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?>
              <span class="serverInvalidState" id="User_Update_group_3_Confirm_ServerError">A value is required.</span>
              <?php //WAFV_Conditional userupdate_a.php userupdatea(4:)
    }
  }
}?>
          </div>
          <div class="lineGroup">
            <label for="User_Update_group_4_First_Name" class="sublabel" > First Name:</label>
            <input id="User_Update_group_4_First_Name" name="User_Update_group_4_First_Name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userupdatea","User_Update_group_4_First_Name"):"".$row_SecurityAssistuserlogin["firstName"]  ."")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
          </div>
          <div class="lineGroup">
            <label for="User_Update_group_5_Last_Name" class="sublabel" > Last Name:</label>
            <input id="User_Update_group_5_Last_Name" name="User_Update_group_5_Last_Name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userupdatea","User_Update_group_5_Last_Name"):"".$row_SecurityAssistuserlogin["lastName"]  ."")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
          </div>
          <div class="lineGroup">
            <label for="User_Update_group_6_Handle_Nickname" class="sublabel" > Handle/Nickname:<span class="requiredIndicator">&nbsp;*</span></label>
            <input id="User_Update_group_6_Handle_Nickname" name="User_Update_group_6_Handle_Nickname" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userupdatea","User_Update_group_6_Handle_Nickname"):"".$row_SecurityAssistuserlogin["user_handle"]  ."")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value." required="true">
            <?php
if (ValidatedField('userupdatea','userupdatea'))  {
  if ((strpos((",".ValidatedField("userupdatea","userupdatea").","), "," . "5" . ",") !== false || "5" == "") || (strpos((",".ValidatedField("userupdatea","userupdatea").","), "," . "6" . ",") !== false || "6" == ""))  {
    if (!(false))  {
?>
              <span class="serverInvalidState" id="User_Update_group_6_Handle_Nickname_ServerError">Please enter a value.</span>
              <?php //WAFV_Conditional userupdate_a.php userupdatea(5,6:)
    }
  }
}?>
          </div>
          <span class="buttonFieldGroup" >
            <input class="formButton" name="UserUpdate_submit" type="submit" id="UserUpdate_submit" value="Update"  onClick="clearAllServerErrors('UserUpdate_Basic_Default')" tabindex="7">
          </span>
        </fieldset>
      </form>
    </div>
    <div id="UserUpdate_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
      <script type="text/javascript">
WADFP_SetProgressToForm('UserUpdate_Basic_Default', 'UserUpdate_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
      </script>
      <div id="UserUpdate_Basic_Default_ProgressMessage" >
        <p style="margin:10px; padding:5px;" ><img src="webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
      </div>
    </div>
    <?php } // Show if recordset not empty ?>
  <?php if ($totalRows_SecurityAssistuserlogin == 0) { // Show if recordset empty ?>
    <p>No record found.</p>
    <?php } // Show if recordset empty ?>
</div>
<script src="webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var UserUpdate_Basic_Default_Opts = {
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
function UserUpdate_Basic_Default_Validate() {
    $("#UserUpdate_Basic_Default").h5Validate(UserUpdate_Basic_Default_Opts);
  }
$(document).ready(function () {
  UserUpdate_Basic_Default_Validate()
  ConvertServerErrors(UserUpdate_Basic_Default_Opts);
});
</script>
</body>
</html>
<?php
mysql_free_result($SecurityAssistuserlogin);
?>
