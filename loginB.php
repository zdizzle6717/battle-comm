<?php
@session_start();
?>
<?php require_once("webassist/security_assist/wa_md5encryption.php"); ?>
<?php require_once('Connections/local.php'); ?>
<?php require_once("webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once( "webassist/security_assist/helper_php.php" ); ?>
<?php
 if ((isset($_POST["LogIn_submit"]) || isset($_POST["LogIn_submit_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_login_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_POST["Log_In_group_Email_Address"])?$_POST["Log_In_group_Email_Address"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["Log_In_group_2_Password"])?$_POST["Log_In_group_2_Password"]:"") . "",true,2);
  $WAFV_Errors .= WAValidateEL((isset($_POST["Log_In_group_2_Password"])?$_POST["Log_In_group_2_Password"]:"") . "",6,500,true,3);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"login");
   }
 }
 ?>
<?php
if ((isset($_POST["LogIn_submit"])&&(!isset($_POST["Log_In_group_3_Remember_my_information"])) && $_POST["LogIn_submit"] != "")) {
	setcookie("RememberMePWD", "", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["LogIn_submit"])&&(!isset($_POST["Log_In_group_3_Remember_my_information"])) && $_POST["LogIn_submit"] != "")) {
	setcookie("RememberMeUN", "", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["LogIn_submit"])&&(isset($_POST["Log_In_group_3_Remember_my_information"])) && $_POST["Log_In_group_3_Remember_my_information"] != "")) {
	setcookie("RememberMePWD", "".((isset($_POST["Log_In_group_2_Password"]))?$_POST["Log_In_group_2_Password"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["LogIn_submit"])&&(isset($_POST["Log_In_group_3_Remember_my_information"])) && $_POST["Log_In_group_3_Remember_my_information"] != "")) {
	setcookie("RememberMeUN", "".((isset($_POST["Log_In_group_Email_Address"]))?$_POST["Log_In_group_Email_Address"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["LogIn_submit"])&&(!isset($_POST["Log_In_group_4_Log_me_in_automatically"])) && $_POST["LogIn_submit"] != "")) {
	setcookie("AutoLoginPWD", "", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["LogIn_submit"])&&(!isset($_POST["Log_In_group_4_Log_me_in_automatically"])) && $_POST["LogIn_submit"] != "")) {
	setcookie("AutoLoginUN", "", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["LogIn_submit"])&&(isset($_POST["Log_In_group_4_Log_me_in_automatically"])) && $_POST["Log_In_group_4_Log_me_in_automatically"] != "")) {
	setcookie("AutoLoginPWD", "".((isset($_POST["Log_In_group_2_Password"]))?$_POST["Log_In_group_2_Password"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if ((isset($_POST["LogIn_submit"])&&(isset($_POST["Log_In_group_4_Log_me_in_automatically"])) && $_POST["Log_In_group_4_Log_me_in_automatically"] != "")) {
	setcookie("AutoLoginUN", "".((isset($_POST["Log_In_group_Email_Address"]))?$_POST["Log_In_group_Email_Address"]:"")  ."", time()+(60*60*24*30), "/", "", 0);
}
?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$WA_Auth_Parameter = array(
	"connection" => $local,
	"database" => $database_local,
	"tableName" => "user_login",
	"columns" => explode($WA_Auth_Separator,"email".$WA_Auth_Separator."password"),
	"columnValues" => explode($WA_Auth_Separator,"".((isset($_POST["Log_In_group_Email_Address"]))?$_POST["Log_In_group_Email_Address"]:"")  ."".$WA_Auth_Separator."".(WA_MD5Encryption((isset($_POST["Log_In_group_2_Password"]))?$_POST["Log_In_group_2_Password"]:""))  .""),
	"columnTypes" => explode($WA_Auth_Separator,"text".$WA_Auth_Separator."text"),
	"sessionColumns" => explode($WA_Auth_Separator,"id".$WA_Auth_Separator."activation_state".$WA_Auth_Separator."firstName".$WA_Auth_Separator."lastName".$WA_Auth_Separator."tourneyAdmin".$WA_Auth_Separator."EventAdmin".$WA_Auth_Separator."venueAdmin".$WA_Auth_Separator."NewsContributor".$WA_Auth_Separator."siteAdmin".$WA_Auth_Separator."clubAdmin"),
	"sessionNames" => explode($WA_Auth_Separator,"SecurityAssist_id".$WA_Auth_Separator."activation_state".$WA_Auth_Separator."firstName".$WA_Auth_Separator."lastName".$WA_Auth_Separator."tourneyAdmin".$WA_Auth_Separator."EventAdmin".$WA_Auth_Separator."venueAdmin".$WA_Auth_Separator."NewsContributor".$WA_Auth_Separator."siteAdmin".$WA_Auth_Separator."clubAdmin"),
	"successRedirect" => "players/index.php",
	"failRedirect" => "loginA.php?failedLogin=1",
	"gotoPreviousURL" => TRUE,
	"keepQueryString" => TRUE
	);

	WA_AuthenticateUser($WA_Auth_Parameter);
}
?>
<?php
if((((isset($_SESSION["SecurityAssist_id"]) && $_SESSION["SecurityAssist_id"] != "")?"LoggedIn":"") == "")&&(((isset($_COOKIE["AutoLoginUN"]))?$_COOKIE["AutoLoginUN"]:"") != "")&&(((isset($_COOKIE["AutoLoginPWD"]))?$_COOKIE["AutoLoginPWD"]:"") != "")){
	$WA_Auth_Parameter = array(
	"connection" => $local,
	"database" => $database_local,
	"tableName" => "user_login",
	"columns" => explode($WA_Auth_Separator,"email".$WA_Auth_Separator."password"),
	"columnValues" => explode($WA_Auth_Separator,"".((isset($_COOKIE["AutoLoginUN"]))?$_COOKIE["AutoLoginUN"]:"")  ."".$WA_Auth_Separator."".(WA_MD5Encryption((isset($_COOKIE["AutoLoginPWD"]))?$_COOKIE["AutoLoginPWD"]:""))  .""),
	"columnTypes" => explode($WA_Auth_Separator,"text".$WA_Auth_Separator."text"),
	"sessionColumns" => explode($WA_Auth_Separator,"id".$WA_Auth_Separator."activation_state".$WA_Auth_Separator."firstName".$WA_Auth_Separator."lastName"),
	"sessionNames" => explode($WA_Auth_Separator,"SecurityAssist_id".$WA_Auth_Separator."activation_state".$WA_Auth_Separator."firstName".$WA_Auth_Separator."lastName"),
	"successRedirect" => "players/index.php",
	"failRedirect" => "loginA.php",
	"gotoPreviousURL" => TRUE,
	"keepQueryString" => TRUE
	);

	WA_AuthenticateUser($WA_Auth_Parameter);
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BattleComm: Log In</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/magnificent-popup/magnificent-popup.css">
    <link href="Styles/form-blue.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="Scripts/jquery.magnificant-popup.js"></script>
	<script type="text/javascript" src="Scripts/mobile-toggle.js"></script>
    <script type="text/javascript" src="Scripts/backtotop.js"></script>
    <script src="webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<link href="webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="webassist/jq_validation/Bloom.css">
</head>
<?php include 'Templates/parts/header.php'; ?>
        <?php include 'Templates/parts/container-top.php'; ?>
			<div class="two_column_1">
<div id="LogInContainer" class="WAATK">
  <div id="LogIn_Basic_Default_ProgressWrapper">
    <form class="formoid-default-skyblue side_by_side" id="LogIn_Basic_Default" style="max-width:760px" name="LogIn_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
      <fieldset class="Basic_Default no_padding no_margin" id="Log_In">
        <legend class="groupHeader"><h1 class="headerseo center">Login</h1></legend>
        <span class="fieldsetDescription"> Required = * </span>
        <div class="lineGroup">
          <label for="Log_In_group_Email_Address" class="sublabel" > Email Address:<span class="requiredIndicator">&nbsp;*</span></label>
          <input id="Log_In_group_Email_Address" name="Log_In_group_Email_Address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("login","Log_In_group_Email_Address"):"".((isset($_COOKIE["RememberMeUN"]))?$_COOKIE["RememberMeUN"]:"")  ."")); ?>" class="formTextfield_Large" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
          <?php
if (ValidatedField('login','login'))  {
  if ((strpos((",".ValidatedField("login","login").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?>
            <span class="serverInvalidState" id="Log_In_group_Email_Address_ServerError">Please enter a value.</span>
            <?php //WAFV_Conditional login.php login(1:)
    }
  }
}?>
        </div>
        <div class="lineGroup">
          <label for="Log_In_group_2_Password" class="sublabel" > Password:<span class="requiredIndicator">&nbsp;*</span></label>
          <input id="Log_In_group_2_Password" name="Log_In_group_2_Password" type="password" value="" class="formPasswordfield_Large" tabindex="2" title="Please enter a value." confirm="" required="true">
          <a href="forgotpassword.php">forgot password?</a>
          <?php
if (ValidatedField('login','login'))  {
  if ((strpos((",".ValidatedField("login","login").","), "," . "2" . ",") !== false || "2" == "") || (strpos((",".ValidatedField("login","login").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?>
            <span class="serverInvalidState" id="Log_In_group_2_Password_ServerError">Please enter a value.</span>
            <?php //WAFV_Conditional login.php login(2,3:)
    }
  }
}?>
        </div>
        <div class="lineGroup">
          <label class="checklabel" for="Log_In_group_3_Remember_my_information">
            <input type="checkbox" name="Log_In_group_3_Remember_my_information" id="Log_In_group_3_Remember_my_information" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("login","Log_In_group_3_Remember_my_information"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="3" title="Please enter a value">
            &nbsp;Remember my information</label>
        </div>
        <div class="lineGroup">
          <label class="checklabel" for="Log_In_group_4_Log_me_in_automatically">
            <input type="checkbox" name="Log_In_group_4_Log_me_in_automatically" id="Log_In_group_4_Log_me_in_automatically" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("login","Log_In_group_4_Log_me_in_automatically"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="4" title="Please enter a value">
            &nbsp;Log me in automatically</label>
        </div>
        <span class="buttonFieldGroup" >
          <input class="" name="LogIn_submit" type="submit" id="LogIn_submit" value="Log In"  onClick="clearAllServerErrors('LogIn_Basic_Default')" tabindex="5">
        </span>
      </fieldset>
	  <?php if(WA_Auth_RulePasses("Validated form")){ // Begin Show Region ?>
<p>Invalid username or password</p>
<?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Log in success")){ // Begin Show Region ?>
<p>You have been logged in</p>
<?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Failed log in")){ // Begin Show Region ?>
<p>Invalid username or password</p>
<?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Emailed password")){ // Begin Show Region ?>
<p>Password information emailed, please check your inbox</p>
<?php } // End Show Region ?>
<?php if(WA_Auth_RulePasses("Successful update")){ // Begin Show Region ?>
<p>Registration completed successfully, please log in to access the site</p>
<?php } // End Show Region ?>
    </form>

  </div>
  <div id="LogIn_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
    <script type="text/javascript">
WADFP_SetProgressToForm('LogIn_Basic_Default', 'LogIn_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
  </script>
    <div id="LogIn_Basic_Default_ProgressMessage" >
      <p style="margin:10px; padding:5px;" ><img src="webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
    </div>
  </div>
</div>

<script src="webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var LogIn_Basic_Default_Opts = {
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
function LogIn_Basic_Default_Validate() {
    $("#LogIn_Basic_Default").h5Validate(LogIn_Basic_Default_Opts);
  }
$(document).ready(function () {
  LogIn_Basic_Default_Validate()
  ConvertServerErrors(LogIn_Basic_Default_Opts);
});
</script>
			</div>
<div class="two_column_1">
    <form class="formoid-default-skyblue side_by_side" style="max-width:590px;min-width:150px">
                <h2 class="no_shadow">Thank you for Registering</h2>
                <h4>Please login to access your account.</h4>
            <h2 class="no_shadow right">&nbsp;</h2>
	</form>
</div>
              </div>
                    </div>
                    <div class="frame_b row">
                        <div class="frame_b_bar_full col"></div>
                        <div class="frame_bl_corner col"></div>
                        <div class="frame_br_corner col"></div>
                    </div>
                </div>
            </div>
</div>

        <!-- FOOTER -->
        <div class="footer">
            <div class="sub-footer center" id="contact">
                <div class="three_column_1 subfooter_filler">
                </div>
                <div class="three_column_1 subfooter no_margin">
                    <img src="/images/Titles/Contact_Us.png" alt=""/>
    <h4 class="left">By Phone: (909) 343-5454</h4>
                    <h4 class="left">By E-mail: Contact@Battle-Comm.com</h4>
                    <h4 class="left">Address: 555 Boutel Dr.</h4>
                    <h4 class="indent left">Someplace, CA</h4>
                </div>
                <div class="three_column_1 subfooter">
                    <img src="/images/Titles/Follow_Us.png" alt=""/>
                    <?php $pathToFile = $_SERVER['DOCUMENT_ROOT'];
					include ($pathToFile. "/Templates/includes/social-links.php"); ?>
                </div>
            </div>
            <?php include ($pathToFile. "/Templates/includes/footer.php"); ?>
            <a href="#" id="backtotop" style="display: block;">
                <span class="fa fa-angle-up"></span>
                <span class="back-to-top">Top</span>
            </a>
        </div>
    </body>
</html>
