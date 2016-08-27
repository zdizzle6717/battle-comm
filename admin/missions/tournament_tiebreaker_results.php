<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
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
$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
$maxRows_WADAtournament_tiebreaker = 1000;
$pageNum_WADAtournament_tiebreaker = 0;
if (isset($_GET['pageNum_WADAtournament_tiebreaker'])) {
  $pageNum_WADAtournament_tiebreaker = $_GET['pageNum_WADAtournament_tiebreaker'];
}
$startRow_WADAtournament_tiebreaker = $pageNum_WADAtournament_tiebreaker * $maxRows_WADAtournament_tiebreaker;

mysql_select_db($database_local, $local);
$query_WADAtournament_tiebreaker = "SELECT tourney_tiebreaker_id, tiebreaker_name, point_value FROM tournament_tiebreaker";
$query_limit_WADAtournament_tiebreaker = sprintf("%s LIMIT %d, %d", $query_WADAtournament_tiebreaker, $startRow_WADAtournament_tiebreaker, $maxRows_WADAtournament_tiebreaker);
$WADAtournament_tiebreaker = mysql_query($query_limit_WADAtournament_tiebreaker, $local) or die(mysql_error());
$row_WADAtournament_tiebreaker = mysql_fetch_assoc($WADAtournament_tiebreaker);

if (isset($_GET['totalRows_WADAtournament_tiebreaker'])) {
  $totalRows_WADAtournament_tiebreaker = $_GET['totalRows_WADAtournament_tiebreaker'];
} else {
  $all_WADAtournament_tiebreaker = mysql_query($query_WADAtournament_tiebreaker);
  $totalRows_WADAtournament_tiebreaker = mysql_num_rows($all_WADAtournament_tiebreaker);
}
$totalPages_WADAtournament_tiebreaker = ceil($totalRows_WADAtournament_tiebreaker/$maxRows_WADAtournament_tiebreaker)-1;
?>
<?php
$queryString_WADAtournament_tiebreaker = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_WADAtournament_tiebreaker") == false && 
        stristr($param, "totalRows_WADAtournament_tiebreaker") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_WADAtournament_tiebreaker = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_WADAtournament_tiebreaker = sprintf("&totalRows_WADAtournament_tiebreaker=%d%s", $totalRows_WADAtournament_tiebreaker, $queryString_WADAtournament_tiebreaker);
?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete"]) || isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "tournament_tiebreaker";
  $WA_redirectURL = "tournament_tiebreaker_results.php?tourney_tiebreaker_id=".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "tourney_tiebreaker_id";
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
<?php
//WA AltClass Iterator
class WA_AltClassIterator     {
  var $DisplayIndex;
  var $DisplayArray;
  
  function WA_AltClassIterator($theDisplayArray = array(1)) {
    $this->ClassCounter = 0;
    $this->ClassArray   = $theDisplayArray;
  }
  
  function getClass($incrementClass)  {
    if (sizeof($this->ClassArray) == 0) return "";
  	if ($incrementClass) {
      if ($this->ClassCounter >= sizeof($this->ClassArray)) $this->ClassCounter = 0;
      $this->ClassCounter++;
    }
    if ($this->ClassCounter > 0)
      return $this->ClassArray[$this->ClassCounter-1];
    else
      return $this->ClassArray[0];
  }
}
?>
<?php
//WA Alternating Class
$WARRT_AltClass1 = new WA_AltClassIterator(explode("|", "|WADAResultsRowDark"));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../webassist/forms/fd_basic_defaultmod.css" rel="stylesheet" type="text/css">
<link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
<style>

form.DetailsPage {
    width: auto;	
}
.WADAResults, .WADANoResults {
  border-top-width: 1px;
  border-top-style: solid;
  border-top-color: #BABDC2;
}
.WADAResultsNavigation {
  padding-top: 5px;
  padding-bottom: 10px;
}
.WADAResultsCount {
  font-size: 11px;
}
.WADAResultsNavTop, .WADAResultsInsertButton {
  clear :none;
}
.WADAResultsNavTop, WADAResultsNavBottom {
  width: 60%;
  float: left;
}
div.WADAResultsInsertButton {
  width: 30%;
  float: right;
  text-align: right;
}
.WADAResultsNavButtonCell, .WADAResultsInsertButton {
  padding-top: 2px;
  padding-right: 2px;
  padding-bottom: 2px;
  padding-left: 2px;
}
.WADAResultsTable {
  font-size: 11px;
  clear: both;
  padding-top: 1px;
  padding-bottom: 1px;
}
.WADAResultsTableHeader {
  text-align: left;
  padding-left: 13px;
  padding-right: 13px;
}
.WADAResultsTableCell {
  text-align: left;
  padding-left: 14px;
  padding-right: 14px;
}
.WADAResultsEditButtons {
  text-align: right;
  border-right-width: 1px;
  border-right-style: solid;
  border-right-color: #BABDC2;
  border-left-width: 1px;
  border-left-style: solid;
  border-left-color: #BABDC2;
}

