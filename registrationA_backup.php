<?php
require_once("webassist/security_assist/wa_randompassword.php");
?>
<?php require_once('Connections/local.php'); ?>
<?php require_once("webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once( "webassist/security_assist/helper_php.php" );?>
<?php
@session_start();
if ("" == "")     {
  $_SESSION["rpw"] = "".WA_RandomPassword(16, true, true, true, "!@#$%^*()-_.:,;")  ."";
}
?>
<?php require_once("webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
 if ((isset($_POST["Default_submit"]) || isset($_POST["Default_submit_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_registrationA_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["Registration_group_2_Password"])?$_POST["Registration_group_2_Password"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["Registration_group_3_Confirm"])?$_POST["Registration_group_3_Confirm"]:"") . "",true,2);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["handle"])?$_POST["handle"]:"") . "",true,3);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"registrationA");
   }
 }
 ?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Default_submit"]) || isset($_POST["Default_submit_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_sessionName = "SecurityAssist_id";
  $WA_redirectURL = "loginA.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "email|password|activation_key|activation_state|firstName|lastName|user_handle";
  $WA_fieldValuesStr = "".((isset($_POST["Registration_group_Email_Address"]))?$_POST["Registration_group_Email_Address"]:"")  ."" . $WA_AB_Split . "".((($_POST["Registration_group_2_Password"] != ""))?WA_MD5Encryption($_POST["Registration_group_2_Password"]):$row_SecurityAssistuserlogin["password"])  ."" . $WA_AB_Split . "".$_SESSION['rpw']  ."" . $WA_AB_Split . "1" . $WA_AB_Split . "".((isset($_POST["Registration_group_4_First_Name"]))?$_POST["Registration_group_4_First_Name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["Registration_group_5_Last_Name"]))?$_POST["Registration_group_5_Last_Name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["handle"]))?$_POST["handle"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|none,none,NULL|',none,''|',none,''|',none,''";
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
<?php require_once("webassist/security_assist/wa_md5encryption.php"); ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BattleComm: Player Registration</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/magnificent-popup/magnificent-popup.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="Scripts/jquery.magnificant-popup.js"></script>
	<script type="text/javascript" src="Scripts/mobile-toggle.js"></script>
    <script type="text/javascript" src="Scripts/backtotop.js"></script>
    <script src="webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<link href="webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="webassist/jq_validation/Bloom.css">
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="webassist/forms/fd_newfromblank_default.css" rel="stylesheet" type="text/css">
</head>

<?php include 'Templates/parts/header.php'; ?>
        <?php include 'Templates/parts/container-top-registration.php'; ?>
                        	<div class="full_width">
                            <?php if(WA_Auth_RulePasses("Validated form")){ // Begin Show Region ?>
<p>Invalid information, please check your entries and try again.
  <?php
if (ValidatedField('registration','registration'))  {
  if ((strpos((",".ValidatedField("registration","registration").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
    The value you entered for the Email Address field is already contained in our records.
  <?php //WAFV_Conditional registration.php registration(2:)
    }
  }
}?>
</p>
<?php } // End Show Region ?>
<div id="RegistrationContainer" class="WAATK">
  <div id="Default_NewFromBlank_Default_ProgressWrapper">
    <form class="NewFromBlank_Default" id="Default_NewFromBlank_Default" name="Default_NewFromBlank_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
      <!--
WebAssist CSS Form Builder - Form v1
CC: <New From Blank>
CP: Default
TC: <New From Blank>
TP: Default
-->
      <ul class="NewFromBlank_Default">
        <li>
          <fieldset class="NewFromBlank_Default" id="fieldset">
            <legend class="groupHeader"></legend>
            <ul class="formList">
              <li class="formItem"> <span class="fieldsetDescription"> Required * </span> </li>
              <li class="formItem">
                <div class="formGroup">
                  <div class="lineGroup">
                    <div class="fullColumnGroup">
                      <label for="Registration_group_Email_Address" class="sublabel" > Email Address:</label>
                      <input id="Registration_group_Email_Address" name="Registration_group_Email_Address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registrationA","Registration_group_Email_Address"):"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value">
                    </div>
                  </div>
                  <div class="lineGroup">
                    <div class="fullColumnGroup">
                      <label for="Registration_group_2_Password" class="sublabel" > Password:<span class="requiredIndicator">&nbsp;*</span></label>
                      <input id="Registration_group_2_Password" name="Registration_group_2_Password" type="password" value="" class="formPasswordfield_Large" tabindex="2" title="Please enter a value" confirm="" required="true">
                      <?php
if (ValidatedField('registrationA','registrationA'))  {
  if ((strpos((",".ValidatedField("registrationA","registrationA").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?>
                        <span class="serverInvalidState" id="Registration_group_2_Password_ServerError">Please enter a value</span>
                        <?php //WAFV_Conditional registrationA.php registrationA(1:)
    }
  }
}?>
                    </div>
                  </div>
                  <div class="lineGroup">
                    <div class="fullColumnGroup">
                      <label for="Registration_group_3_Confirm" class="sublabel" > Confirm:<span class="requiredIndicator">&nbsp;*</span></label>
                      <input id="Registration_group_3_Confirm" name="Registration_group_3_Confirm" type="password" value="" class="formPasswordfield_Large" tabindex="3" title="Please enter a value" confirm="Registration_group_2_Password" required="true">
                      <?php
if (ValidatedField('registrationA','registrationA'))  {
  if ((strpos((",".ValidatedField("registrationA","registrationA").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
                        <span class="serverInvalidState" id="Registration_group_3_Confirm_ServerError">Please enter a value</span>
                        <?php //WAFV_Conditional registrationA.php registrationA(2:)
    }
  }
}?>
                    </div>
                  </div>
                  <div class="lineGroup">
                    <div class="fullColumnGroup">
                      <label for="Registration_group_4_First_Name" class="sublabel" > First Name:</label>
                      <input id="Registration_group_4_First_Name" name="Registration_group_4_First_Name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registrationA","Registration_group_4_First_Name"):"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value">
                    </div>
                  </div>
                  <div class="lineGroup">
                    
                  </div>
                  <div class="lineGroup">
                    <div class="fullColumnGroup">
                      <label for="Registration_group_5_Last_Name" class="sublabel" > Last Name:</label>
                      <input id="Registration_group_5_Last_Name" name="Registration_group_5_Last_Name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registrationA","Registration_group_5_Last_Name"):"")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value">
                    </div>
                  </div>
                  <div class="fullColumnGroup">
                      <label for="handle" class="sublabel" > Handle:<span class="requiredIndicator">&nbsp;*</span></label>
                      <input id="handle" name="handle" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registrationA","handle"):"")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value" required="true">
                      <?php
if (ValidatedField('registrationA','registrationA'))  {
  if ((strpos((",".ValidatedField("registrationA","registrationA").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?>
                        <span class="serverInvalidState" id="handle_ServerError">Please enter a value</span>
                        <?php //WAFV_Conditional registrationA.php registrationA(3:)
    }
  }
}?>
                    </div>
                 <!-- <div class="lineGroup">
                    <div class="fullColumnGroup">
                      <label for="Security_Code" class="sublabel" > Security code:</label>
                      <input id="Security_Code" name="Security_Code" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registrationA","Security_Code"):"")); ?>" class="formTextfield_Large" tabindex="7" title="Please enter a value">
                    </div>
                  </div>-->
                 <!-- <div class="lineGroup">
                    <div class="fullColumnGroup">
                      <label for="Security_Answer" class="sublabel" > Answer:</label>
                      <input id="Security_Answer" name="Security_Answer" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registrationA","Security_Answer"):"")); ?>" class="formTextfield_Large" tabindex="8" title="Please enter a value">
                    </div>
                  </div>-->
                </div>
              </li>
              <li class="formItem"> <span class="buttonFieldGroup" >
                <input id="Hidden_Field" name="Hidden_Field" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registrationA","Hidden_Field"):"")); ?>">
                <input name="Default_submit" type="submit" class="formButton" id="Default_submit" formmethod="POST" tabindex="9"  onClick="clearAllServerErrors('Default_NewFromBlank_Default')" value="Register">
              </span> </li>
            </ul>
          </fieldset>
        </li>
      </ul>
    </form>
  </div>
  <div id="Default_NewFromBlank_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
    <script type="text/javascript">
WADFP_SetProgressToForm('Default_NewFromBlank_Default', 'Default_NewFromBlank_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
    </script>
    <div id="Default_NewFromBlank_Default_ProgressMessage" >
      <p style="margin:10px; padding:5px;" ><img src="webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
    </div>
  </div>
</div>
<script src="webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Registration_Basic_Default_Opts = {
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
function Registration_Basic_Default_Validate() {
    $("#Registration_Basic_Default").h5Validate(Registration_Basic_Default_Opts);
  }
$(document).ready(function () {
  Registration_Basic_Default_Validate()
  ConvertServerErrors(Registration_Basic_Default_Opts);
});
</script>
            				</div>

        	<div class="full_width image_constraint">
                <br>
                <h2>Games we support...</h2>
                <div class="four_column_1">
                    <img src="media/DZC_Logo_white_web_grande.png" alt="Dropzone Commander"> 
                </div>
                <div class="four_column_1">
                    <img src="media/fantasy_flight-SWX01.png" alt="Starwars X-Wing: Miniature Games"> 
                </div>
                <div class="four_column_1">
                    <img src="media/MTGlogo.png" alt=""> 
                </div>
                <div class="four_column_1">
                    <img src="media/LandingPageLogo_40k.png" alt=""> 
                </div>
            </div>
            <div class="full_width right">
                <h2><a href="#test-popup" class="open-popup-link" style="color: #efd64f; text-shadow:1px 1px black;">...And many, many more--&gt;</a></h2>
                <div id="test-popup" class="game-list-popup mfp-hide">
                  <?php include 'includes/full-game-list.php'; ?>
                </div>
                <script>
                    $('.open-popup-link').magnificPopup({
                      type:'inline',
                      midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
                    });
                </script>
            </div>
        <?php include 'Templates/parts/container-bottom.php'; ?>
        <?php include 'Templates/parts/footer.php'; ?>