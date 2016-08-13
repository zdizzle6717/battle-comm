<?php require_once('../Connections/local_local.php'); ?>
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
$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
$maxRows_WADAgame_categories = 5;
$pageNum_WADAgame_categories = 0;
if (isset($_GET['pageNum_WADAgame_categories'])) {
  $pageNum_WADAgame_categories = $_GET['pageNum_WADAgame_categories'];
}
$startRow_WADAgame_categories = $pageNum_WADAgame_categories * $maxRows_WADAgame_categories;

mysql_select_db($database_local_local, $local_local);
$query_WADAgame_categories = "SELECT game_cat_id, game_category, WinPointValue, lossPointValue, drawPointValue FROM game_categories";
$query_limit_WADAgame_categories = sprintf("%s LIMIT %d, %d", $query_WADAgame_categories, $startRow_WADAgame_categories, $maxRows_WADAgame_categories);
$WADAgame_categories = mysql_query($query_limit_WADAgame_categories, $local_local) or die(mysql_error());
$row_WADAgame_categories = mysql_fetch_assoc($WADAgame_categories);

if (isset($_GET['totalRows_WADAgame_categories'])) {
  $totalRows_WADAgame_categories = $_GET['totalRows_WADAgame_categories'];
} else {
  $all_WADAgame_categories = mysql_query($query_WADAgame_categories, $local_local);
  $totalRows_WADAgame_categories = mysql_num_rows($all_WADAgame_categories);
}
$totalPages_WADAgame_categories = ceil($totalRows_WADAgame_categories/$maxRows_WADAgame_categories)-1;
?>
<?php
$queryString_WADAgame_categories = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_WADAgame_categories") == false && 
        stristr($param, "totalRows_WADAgame_categories") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_WADAgame_categories = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_WADAgame_categories = sprintf("&totalRows_WADAgame_categories=%d%s", $totalRows_WADAgame_categories, $queryString_WADAgame_categories);
?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete"]) || isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "game_categories";
  $WA_redirectURL = "game_categories_results.php?game_cat_id=".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "game_cat_id";
  $WA_columnTypesStr = "',none,''";
  $WA_fieldValuesStr = "".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  $WA_comparisonStr = "=";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_comparisions = explode("|", $WA_comparisonStr);
  $WA_connectionDB = $database_local_local;
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
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
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
	background-color:white;
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
  color: #FFFFFF;
  background-color: #262626;
}
.WADAResultsTableWrapper {
  clear: left;
  border: 1px solid #262626;
}
.WADAResultsRowDark {
  color:table;
  background-color: #E5E5E5;
}