form .WADAResultsContainer input.formButton.ResultsNavButton {
  margin: 2px 0;
  padding: 2px;
  -moz-border-radius: 6px;
  -webkit-border-radius: 6px;
  -khtml-border-radius: 6px;
  border-radius: 6px;
  outline: 0;
}

form .WADAResultsContainer input.formButton.ResultsPageButton {
  margin: 2px;
  padding: 0;
  -moz-border-radius: 6px;
  -webkit-border-radius: 6px;
  -khtml-border-radius: 6px;
  border-radius: 6px;
  outline:0;
}

.WADAResultThumbArea {
	float:left;
}
.WADAResultInfoArea {
	margin-left: 170px;
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
	background-color:#FFFFFF;
    display: inline-block;
	padding: 16px;
	border: 16px solid grey;
	z-index:1002;
	overflow: auto;
	margin: auto;
	#position: relative; 
	#top: -50%;
}
.WADAResultsTable th{
  color: #cccccc;
  background-color: #1c5a73;
}
.WADAResultsTableWrapper {
  clear: left;
  border: 1px solid #1c5a73;
}
.WADAResultsRowDark {
  color:table;
  background-color: #CCF1FF;
}

form.Basic_Defaultmod input.formButton.Spacious.DetailButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/view_details_white.png), url(../../webassist/forms/gradient.php?from=18536b&to=1c5a73);
	background-image:url(../../images/Icons/view_details_white.png),  -moz-linear-gradient(top, #18536b, #1c5a73);
	
	background-image:url(../../images/Icons/view_details_white.png),  -o-linear-gradient(top, #18536b, #1c5a73);
	
	background-image:url(../../images/Icons/view_details_white.png),  -webkit-linear-gradient(#18536b, #1c5a73);
	
	background-image:url(../../images/Icons/view_details_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #18536b), color-stop(1, #1c5a73));
	
	background-image:url(../../images/Icons/view_details_white.png),  linear-gradient(top, #18536b, #1c5a73);
	filter:none;
}
form.Basic_Defaultmod input.formButton.Spacious.DetailButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}


form.Basic_Defaultmod input.formButton.Spacious.UpdateButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/edit_white.png), url(../../webassist/forms/gradient.php?from=18536b&to=1c5a73);
	background-image:url(../../images/Icons/edit_white.png),  -moz-linear-gradient(top, #18536b, #1c5a73);
	
	background-image:url(../../images/Icons/edit_white.png),  -o-linear-gradient(top, #18536b, #1c5a73);
	
	background-image:url(../../images/Icons/edit_white.png),  -webkit-linear-gradient(#18536b, #1c5a73);
	
	background-image:url(../../images/Icons/edit_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #18536b), color-stop(1, #1c5a73));
	
	background-image:url(../../images/Icons/edit_white.png),  linear-gradient(top, #18536b, #1c5a73);
	filter:none;
}
form.Basic_Defaultmod input.formButton.Spacious.UpdateButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}


form.Basic_Defaultmod input.formButton.Spacious.DeleteButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/delete_white.png), url(../../webassist/forms/gradient.php?from=18536b&to=1c5a73);
	background-image:url(../../images/Icons/delete_white.png),  -moz-linear-gradient(top, #18536b, #1c5a73);
	
	background-image:url(../../images/Icons/delete_white.png),  -o-linear-gradient(top, #18536b, #1c5a73);
	
	background-image:url(../../images/Icons/delete_white.png),  -webkit-linear-gradient(#18536b, #1c5a73);
	
	background-image:url(../../images/Icons/delete_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #18536b), color-stop(1, #1c5a73));
	
	background-image:url(../../images/Icons/delete_white.png),  linear-gradient(top, #18536b, #1c5a73);
	filter:none;
}
form.Basic_Defaultmod input.formButton.Spacious.DeleteButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}
</style>
<!--[if lte ie 8]>
<style>

form.Basic_Defaultmod input.formButton.Spacious.DetailButton {
	background-image:url(../../images/Icons/view_details_white.png);
	background-color:#18536b
}
form.Basic_Defaultmod input.formButton.Spacious:hover.DetailButton {
	}

form.Basic_Defaultmod input.formButton.Spacious.UpdateButton {
	background-image:url(../../images/Icons/edit_white.png);
	background-color:#18536b
}
form.Basic_Defaultmod input.formButton.Spacious:hover.UpdateButton {
	}

form.Basic_Defaultmod input.formButton.Spacious.DeleteButton {
	background-image:url(../../images/Icons/delete_white.png);
	background-color:#18536b
}
form.Basic_Defaultmod input.formButton.Spacious:hover.DeleteButton {
	}
</style>
<![endif]-->
</head>

<body>
<div id="Results_Basic_Defaultmod_ProgressWrapper">
<form class="DetailsPage Basic_Defaultmod" id="Results_Basic_Defaultmod" name="Results_Basic_Defaultmod" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Defaultmod" id="Results">
          <legend class="groupHeader">Results</legend>
        
<div class="WADAResultsContainer">
<a name="top"></a>
<?php if ($totalRows_WADAtournament_tiebreaker > 0) { // Show if recordset not empty ?>
  <div class="WADAResults">
    <div class="WADAResultsNavigation"><wa:insertbutton>
			<div class="WADAResultsInsertButton">
				<input type="button" value="Insert" class="formButton Spacious" id="Insert" name="Insert" onclick="document.location.href='tournament_tiebreaker_insert.php';" />
			</div></wa:insertbutton>
      <div class="WADAResultsCount">Records  <?php echo ($startRow_WADAtournament_tiebreaker + 1) ?> to  <?php echo min($startRow_WADAtournament_tiebreaker + $maxRows_WADAtournament_tiebreaker, $totalRows_WADAtournament_tiebreaker) ?> of  <?php echo $totalRows_WADAtournament_tiebreaker ?></div>
			<div class="WADAResultsNavTop">
				<table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
					<tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtournament_tiebreaker > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Spacious" id="First" name="First" onclick="document.location.href='<?php printf("%s?pageNum_WADAtournament_tiebreaker=%d%s", $currentPage, 0, $queryString_WADAtournament_tiebreaker); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtournament_tiebreaker > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Spacious" id="Previous" name="Previous" onclick="document.location.href='<?php printf("%s?pageNum_WADAtournament_tiebreaker=%d%s", $currentPage, max(0, $pageNum_WADAtournament_tiebreaker - 1), $queryString_WADAtournament_tiebreaker); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtournament_tiebreaker < $totalPages_WADAtournament_tiebreaker) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Spacious" id="Next" name="Next" onclick="document.location.href='<?php printf("%s?pageNum_WADAtournament_tiebreaker=%d%s", $currentPage, min($totalPages_WADAtournament_tiebreaker, $pageNum_WADAtournament_tiebreaker + 1), $queryString_WADAtournament_tiebreaker); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtournament_tiebreaker < $totalPages_WADAtournament_tiebreaker) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Spacious" id="Last" name="Last" onclick="document.location.href='<?php printf("%s?pageNum_WADAtournament_tiebreaker=%d%s", $currentPage, $totalPages_WADAtournament_tiebreaker, $queryString_WADAtournament_tiebreaker); ?>';" /><?php } // Show if not last page ?></td>
					</tr>
				</table>
			</div>
    </div>
	<div class="WADAResultsTableWrapper">
    <table class="WADAResultsTable" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <th class="WADAResultsTableHeader">Name:</th>
        <th class="WADAResultsTableHeader">Point Value:</th>
        
<wa:optiontest name="INCEDITBUTTONS" value="true">
		<th>&nbsp;</th>
</wa:optiontest>
      </tr>
<?php do { ?>
        <tr class="<?php echo($WARRT_AltClass1->getClass(true)); ?>">
          <td class="WADAResultsTableCell"><a href="tournament_tiebreaker_detail.php?tourney_tiebreaker_id=<?php echo($row_WADAtournament_tiebreaker['tourney_tiebreaker_id']); ?>
<?php echo(isset($_GET["pageNum_WADAtournament_tiebreaker"])?"&pageNum_WADAtournament_tiebreaker=".intval($_GET["pageNum_WADAtournament_tiebreaker"]):""); ?>" ><?php echo($row_WADAtournament_tiebreaker['tiebreaker_name']); ?></a></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAtournament_tiebreaker['point_value']); ?></td>
          
		<td class="WADAResultsEditButtons" nowrap="nowrap"><input type="button" class="formButton ResultsPageButton Spacious DetailButton" value="" onclick="document.location.href='tournament_tiebreaker_detail.php?tourney_tiebreaker_id=<?php echo($row_WADAtournament_tiebreaker['tourney_tiebreaker_id']); ?>
<?php echo(isset($_GET["pageNum_WADAtournament_tiebreaker"])?"&pageNum_WADAtournament_tiebreaker=".intval($_GET["pageNum_WADAtournament_tiebreaker"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Spacious UpdateButton" value="" onclick="document.location.href='tournament_tiebreaker_update.php?tourney_tiebreaker_id=<?php echo($row_WADAtournament_tiebreaker['tourney_tiebreaker_id']); ?>
<?php echo(isset($_GET["pageNum_WADAtournament_tiebreaker"])?"&pageNum_WADAtournament_tiebreaker=".intval($_GET["pageNum_WADAtournament_tiebreaker"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Spacious DeleteButton" value="" onclick="document.getElementById('WADADeleteRecordID').value=<?php echo($row_WADAtournament_tiebreaker['tourney_tiebreaker_id']); ?>;document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';" /></td>
        </tr>
<?php } while ($row_WADAtournament_tiebreaker = mysql_fetch_assoc($WADAtournament_tiebreaker)); ?>
    </table>
	</div>
    <div class="WADAResultsNavigation">
      <div class="WADAResultsCountBottom">Records  <?php echo ($startRow_WADAtournament_tiebreaker + 1) ?> to  <?php echo min($startRow_WADAtournament_tiebreaker + $maxRows_WADAtournament_tiebreaker, $totalRows_WADAtournament_tiebreaker) ?> of  <?php echo $totalRows_WADAtournament_tiebreaker ?></div>
      <div class="WADAResultsNavBottom">
        <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
          <tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtournament_tiebreaker > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Spacious" id="First_2" name="First_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAtournament_tiebreaker=%d%s", $currentPage, 0, $queryString_WADAtournament_tiebreaker); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtournament_tiebreaker > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Spacious" id="Previous_2" name="Previous_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAtournament_tiebreaker=%d%s", $currentPage, max(0, $pageNum_WADAtournament_tiebreaker - 1), $queryString_WADAtournament_tiebreaker); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtournament_tiebreaker < $totalPages_WADAtournament_tiebreaker) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Spacious" id="Next_2" name="Next_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAtournament_tiebreaker=%d%s", $currentPage, min($totalPages_WADAtournament_tiebreaker, $pageNum_WADAtournament_tiebreaker + 1), $queryString_WADAtournament_tiebreaker); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAtournament_tiebreaker < $totalPages_WADAtournament_tiebreaker) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Spacious" id="Last_2" name="Last_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAtournament_tiebreaker=%d%s", $currentPage, $totalPages_WADAtournament_tiebreaker, $queryString_WADAtournament_tiebreaker); ?>';" /><?php } // Show if not last page ?></td>
          </tr>
        </table>
      </div>
    </div>
	<div class="black_overlay" id="deleteBox"></div>
	<div class="messageContainer" id="deleteMessage">
		<div class="messageWrapper">
		  <div class="messageContent">
			This will permanently remove the record from your database.<br/>
			This action cannot be undone.<br/><br/>
			<input type="submit" value="Delete" class="formButton Spacious" id="Delete" name="Delete" />
			<input type="button" value="Cancel" class="formButton Spacious" id="Cancel" name="Cancel" onclick="document.getElementById('deleteBox').style.display = 'none';document.getElementById('deleteMessage').style.display = 'none';"  />
		  </div>
	  </div>
	</div>
  </div>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_WADAtournament_tiebreaker == 0) { // Show if recordset empty ?>
  <div class="WADANoResults">
    <div class="WADANoResultsMessage">No Results Found</div><wa:insertbutton>
    <div>
      <input type="button" value="Insert" class="formButton Spacious" id="Insert" name="Insert" onclick="document.location.href='tournament_tiebreaker_insert.php';" />
    </div></wa:insertbutton>
  </div>
<?php } // Show if recordset empty ?>
</div>

        </fieldset>
<input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAtournament_tiebreaker["tourney_tiebreaker_id"]); ?>" />
</form></div><div id="Results_Basic_Defaultmod_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Results_Basic_Defaultmod', 'Results_Basic_Defaultmod_ProgressMessageWrapper', WADFP_Theme_Options['Bar:Nautica']);
</script>
<div id="Results_Basic_Defaultmod_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/nautica-bar.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


</body>
</html>
<?php
mysql_free_result($WADAtournament_tiebreaker);
?>
