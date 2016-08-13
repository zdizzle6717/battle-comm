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
// WA Application Builder Delete
if (isset($_POST["Delete"]) || isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "tableUpdates";
  $WA_redirectURL = "tableUpdates_results.php?id=".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "id";
  $WA_columnTypesStr = "',none,''";
  $WA_fieldValuesStr = "".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  $WA_comparisonStr = "=";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_comparisions = explode("|", $WA_comparisonStr);
  $WA_connectionDB = $database_local;
  mysql_select_db($WA_connectionDB, $WA_connection);
  if (!session_id()) session_start();
  $deleteParamsObj = WA_AB_generateWhereClause($WA_fieldNames, $WA_columns, $WA_fieldValues, $WA_comparisions);
  $WA_Sql = "DELETE FROM `" . $WA_table . "` WHERE " . $deleteParamsObj->sqlWhereClause;
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
<link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
<style>

/* Details page CSS */
form.DetailsPage {
    width: auto;	
}

.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}
.messageContainer {
	display: none;
	position: absolute;
	top:0;
	width: 100%;
	z-index:1002;
	text-align:center;
	height:100%;
	#position: relative;
	overflow: hidden;
}
.messageWrapper {
	#position: absolute; 
	#top: 50%;
	display: table-cell; 
	vertical-align: middle;	
}
.messageContent {
	background-color:white;
    display: inline-block;
	padding: 16px;
	border: 16px solid grey;
	z-index:1002;
	overflow: auto;
	margin: auto;
	#position: relative; 
	#top: -50%;
}</style>
</head>

<body>
<div id="Details_Basic_Default_ProgressWrapper">
<form class="DetailsPage Basic_Default" id="Details_Basic_Default" name="Details_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Details">
          <legend class="groupHeader">Details</legend>
        
<div>
<a name="top"></a>
	<?php if ($totalRows_WADAtableUpdates > 0) { // Show if recordset not empty ?>
	<div id="WADADetails">
			<table class="WADADataTable" cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td class="DetailsSublabel">Title:</td>
				<td class="DetailsPage"><?php echo($row_WADAtableUpdates['title']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Description:</td>
				<td class="DetailsPage"><?php echo($row_WADAtableUpdates['description']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">when:</td>
				<td class="DetailsPage"><?php echo(($row_WADAtableUpdates['when'])?date('n/d/Y',strtotime($row_WADAtableUpdates['when'])):''); ?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</table>
  <hr/>
	</div>
	<?php } // Show if recordset not empty ?>
<?php if ($totalRows_WADAtableUpdates == 0) { // Show if recordset empty ?>
	<div>
		<div>This record has been removed.</div>
	</div>
	<hr/>
<?php } // Show if recordset empty ?>
</div>
<span class="buttonFieldGroup" >
		<div>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
				    <?php if ($totalRows_WADAtableUpdates > 0) { // Show if recordset not empty ?>
				  <td><input type="button" value="Top" class="formButton Modular" id="Top" name="Top" onclick="window.location.hash='top';" /></td>
					<td><input type="button" value="Update" class="formButton Modular" id="Update" name="Update" onclick="document.location.href = 'tableUpdates_update.php?id=<?php echo($row_WADAtableUpdates["id"]); ?>
<?php echo(isset($_GET["pageNum_WADAtableUpdates"])?"&pageNum_WADAtableUpdates=".intval($_GET["pageNum_WADAtableUpdates"]):""); ?>';" /></td>
					<td><input type="button" value="Delete" class="formButton Modular" id="DeleteConfirm" name="DeleteConfirm" onclick="document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';"  /></td>
					<?php } // Show if recordset not empty ?>
					
				
					
					<td><input type="button" value="Back To Results" class="formButton Modular" id="BackToResults" name="BackToResults" onclick="document.location.href = 'tableUpdates_results.php<?php echo(isset($_GET["pageNum_WADAtableUpdates"])?"?pageNum_WADAtableUpdates=".intval($_GET["pageNum_WADAtableUpdates"]):""); ?>';" /></td>
				   </tr>
			</table>
		</div></span>
        </fieldset>
</form></div><div id="Details_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Details_Basic_Default', 'Details_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Details_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<div class="black_overlay" id="deleteBox"></div>
<div class="messageContainer" id="deleteMessage">
	<div class="messageWrapper">
	<form class="Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>" style="width:auto;">
      <input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAtableUpdates["id"]); ?>" />
	  <div class="messageContent">
		This will permanently remove the record from your database.<br/>
		This action cannot be undone.<br/><br/>
		<input type="submit" value="Delete" class="formButton Modular" id="Delete" name="Delete" />
		<input type="button" value="Cancel" class="formButton Modular" id="Cancel" name="Cancel" onclick="document.getElementById('deleteBox').style.display = 'none';document.getElementById('deleteMessage').style.display = 'none';"  />
	  </div>
	</form>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($WADAtableUpdates);
?>