form.Basic_Default input.formButton.Dark.DetailButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../images/Icons/view_details_white.png), url(../webassist/forms/gradient.php?from=262626&to=3E3E3E);
	background-image:url(../images/Icons/view_details_white.png),  -moz-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/view_details_white.png),  -o-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/view_details_white.png),  -webkit-linear-gradient(#262626, #3E3E3E);
	
	background-image:url(../images/Icons/view_details_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #262626), color-stop(1, #3E3E3E));
	
	background-image:url(../images/Icons/view_details_white.png),  linear-gradient(top, #262626, #3E3E3E);
	filter:none;
}
form.Basic_Default input.formButton.Dark.DetailButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}


form.Basic_Default input.formButton.Dark.UpdateButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../images/Icons/edit_white.png), url(../webassist/forms/gradient.php?from=262626&to=3E3E3E);
	background-image:url(../images/Icons/edit_white.png),  -moz-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/edit_white.png),  -o-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/edit_white.png),  -webkit-linear-gradient(#262626, #3E3E3E);
	
	background-image:url(../images/Icons/edit_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #262626), color-stop(1, #3E3E3E));
	
	background-image:url(../images/Icons/edit_white.png),  linear-gradient(top, #262626, #3E3E3E);
	filter:none;
}
form.Basic_Default input.formButton.Dark.UpdateButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}


form.Basic_Default input.formButton.Dark.DeleteButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../images/Icons/delete_white.png), url(../webassist/forms/gradient.php?from=262626&to=3E3E3E);
	background-image:url(../images/Icons/delete_white.png),  -moz-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/delete_white.png),  -o-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/delete_white.png),  -webkit-linear-gradient(#262626, #3E3E3E);
	
	background-image:url(../images/Icons/delete_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #262626), color-stop(1, #3E3E3E));
	
	background-image:url(../images/Icons/delete_white.png),  linear-gradient(top, #262626, #3E3E3E);
	filter:none;
}
form.Basic_Default input.formButton.Dark.DeleteButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}
</style>
<!--[if lte ie 8]>
<style>

form.Basic_Default input.formButton.Dark.DetailButton {
	background-image:url(../images/Icons/view_details_white.png);
	background-color:#262626
}
form.Basic_Default input.formButton.Dark:hover.DetailButton {
	}

form.Basic_Default input.formButton.Dark.UpdateButton {
	background-image:url(../images/Icons/edit_white.png);
	background-color:#262626
}
form.Basic_Default input.formButton.Dark:hover.UpdateButton {
	}

form.Basic_Default input.formButton.Dark.DeleteButton {
	background-image:url(../images/Icons/delete_white.png);
	background-color:#262626
}
form.Basic_Default input.formButton.Dark:hover.DeleteButton {
	}
</style>
<![endif]-->
</head>

<body>
<div id="Results_Basic_Default_ProgressWrapper">
<form class="DetailsPage Basic_Default" id="Results_Basic_Default" name="Results_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Results">
          <legend class="groupHeader">Results</legend>
        
<div class="WADAResultsContainer">
<a name="top"></a>
<?php if ($totalRows_WADAgame_categories > 0) { // Show if recordset not empty ?>
  <div class="WADAResults">
    <div class="WADAResultsNavigation"><wa:insertbutton>
			<div class="WADAResultsInsertButton">
				<input type="button" value="Insert" class="" id="Insert" name="Insert" onclick="document.location.href='game_categories_insert.php';" />
			</div></wa:insertbutton>
      <div class="WADAResultsCount">Records  <?php echo ($startRow_WADAgame_categories + 1) ?> to  <?php echo min($startRow_WADAgame_categories + $maxRows_WADAgame_categories, $totalRows_WADAgame_categories) ?> of  <?php echo $totalRows_WADAgame_categories ?></div>
			<div class="WADAResultsNavTop">
				<table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
					<tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_categories > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Dark" id="First" name="First" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_categories=%d%s", $currentPage, 0, $queryString_WADAgame_categories); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_categories > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Dark" id="Previous" name="Previous" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_categories=%d%s", $currentPage, max(0, $pageNum_WADAgame_categories - 1), $queryString_WADAgame_categories); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_categories < $totalPages_WADAgame_categories) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Dark" id="Next" name="Next" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_categories=%d%s", $currentPage, min($totalPages_WADAgame_categories, $pageNum_WADAgame_categories + 1), $queryString_WADAgame_categories); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_categories < $totalPages_WADAgame_categories) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Dark" id="Last" name="Last" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_categories=%d%s", $currentPage, $totalPages_WADAgame_categories, $queryString_WADAgame_categories); ?>';" /><?php } // Show if not last page ?></td>
					</tr>
				</table>
			</div>
    </div>
	<div class="WADAResultsTableWrapper">
    <table class="WADAResultsTable" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <th class="WADAResultsTableHeader">Game Category:</th>
        <th class="WADAResultsTableHeader">Win Point Value:</th>
        <th class="WADAResultsTableHeader">Loss Point Value</th>
        <th class="WADAResultsTableHeader">Draw Point Value</th>
        
<wa:optiontest name="INCEDITBUTTONS" value="true">
		<th>&nbsp;</th>
</wa:optiontest>
      </tr>
