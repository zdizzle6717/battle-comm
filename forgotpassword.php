<?php require_once("webassist/security_assist/wa_md5encryption.php"); ?>
<?php require_once("webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once('Connections/local.php'); ?>
<?php 
 if ((isset($_POST["ForgotPassword_submit"]) || isset($_POST["ForgotPassword_submit_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_forgotpassword_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_POST["Forgot_Password_group_Email_Address"])?$_POST["Forgot_Password_group_Email_Address"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateLE((strtolower(isset($_POST["Security_Code"])?$_POST["Security_Code"]:"")) . "",((isset($_SESSION["captcha_Security_Code"]))?strtolower($_SESSION["captcha_Security_Code"]):"") . "",true,2);
  $WAFV_Errors .= WAValidateLE((strtolower(isset($_POST["Security_Answer"])?$_POST["Security_Answer"]:"")) . "",((isset($_SESSION["random_answer"]))?strtolower($_SESSION["random_answer"]):"") . "",true,3);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"forgotpassword");
   }
 }
 ?>
<?php require_once( "webassist/security_assist/helper_php.php" ); ?>
<?php 
 if ((isset($_POST["ResetPassword_submit"]) || isset($_POST["ResetPassword_submit_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_forgotpassword_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_POST["Reset_Password_group_Email_Address"])?$_POST["Reset_Password_group_Email_Address"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["Reset_Password_group_2_Password"])?$_POST["Reset_Password_group_2_Password"]:"") . "",true,2);
  $WAFV_Errors .= WAValidateEL((isset($_POST["Reset_Password_group_2_Password"])?$_POST["Reset_Password_group_2_Password"]:"") . "",6,500,true,3);
  $WAFV_Errors .= WAValidateLE((isset($_POST["Reset_Password_group_3_Confirm"])?$_POST["Reset_Password_group_3_Confirm"]:"") . "",(isset($_POST["Reset_Password_group_3_Confirm"])?$_POST["Reset_Password_group_3_Confirm"]:"") . "",true,4);
  $WAFV_Errors .= WAValidateLE((strtolower(isset($_POST["Security_Code"])?$_POST["Security_Code"]:"")) . "",((isset($_SESSION["captcha_Security_Code"]))?strtolower($_SESSION["captcha_Security_Code"]):"") . "",true,5);
  $WAFV_Errors .= WAValidateLE((strtolower(isset($_POST["Security_Answer"])?$_POST["Security_Answer"]:"")) . "",((isset($_SESSION["random_answer"]))?strtolower($_SESSION["random_answer"]):"") . "",true,6);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"forgotpassword");
   }
 }
 ?>
<?php
if ((isset($_POST["ResetPassword_submit"])&&(isset($_COOKIE["RememberMePWD"]))&&(isset($_POST["Reset_Password_group_2_Password"])) && $_POST["Reset_Password_group_2_Password"] != "")) {
	setcookie("RememberMePWD", "".((isset($_POST["Reset_Password_group_2_Password"]))?$_POST["Reset_Password_group_2_Password"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["ResetPassword_submit"])&&(isset($_COOKIE["RememberMeUN"]))&&(isset($_POST["Reset_Password_group_Email_Address"])) && $_POST["Reset_Password_group_Email_Address"] != "")) {
	setcookie("RememberMeUN", "".((isset($_POST["Reset_Password_group_Email_Address"]))?$_POST["Reset_Password_group_Email_Address"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["ResetPassword_submit"])&&(isset($_COOKIE["AutoLoginPWD"]))&&(isset($_POST["Reset_Password_group_2_Password"])) && $_POST["Reset_Password_group_2_Password"] != "")) {
	setcookie("AutoLoginPWD", "".((isset($_POST["Reset_Password_group_2_Password"]))?$_POST["Reset_Password_group_2_Password"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["ResetPassword_submit"])&&(isset($_COOKIE["AutoLoginUN"]))&&(isset($_POST["Reset_Password_group_Email_Address"])) && $_POST["Reset_Password_group_Email_Address"] != "")) {
	setcookie("AutoLoginUN", "".((isset($_POST["Reset_Password_group_Email_Address"]))?$_POST["Reset_Password_group_Email_Address"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php require_once("webassist/database_management/wa_appbuilder_php.php"); ?>
<?php
function WA_SecurityAssist_Email_1_EncryptedReturn($tParams){ //Encrypted Return
	global $WA_Auth_Parameter;
	$WA_Auth_Parameter = $tParams;
}// WA_SecurityAssist_Email_1_EncryptedReturn
?>
<?php
if(isset($_GET["fp_data"]) && isset($_GET["fp_id"]) && isset($_GET["fp_email"])){
	//WA SecurityAssist Encrypted Email Return
  $WA_Auth_Parameter = array(
	"encryptedreturn" => true,
	"connection" => $local,
  	"database" => $database_local,
	"tableName" => "user_login",
	"keyColumn" => "id",
	"columnType" => "int",
	"usernameColumn" => "email",
	"usernameEncryption" => "",
	"passwordColumn" => "password",
	"passwordEncryption" => "md5",
	"failRedirect" => "forgotpassword.php?badURL=1",
	"toAddressColumn" => "email",
	"toAddressEncryption" => "",
	"returnFunction" => "WA_SecurityAssist_Email_1_EncryptedReturn"
	);

	WA_Auth_ForgotEncryptedPasswordReturn($WA_Auth_Parameter);
}?>
<?php 
// WA DataAssist Update
if ((WA_Auth_RulePasses("Encrypted email return set") && WA_Auth_RulePasses("Encrypted email return success") && isset($_POST["ResetPassword_submit"]) && $_POST["ResetPassword_submit"] != "")) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_redirectURL = "login.php?fpsuccess=1";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "email|password";
  $WA_fieldValuesStr = "".((isset($_POST["Reset_Password_group_Email_Address"]))?$_POST["Reset_Password_group_Email_Address"]:"")  ."" . $WA_AB_Split . "".((($_POST["Reset_Password_group_2_Password"] != ""))?WA_MD5Encryption($_POST["Reset_Password_group_2_Password"]):$row_SecurityAssistuserlogin["*password*"])  ."";
  $WA_columnTypesStr = "',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE ";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  
  $WA_where_fieldValuesStr = "".((isset($_GET["fp_id"]))?$_GET["fp_id"]:"")  ."";
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
<?php
function WA_SecurityAssist_Email_1_SendEncryptedMail($WA_Auth_Parameter){ //Encrypted
  $WA_MailObject = WA_SecurityAssist_Definition("","","","","","");
  $WA_MailObject = WA_SecurityAssist_SendMail($WA_MailObject,"","","",$WA_Auth_Parameter["toAddress"],"",$WA_Auth_Parameter["fromAddress"],$WA_Auth_Parameter["subject"],$WA_Auth_Parameter["mailBody"]);
  $WA_MailObject = null;
}// WA_SecurityAssist_Email_1_SendEncryptedMail
?>
<?php
if(isset($_POST["ForgotPassword_submit"])){
	//WA SecurityAssist Encrypted Email object="mail"
  $WA_Auth_Parameter = array(
	"encrypted" => true,
	"connection" => $local,
  	"database" => $database_local,
	"tableName" => "user_login",
	"keyColumn" => "id",
	"filterColumn" => "email",
	"filterEncryption" => "",
	"columnValue" => "".((isset($_POST["Forgot_Password_group_Email_Address"]))?$_POST["Forgot_Password_group_Email_Address"]:"")  ."",
	"columnType" => "text",
	"usernameColumn" => "email",
	"usernameEncryption" => "",
	"passwordColumn" => "password",
	"passwordEncryption" => "md5",
	"selectColumns" => array("email","password"),
	"sessionVariables" => array(""),
	"successRedirect" => "login.php?emailedPassword=1",
	"failRedirect" => "forgotpassword.php",
	"returnURL" => "forgotpassword.php",
	"keepQueryString" => TRUE,
	"toAddressColumn" => "email",
	"toAddressEncryption" => "",
	"fromAddress" => "do_not_reply@battle-comm.com",
	"fromAddressDisplay" => "Account Security",
	"subject" => "Your requested password Reset.",
	"mailBody" => "webassist/security_assist/email/forgotpassword_email2.php",
	"emailFunction" => "WA_SecurityAssist_Email_1_SendEncryptedMail"
	);

	WA_Auth_ForgotEncryptedPassword($WA_Auth_Parameter);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Email Forgotten Password</title>
	<link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
    <link href="webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" href="webassist/jq_validation/Bloom.css">
    <link href="Styles/form-blue.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="Scripts/jquery.magnificant-popup.js"></script>
</head>

<?php include 'Templates/parts/header.php'; ?>
        <?php include 'Templates/parts/container-top.php'; ?>
<?php if(WA_Auth_RulePasses("Validated form")){ // Begin Show Region ?>
<p>Invalid information, please check your entries and try again</p>
<?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Email address not found")){ // Begin Show Region ?>
<p>Your email address could not be found in our records. Please try again.</p>
<?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Email server failure")){ // Begin Show Region ?>
<p>Email failed to send.  Please confirm your email settings with your hosting provider.</p>
<?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Emailed password")){ // Begin Show Region ?>
  <p>Password information emailed, please check your inbox</p>
  <?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Bad return url from encryption email")){ // Begin Show Region ?>
  <p>A problem occured with your information.  Please attempt the forgotten password process again..</p>
  <?php } // End Show Region ?>
<?php if(!WA_Auth_RulePasses("Encrypted email return set")){ // Begin Show Region ?>
  <div id="ForgotPWContainer" class="WAATK">
    <div id="ForgotPassword_Basic_Default_ProgressWrapper">
      <form class="formoid-default-skyblue" id="ForgotPassword_Basic_Default" name="ForgotPassword_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Forgot_Password">
          <legend class="groupHeader">Forgot Password</legend>
          <span class="fieldsetDescription"> Required * </span>
          <div class="lineGroup">
            <label for="Forgot_Password_group_Email_Address" class="sublabel" > Email Address:<span class="requiredIndicator">&nbsp;*</span></label>
            <input id="Forgot_Password_group_Email_Address" name="Forgot_Password_group_Email_Address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("forgotpassword","Forgot_Password_group_Email_Address"):"")); ?>" class="formTextfield_Large" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
            <?php
if (ValidatedField('forgotpassword','forgotpassword'))  {
  if ((strpos((",".ValidatedField("forgotpassword","forgotpassword").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?>
              <span class="serverInvalidState" id="Forgot_Password_group_Email_Address_ServerError">Please enter a value.</span>
              <?php //WAFV_Conditional forgotpassword.php forgotpassword(1:)
    }
  }
}?>
          </div>
          <div class="lineGroup">
            <label for="Security_Code" class="sublabel" >&nbsp;</label>
            <img src="webassist/captcha/wavt_captchasecurityimages.php?field=Security_Code&amp;noisefreq=15&amp;noisecolor=060606&amp;gridcolor=080808&amp;font=fonts/MOM_T___.TTF&amp;textcolor=040404" alt="Security Code" class="Captcha">
            <div class="fullColumnGroup" style="clear:left;">
              <label for="Security_Code" class="sublabel" > Security code:<span class="requiredIndicator">&nbsp;*</span></label>
              <input id="Security_Code" name="Security_Code" type="text" value="" class="formTextfield_Large" tabindex="2" title="Please enter a value" required="true">
              <?php
if (ValidatedField('forgotpassword','forgotpassword'))  {
  if ((strpos((",".ValidatedField("forgotpassword","forgotpassword").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
                <span class="serverInvalidState" id="Security_Code_ServerError">Please enter a value</span>
                <?php //WAFV_Conditional forgotpassword.php forgotpassword(2:)
    }
  }
}?>
            </div>
          </div>
          <div class="lineGroup">
            <label for="Security_Answer_2" class="sublabel" >&nbsp;</label>
            <span class="precedingText">
              <?php require_once("webassist/captcha/wavt_captchasecurityquestion.php"); ?>
            </span>
            <div class="fullColumnGroup" style="clear:left;">
              <label for="Security_Answer" class="sublabel" > Answer:<span class="requiredIndicator">&nbsp;*</span></label>
              <input id="Security_Answer" name="Security_Answer" type="text" value="" class="formTextfield_Large" tabindex="3" title="Please enter a value" required="true">
              <?php
if (ValidatedField('forgotpassword','forgotpassword'))  {
  if ((strpos((",".ValidatedField("forgotpassword","forgotpassword").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?>
                <span class="serverInvalidState" id="Security_Answer_ServerError">Please enter a value</span>
                <?php //WAFV_Conditional forgotpassword.php forgotpassword(3:)
    }
  }
}?>
            </div>
          </div>
          <span class="buttonFieldGroup" >
            <input id="Hidden_Field" name="Hidden_Field" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("forgotpassword","Hidden_Field"):"")); ?>">
            <input class="formButton" name="ForgotPassword_submit" type="submit" id="ForgotPassword_submit" value="Send"  onClick="clearAllServerErrors('ForgotPassword_Basic_Default')" tabindex="4">
          </span>
        </fieldset>
      </form>
    </div>
    <div id="ForgotPassword_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
      <script type="text/javascript">
WADFP_SetProgressToForm('ForgotPassword_Basic_Default', 'ForgotPassword_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
      </script>
      <div id="ForgotPassword_Basic_Default_ProgressMessage" >
        <p style="margin:10px; padding:5px;" ><img src="webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
      </div>
    </div>
  </div>
  <?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Encrypted email return set")){ // Begin Show Region ?>
  <?php if(WA_Auth_RulePasses("Encrypted email return success")){ // Begin Show Region ?>
    <div id="ForgotPWContainer" class="WAATK">
      <div id="ResetPassword_Basic_Default_ProgressWrapper">
        <form class="Basic_Default" id="ResetPassword_Basic_Default" name="ResetPassword_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>?<?php echo preg_replace("/^&/", "", preg_replace("/&?invalid=true/", "", $_SERVER["QUERY_STRING"])); ?>">
          <fieldset class="Basic_Default" id="Reset_Password">
            <legend class="groupHeader">Reset Password</legend>
            <span class="fieldsetDescription"> Required * </span>
            <div class="lineGroup">
              <label for="Reset_Password_group_Email_Address" class="sublabel" > Email Address:<span class="requiredIndicator">&nbsp;*</span></label>
              <input id="Reset_Password_group_Email_Address" name="Reset_Password_group_Email_Address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("forgotpassword","Reset_Password_group_Email_Address"):"")); ?>" class="formTextfield_Large" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
              <?php
if (ValidatedField('forgotpassword','forgotpassword'))  {
  if ((strpos((",".ValidatedField("forgotpassword","forgotpassword").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?>
                <span class="serverInvalidState" id="Reset_Password_group_Email_Address_ServerError">Please enter a value.</span>
                <?php //WAFV_Conditional forgotpassword.php forgotpassword(1:)
    }
  }
}?>
            </div>
            <div class="lineGroup">
              <label for="Reset_Password_group_2_Password" class="sublabel" > Password:<span class="requiredIndicator">&nbsp;*</span></label>
              <input id="Reset_Password_group_2_Password" name="Reset_Password_group_2_Password" type="password" value="" class="formPasswordfield_Large" tabindex="2" title="Password strength requirement not met. @@strengthmessage@@" confirm="" required="true">
              <?php
if (ValidatedField('forgotpassword','forgotpassword'))  {
  if ((strpos((",".ValidatedField("forgotpassword","forgotpassword").","), "," . "2" . ",") !== false || "2" == "") || (strpos((",".ValidatedField("forgotpassword","forgotpassword").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?>
                <span class="serverInvalidState" id="Reset_Password_group_2_Password_ServerError">Password strength requirement not met. @@strengthmessage@@</span>
                <?php //WAFV_Conditional forgotpassword.php forgotpassword(2,3:)
    }
  }
}?>
            </div>
            <div class="lineGroup">
              <label for="Reset_Password_group_3_Confirm" class="sublabel" > Confirm:<span class="requiredIndicator">&nbsp;*</span></label>
              <input id="Reset_Password_group_3_Confirm" name="Reset_Password_group_3_Confirm" type="password" value="" class="formPasswordfield_Large" tabindex="3" title="A value is required." confirm="Reset_Password_group_2_Password" required="true">
              <?php
if (ValidatedField('forgotpassword','forgotpassword'))  {
  if ((strpos((",".ValidatedField("forgotpassword","forgotpassword").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?>
                <span class="serverInvalidState" id="Reset_Password_group_3_Confirm_ServerError">A value is required.</span>
                <?php //WAFV_Conditional forgotpassword.php forgotpassword(4:)
    }
  }
}?>
            </div>
            <div class="lineGroup">
              <label for="Security_Code" class="sublabel" >&nbsp;</label>
              <img src="webassist/captcha/wavt_captchasecurityimages.php?field=Security_Code&amp;noisefreq=15&amp;noisecolor=060606&amp;gridcolor=080808&amp;font=fonts/MOM_T___.TTF&amp;textcolor=040404" alt="Security Code" class="Captcha">
              <div class="fullColumnGroup" style="clear:left;">
                <label for="Security_Code" class="sublabel" > Security code:<span class="requiredIndicator">&nbsp;*</span></label>
                <input id="Security_Code" name="Security_Code" type="text" value="" class="formTextfield_Large" tabindex="4" title="Please enter a value" required="true">
                <?php
if (ValidatedField('forgotpassword','forgotpassword'))  {
  if ((strpos((",".ValidatedField("forgotpassword","forgotpassword").","), "," . "5" . ",") !== false || "5" == ""))  {
    if (!(false))  {
?>
                  <span class="serverInvalidState" id="Security_Code_ServerError">Please enter a value</span>
                  <?php //WAFV_Conditional forgotpassword.php forgotpassword(5:)
    }
  }
}?>
              </div>
            </div>
            <div class="lineGroup">
              <label for="Security_Answer_2" class="sublabel" >&nbsp;</label>
              <span class="precedingText">
                <?php require_once("webassist/captcha/wavt_captchasecurityquestion.php"); ?>
              </span>
              <div class="fullColumnGroup" style="clear:left;">
                <label for="Security_Answer" class="sublabel" > Answer:<span class="requiredIndicator">&nbsp;*</span></label>
                <input id="Security_Answer" name="Security_Answer" type="text" value="" class="formTextfield_Large" tabindex="5" title="Please enter a value" required="true">
                <?php
if (ValidatedField('forgotpassword','forgotpassword'))  {
  if ((strpos((",".ValidatedField("forgotpassword","forgotpassword").","), "," . "6" . ",") !== false || "6" == ""))  {
    if (!(false))  {
?>
                  <span class="serverInvalidState" id="Security_Answer_ServerError">Please enter a value</span>
                  <?php //WAFV_Conditional forgotpassword.php forgotpassword(6:)
    }
  }
}?>
              </div>
            </div>
            <span class="buttonFieldGroup" >
              <input id="Hidden_Field" name="Hidden_Field" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("forgotpassword","Hidden_Field"):"")); ?>">
              <input class="formButton" name="ResetPassword_submit" type="submit" id="ResetPassword_submit" value="Reset"  onClick="clearAllServerErrors('ResetPassword_Basic_Default')" tabindex="6">
            </span>
          </fieldset>
        </form>
      </div>
      <div id="ResetPassword_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
        <script type="text/javascript">
WADFP_SetProgressToForm('ResetPassword_Basic_Default', 'ResetPassword_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
        </script>
        <div id="ResetPassword_Basic_Default_ProgressMessage" >
          <p style="margin:10px; padding:5px;" ><img src="webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
        </div>
      </div>
    </div>
    <?php } // End Show Region ?>
  <?php if(!WA_Auth_RulePasses("Encrypted email return success")){ // Begin Show Region ?>
    <p>Error - please <a>log in</a> to access this site.</p>
    <?php } // End Show Region ?>
  <?php } // End Show Region ?>
<script src="webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var ForgotPassword_Basic_Default_Opts = {
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
function ForgotPassword_Basic_Default_Validate() {
    $("#ForgotPassword_Basic_Default").h5Validate(ForgotPassword_Basic_Default_Opts);
  }
$(document).ready(function () {
  ForgotPassword_Basic_Default_Validate()
  ConvertServerErrors(ForgotPassword_Basic_Default_Opts);
});
</script>
<script src="webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script>
var ResetPassword_Basic_Default_Opts = {
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
function ResetPassword_Basic_Default_Validate() {
    $("#ResetPassword_Basic_Default").h5Validate(ResetPassword_Basic_Default_Opts);
  }
$(document).ready(function () {
  ResetPassword_Basic_Default_Validate()
  ConvertServerErrors(ResetPassword_Basic_Default_Opts);
});
</script>
	<?php include 'Templates/parts/container-bottom.php'; ?>
<?php include 'Templates/parts/footer.php'; ?>
