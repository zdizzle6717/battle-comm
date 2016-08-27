<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_gamecategoriesinsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["game_category"])?$_POST["game_category"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["WinPointValue"])?$_POST["WinPointValue"]:"") . "",true,2);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["lossPointValue"])?$_POST["lossPointValue"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["drawPointValue"])?$_POST["drawPointValue"]:"") . "",true,4);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"gamecategoriesinsert");
   }
 }
 ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "game_categories";
  $WA_sessionName = "WADA_Insert_game_categories";
  $WA_redirectURL = "game_categories_detail.php?game_cat_id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "game_category|WinPointValue|lossPointValue|drawPointValue";
  $WA_fieldValuesStr = "".((isset($_POST["game_category"]))?$_POST["game_category"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["WinPointValue"]))?$_POST["WinPointValue"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["lossPointValue"]))?$_POST["lossPointValue"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["drawPointValue"]))?$_POST["drawPointValue"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
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
<link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Insert_Basic_Default_ProgressWrapper">
<form class="Basic_Default" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
          <legend class="groupHeader">Insert</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
    <div class="lineGroup"> <label for="game_category" class="sublabel" > Game Category:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="game_category" name="game_category" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamecategoriesinsert","game_category"):"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamecategoriesinsert','gamecategoriesinsert'))  {
  if ((strpos((",".ValidatedField("gamecategoriesinsert","gamecategoriesinsert").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="game_category_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_categories_insert.php gamecategoriesinsert(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="WinPointValue" class="sublabel" > Win Point Value:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="WinPointValue" name="WinPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamecategoriesinsert","WinPointValue"):"")); ?>" class="formTextfield_Small" tabindex="2" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamecategoriesinsert','gamecategoriesinsert'))  {
  if ((strpos((",".ValidatedField("gamecategoriesinsert","gamecategoriesinsert").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="WinPointValue_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_categories_insert.php gamecategoriesinsert(2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="lossPointValue" class="sublabel" > Loss Point Value:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="lossPointValue" name="lossPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamecategoriesinsert","lossPointValue"):"")); ?>" class="formTextfield_Small" tabindex="3" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamecategoriesinsert','gamecategoriesinsert'))  {
  if ((strpos((",".ValidatedField("gamecategoriesinsert","gamecategoriesinsert").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="lossPointValue_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_categories_insert.php gamecategoriesinsert(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="drawPointValue" class="sublabel" > Draw Point Value:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="drawPointValue" name="drawPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamecategoriesinsert","drawPointValue"):"")); ?>" class="formTextfield_Small" tabindex="4" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamecategoriesinsert','gamecategoriesinsert'))  {
  if ((strpos((",".ValidatedField("gamecategoriesinsert","gamecategoriesinsert").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="drawPointValue_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_categories_insert.php gamecategoriesinsert(4:)
    }
  }
}?>
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Insert" class="" id="Insert" name="Insert" />
        </span>
        </fieldset>
</form></div><div id="Insert_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Default', 'Insert_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Insert_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Insert_Basic_Default_Opts = {
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
