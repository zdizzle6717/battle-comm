<?php require_once('Connections/local.php'); ?>
<?php require_once("webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once( "webassist/security_assist/helper_php.php" ); ?>
<?php require_once("webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
 if ((isset($_POST["Registration_submit"]) || isset($_POST["Registration_submit_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_registration_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_POST["Registration_group_Email_Address"])?$_POST["Registration_group_Email_Address"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","".((isset($_SESSION["SecurityAssist_id"]))?$_SESSION["SecurityAssist_id"]:"0")  ."","email","',none,''","".((isset($_POST["Registration_group_Email_Address"]))?$_POST["Registration_group_Email_Address"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["Registration_group_2_Password"])?$_POST["Registration_group_2_Password"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateEL((isset($_POST["Registration_group_2_Password"])?$_POST["Registration_group_2_Password"]:"") . "",6,500,true,4);
  $WAFV_Errors .= WAValidateLE((isset($_POST["Registration_group_3_Confirm"])?$_POST["Registration_group_3_Confirm"]:"") . "",(isset($_POST["Registration_group_3_Confirm"])?$_POST["Registration_group_3_Confirm"]:"") . "",true,5);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["Registration_group_6_Handle_Nickname"])?$_POST["Registration_group_6_Handle_Nickname"]:"") . "",true,6);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","".((isset($_SESSION["SecurityAssist_id"]))?$_SESSION["SecurityAssist_id"]:"0")  ."","user_handle","',none,''","".((isset($_POST["Registration_group_6_Handle_Nickname"]))?$_POST["Registration_group_6_Handle_Nickname"]:"")  ."",true,7);
  $WAFV_Errors .= WAValidateLE((strtolower(isset($_POST["Security_Code"])?$_POST["Security_Code"]:"")) . "",((isset($_SESSION["captcha_Security_Code"]))?strtolower($_SESSION["captcha_Security_Code"]):"") . "",true,8);
  $WAFV_Errors .= WAValidateLE((strtolower(isset($_POST["Security_Answer"])?$_POST["Security_Answer"]:"")) . "",((isset($_SESSION["random_answer"]))?strtolower($_SESSION["random_answer"]):"") . "",true,9);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"registration");
   }
 }
 ?>
<?php 
// WA DataAssist Insert
if ((isset($_POST["Registration_submit"]) && $_POST["Registration_submit"] != "")) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_sessionName = "SecurityAssist_id";
  $WA_redirectURL = "loginB.php?success=1";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "email|password|activation_state|firstName|lastName|user_handle";
  $WA_fieldValuesStr = "".((isset($_POST["Registration_group_Email_Address"]))?$_POST["Registration_group_Email_Address"]:"")  ."" . $WA_AB_Split . "".((($_POST["Registration_group_2_Password"] != ""))?WA_MD5Encryption($_POST["Registration_group_2_Password"]):$row_SecurityAssistuserlogin["password"])  ."" . $WA_AB_Split . "1" . $WA_AB_Split . "".((isset($_POST["Registration_group_4_First_Name"]))?$_POST["Registration_group_4_First_Name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["Registration_group_5_Last_Name"]))?$_POST["Registration_group_5_Last_Name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["Registration_group_6_Handle_Nickname"]))?$_POST["Registration_group_6_Handle_Nickname"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|none,none,NULL|',none,''|',none,''|',none,''";
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
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: Register</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/magnificent-popup/magnificent-popup.css">
    <link href="Styles/form-blue.css" rel="stylesheet" type="text/css">
    <link href="webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="webassist/jq_validation/Bloom.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="webassist/forms/fd_newfromblank_default.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="Scripts/jquery.magnificant-popup.js"></script>
    <script src="webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
    <script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "loggedInPlayer" */
       jQuery.dmxDataSet(
         {"id": "loggedInPlayer", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "loggedInPlayer" */
    </script>
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
    The Email Address you entered is already in use.  Please <a href="loginA.php">Log in</a> or use a different Email Address.
<?php //WAFV_Conditional registration.php registration(2:)
    }
  }
}?>
  <?php
if (ValidatedField('registration','registration'))  {
  if ((strpos((",".ValidatedField("registration","registration").","), "," . "7" . ",") !== false || "7" == ""))  {
    if (!(false))  {
?>
    The Handle/Nickname you entered is already in use.  Please choose a different one.
  <?php //WAFV_Conditional registration.php registration(7:)
    }
  }
}?>
</p>
<?php } // End Show Region ?>
<div id="RegistrationContainer" class="WAATK">
  <div id="Registration_Basic_Default_ProgressWrapper">
    <form class="formoid-default-skyblue" id="Registration_Basic_Default" name="Registration_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
            <span class="fieldsetDescription"> Required = * </span>
      <fieldset class="Basic_Default" id="Registration">
     <div class="two_column_1">
        <div class="lineGroup">
          <label for="Registration_group_6_Handle_Nickname" class="sublabel" > Handle/Nickname:<span class="requiredIndicator">&nbsp;*</span></label>
          <input id="Registration_group_6_Handle_Nickname" name="Registration_group_6_Handle_Nickname" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registration","Registration_group_6_Handle_Nickname"):"")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value." required="true">
          <?php
if (ValidatedField('registration','registration'))  {
  if ((strpos((",".ValidatedField("registration","registration").","), "," . "6" . ",") !== false || "6" == "") || (strpos((",".ValidatedField("registration","registration").","), "," . "7" . ",") !== false || "7" == ""))  {
    if (!(false))  {
?>
            <span class="serverInvalidState" id="Registration_group_6_Handle_Nickname_ServerError">Please enter a Handle.</span>
            <?php //WAFV_Conditional registration.php registration(6,7:)
    }
  }
}?>
        </div>
        <div class="lineGroup">
          <label for="Registration_group_Email_Address" class="sublabel" > Email Address:<span class="requiredIndicator">&nbsp;*</span></label>
          <input id="Registration_group_Email_Address" name="Registration_group_Email_Address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registration","Registration_group_Email_Address"):"")); ?>" class="formTextfield_Large" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
          <?php