<?php do { ?>
        <tr class="<?php echo($WARRT_AltClass1->getClass(true)); ?>">
          <td class="WADAResultsTableCell"><a href="game_categories_detail.php?game_cat_id=<?php echo($row_WADAgame_categories['game_cat_id']); ?>
<?php echo(isset($_GET["pageNum_WADAgame_categories"])?"&pageNum_WADAgame_categories=".intval($_GET["pageNum_WADAgame_categories"]):""); ?>" ><?php echo($row_WADAgame_categories['game_category']); ?></a></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAgame_categories['WinPointValue']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAgame_categories['lossPointValue']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAgame_categories['drawPointValue']); ?></td>
          
		<td class="WADAResultsEditButtons" nowrap="nowrap"><input type="button" class="formButton ResultsPageButton Dark DetailButton" value="" onclick="document.location.href='game_categories_detail.php?game_cat_id=<?php echo($row_WADAgame_categories['game_cat_id']); ?>
<?php echo(isset($_GET["pageNum_WADAgame_categories"])?"&pageNum_WADAgame_categories=".intval($_GET["pageNum_WADAgame_categories"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Dark UpdateButton" value="" onclick="document.location.href='game_categories_update.php?game_cat_id=<?php echo($row_WADAgame_categories['game_cat_id']); ?>
<?php echo(isset($_GET["pageNum_WADAgame_categories"])?"&pageNum_WADAgame_categories=".intval($_GET["pageNum_WADAgame_categories"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Dark DeleteButton" value="" onclick="document.getElementById('WADADeleteRecordID').value=<?php echo($row_WADAgame_categories['game_cat_id']); ?>;document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';" /></td>
        </tr>
<?php } while ($row_WADAgame_categories = mysql_fetch_assoc($WADAgame_categories)); ?>
    </table>
	</div>
    <div class="WADAResultsNavigation">
      <div class="WADAResultsCountBottom">Records  <?php echo ($startRow_WADAgame_categories + 1) ?> to  <?php echo min($startRow_WADAgame_categories + $maxRows_WADAgame_categories, $totalRows_WADAgame_categories) ?> of  <?php echo $totalRows_WADAgame_categories ?></div>
      <div class="WADAResultsNavBottom">
        <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
          <tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_categories > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Dark" id="First_2" name="First_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_categories=%d%s", $currentPage, 0, $queryString_WADAgame_categories); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_categories > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Dark" id="Previous_2" name="Previous_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_categories=%d%s", $currentPage, max(0, $pageNum_WADAgame_categories - 1), $queryString_WADAgame_categories); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_categories < $totalPages_WADAgame_categories) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Dark" id="Next_2" name="Next_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_categories=%d%s", $currentPage, min($totalPages_WADAgame_categories, $pageNum_WADAgame_categories + 1), $queryString_WADAgame_categories); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_categories < $totalPages_WADAgame_categories) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Dark" id="Last_2" name="Last_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_categories=%d%s", $currentPage, $totalPages_WADAgame_categories, $queryString_WADAgame_categories); ?>';" /><?php } // Show if not last page ?></td>
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
			<input type="submit" value="Delete" class="" id="Delete" name="Delete" />
			<input type="button" value="Cancel" class="" id="Cancel" name="Cancel" onclick="document.getElementById('deleteBox').style.display = 'none';document.getElementById('deleteMessage').style.display = 'none';"  />
		  </div>
	  </div>
	</div>
  </div>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_WADAgame_categories == 0) { // Show if recordset empty ?>
  <div class="WADANoResults">
    <div class="WADANoResultsMessage">No Results Found</div><wa:insertbutton>
    <div>
      <input type="button" value="Insert" class="" id="Insert" name="Insert" onclick="document.location.href='game_categories_insert.php';" />
    </div></wa:insertbutton>
  </div>
<?php } // Show if recordset empty ?>
</div>

        </fieldset>
<input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAgame_categories["game_cat_id"]); ?>" />
</form></div><div id="Results_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Results_Basic_Default', 'Results_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Results_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


</body>
</html>
<?php
mysql_free_result($WADAgame_categories);
?>
