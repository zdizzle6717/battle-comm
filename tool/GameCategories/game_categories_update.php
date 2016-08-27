<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_gamecategoriesupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["game_category"])?$_POST["game_category"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["WinPointValue"])?$_POST["WinPointValue"]:"") . "",true,2);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["lossPointValue"])?$_POST["lossPointValue"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["drawPointValue"])?$_POST["drawPointValue"]:"") . "",true,4);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"gamecategoriesupdate");
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
$Paramgame_cat_id_WADAgame_categories = "-1";
if (isset($_GET['game_cat_id'])) {
  $Paramgame_cat_id_WADAgame_categories = $_GET['game_cat_id'];
}
mysql_select_db($database_local_local, $local_local);
$query_WADAgame_categories = sprintf("SELECT game_cat_id, game_category, WinPointValue, lossPointValue, drawPointValue FROM game_categories WHERE game_cat_id = %s", GetSQLValueString($Paramgame_cat_id_WADAgame_categories, "-1"));
$WADAgame_categories = mysql_query($query_WADAgame_categories, $local_local) or die(mysql_error());
$row_WADAgame_categories = mysql_fetch_assoc($WADAgame_categories);
$totalRows_WADAgame_categories = mysql_num_rows($WADAgame_categories);
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "game_categories";
  $WA_redirectURL = "game_categories_detail.php?game_cat_id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAgame_categories"])?"&pageNum_WADAgame_categories=".intval($_GET["pageNum_WADAgame_categories"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "game_cat_id";
  $WA_fieldNamesStr = "game_category|WinPointValue|lossPointValue|drawPointValue";
  $WA_fieldValuesStr = "".((isset($_POST["game_category"]))?$_POST["game_category"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["WinPointValue"]))?$_POST["WinPointValue"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["lossPointValue"]))?$_POST["lossPointValue"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["drawPointValue"]))?$_POST["drawPointValue"]:"")  ."";
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
    <div class="lineGroup"> <label for="game_category" class="sublabel" > Game Category:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="game_category" name="game_category" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamecategoriesupdate","game_category"):"".$row_WADAgame_categories["game_category"]."")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamecategoriesupdate','gamecategoriesupdate'))  {
  if ((strpos((",".ValidatedField("gamecategoriesupdate","gamecategoriesupdate").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="game_category_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_categories_update.php gamecategoriesupdate(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="WinPointValue" class="sublabel" > Win Point Value:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="WinPointValue" name="WinPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamecategoriesupdate","WinPointValue"):"".$row_WADAgame_categories["WinPointValue"]."")); ?>" class="formTextfield_Small" tabindex="2" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamecategoriesupdate','gamecategoriesupdate'))  {
  if ((strpos((",".ValidatedField("gamecategoriesupdate","gamecategoriesupdate").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="WinPointValue_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_categories_update.php gamecategoriesupdate(2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="lossPointValue" class="sublabel" > Loss Point Value:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="lossPointValue" name="lossPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamecategoriesupdate","lossPointValue"):"".$row_WADAgame_categories["lossPointValue"]."")); ?>" class="formTextfield_Small" tabindex="3" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamecategoriesupdate','gamecategoriesupdate'))  {
  if ((strpos((",".ValidatedField("gamecategoriesupdate","gamecategoriesupdate").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="lossPointValue_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_categories_update.php gamecategoriesupdate(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="drawPointValue" class="sublabel" > Draw Point Value:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="drawPointValue" name="drawPointValue" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamecategoriesupdate","drawPointValue"):"".$row_WADAgame_categories["drawPointValue"]."")); ?>" class="formTextfield_Small" tabindex="4" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamecategoriesupdate','gamecategoriesupdate'))  {
  if ((strpos((",".ValidatedField("gamecategoriesupdate","gamecategoriesupdate").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="drawPointValue_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_categories_update.php gamecategoriesupdate(4:)
    }
  }
}?>
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Update" class="" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamecategoriesupdate","WADAUpdateRecordID"):$_GET["game_cat_id"])); ?>" />
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
mysql_free_result($WADAgame_categories);
?>