if (ValidatedField('registration','registration'))  {
  if ((strpos((",".ValidatedField("registration","registration").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("registration","registration").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?>
            <span class="serverInvalidState" id="Registration_group_Email_Address_ServerError">Please enter valid Email Address.</span>
            <?php //WAFV_Conditional registration.php registration(1,2:)
    }
  }
}?>
        </div>
        <div class="lineGroup">
          <label for="Registration_group_2_Password" class="sublabel" > Password:<span class="requiredIndicator">&nbsp;*</span></label>
          <input id="Registration_group_2_Password" name="Registration_group_2_Password" type="password" value="" class="formPasswordfield_Large" tabindex="2" title="Password strength requirement not met. @@strengthmessage@@" confirm="" required="true">
          <?php
if (ValidatedField('registration','registration'))  {
  if ((strpos((",".ValidatedField("registration","registration").","), "," . "3" . ",") !== false || "3" == "") || (strpos((",".ValidatedField("registration","registration").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?>
            <span class="serverInvalidState" id="Registration_group_2_Password_ServerError">Password strength requirement not met. @@strengthmessage@@</span>
            <?php //WAFV_Conditional registration.php registration(3,4:)
    }
  }
}?>
        </div>
        <div class="lineGroup">
          <label for="Registration_group_3_Confirm" class="sublabel" > Confirm:<span class="requiredIndicator">&nbsp;*</span></label>
          <input id="Registration_group_3_Confirm" name="Registration_group_3_Confirm" type="password" value="" class="formPasswordfield_Large" tabindex="3" title="A value is required." confirm="Registration_group_2_Password" required="true">
          <?php
if (ValidatedField('registration','registration'))  {
  if ((strpos((",".ValidatedField("registration","registration").","), "," . "5" . ",") !== false || "5" == ""))  {
    if (!(false))  {
?>
            <span class="serverInvalidState" id="Registration_group_3_Confirm_ServerError">Passwords Do not Match</span>
            <?php //WAFV_Conditional registration.php registration(5:)
    }
  }
}?>
        </div>
        <div class="lineGroup">
          <label for="Registration_group_4_First_Name" class="sublabel" > First Name:</label>
          <input id="Registration_group_4_First_Name" name="Registration_group_4_First_Name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registration","Registration_group_4_First_Name"):"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
        </div>
    </div>
    <div class="two_column_1">
        <div class="lineGroup">
          <label for="Registration_group_5_Last_Name" class="sublabel" > Last Name:</label>
          <input id="Registration_group_5_Last_Name" name="Registration_group_5_Last_Name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registration","Registration_group_5_Last_Name"):"")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
        </div>
        <div class="lineGroup">
          <label for="Security_Code" class="sublabel" >&nbsp;</label>
          <label for="Security_Answer_2" class="sublabel" >&nbsp;</label>
          <img src="webassist/captcha/wavt_captchasecurityimages.php?field=Security_Code&amp;noisefreq=15&amp;noisecolor=060606&amp;gridcolor=080808&amp;font=fonts/MOM_T___.TTF&amp;textcolor=040404" alt="Security Code" class="Captcha">
          <div class="fullColumnGroup" style="clear:left;">
            <label for="Security_Code" class="sublabel" > Security code:<span class="requiredIndicator">&nbsp;*</span></label>
            <input id="Security_Code" name="Security_Code" type="text" value="" class="formTextfield_Large" tabindex="7" title="Please enter a value" required="true">
            <?php
if (ValidatedField('registration','registration'))  {
  if ((strpos((",".ValidatedField("registration","registration").","), "," . "8" . ",") !== false || "8" == ""))  {
    if (!(false))  {
?>
              <span class="serverInvalidState" id="Security_Code_ServerError">Please enter a value</span>
              <?php //WAFV_Conditional registration.php registration(8:)
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
            <input id="Security_Answer" name="Security_Answer" type="text" value="" class="formTextfield_Large" tabindex="8" title="Please enter a value" required="true">
            <?php
if (ValidatedField('registration','registration'))  {
  if ((strpos((",".ValidatedField("registration","registration").","), "," . "9" . ",") !== false || "9" == ""))  {
    if (!(false))  {
?>
              <span class="serverInvalidState" id="Security_Answer_ServerError">Please enter a value</span>
              <?php //WAFV_Conditional registration.php registration(9:)
    }
  }
}?>
          </div>
        </div>
        </div>
        <div class="center float_left">
        <span class="buttonFieldGroup" >
          <input id="Hidden_Field" name="Hidden_Field" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("registration","Hidden_Field"):"")); ?>">
          <input class="formButton" name="Registration_submit" type="submit" id="Registration_submit" value="Register"  onClick="clearAllServerErrors('Registration_Basic_Default')" tabindex="9">
        </span>
        </div>
      </fieldset>
    </form>
  </div>
  <div id="Registration_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
    <script type="text/javascript">
WADFP_SetProgressToForm('Registration_Basic_Default', 'Registration_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
  </script>
    <div id="Registration_Basic_Default_ProgressMessage" >
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
                <h3><a href="#test-popup" class="open-popup-link" >...And many, many more--&gt;</a></h3>
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