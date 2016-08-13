<?php require_once('../Connections/local.php'); ?>
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
$Paramid_WADAtableUpdates = "-1";
if (isset($_GET['id'])) {
  $Paramid_WADAtableUpdates = $_GET['id'];
}
mysql_select_db($database_local, $local);
$query_WADAtableUpdates = sprintf("SELECT id, title, description, when FROM tableUpdates WHERE id = %s", GetSQLValueString($Paramid_WADAtableUpdates, "-1"));
$WADAtableUpdates = mysql_query($query_WADAtableUpdates, $local) or die(mysql_error());
$row_WADAtableUpdates = mysql_fetch_assoc($WADAtableUpdates);
$totalRows_WADAtableUpdates = mysql_num_rows($WADAtableUpdates);
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "tableUpdates";
  $WA_redirectURL = "tableUpdates_detail.php?id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAtableUpdates"])?"&pageNum_WADAtableUpdates=".intval($_GET["pageNum_WADAtableUpdates"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "title|description|when";
  $WA_fieldValuesStr = "".((isset($_POST["title"]))?$_POST["title"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["description"]))?$_POST["description"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["when"]) && $_POST["when"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["when"])):"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,NULL";
  $WA_comparisonStr = " LIKE | LIKE | = ";
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../webassist/jq_validation/Bloom.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="file:///C|/xampp/htdocs/testBC/webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Update_Basic_Default_ProgressWrapper">
<form class="Basic_Default" id="Update_Basic_Default" name="Update_Basic_Default" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Default" id="Update">
          <legend class="groupHeader">Update</legend>
    <div class="lineGroup"> <label for="title" class="sublabel" > Title:</label>
  <input id="title" name="title" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tableUpdatesupdate","title"):"".$row_WADAtableUpdates["title"]."")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="description" class="sublabel" > Description:</label>
  <textarea name="description" id="description" class="formTextarea_Medium" rows="1" cols="1" tabindex="2" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("tableUpdatesupdate","description"):"".$row_WADAtableUpdates["description"]."")); ?></textarea>
    </div> 
        <span class="buttonFieldGroup" >
  <input id="when" name="when" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tableUpdatesupdate","when"):"".(($row_WADAtableUpdates["when"])?date("n/d/Y",strtotime($row_WADAtableUpdates["when"])):"")."")); ?>">
<input type="submit" value="Update" class="formButton Modular" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tableUpdatesupdate","WADAUpdateRecordID"):$_GET["id"])); ?>" />
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
mysql_free_result($WADAtableUpdates);
?>
