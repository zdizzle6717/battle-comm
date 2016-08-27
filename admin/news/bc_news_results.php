<?php require_once('../../Connections/local.php'); ?>
<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/database_management/wada_search.php"); ?>
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

$maxRows_WADAbc_news = 10;
$pageNum_WADAbc_news = 0;
if (isset($_GET['pageNum_WADAbc_news'])) {
  $pageNum_WADAbc_news = $_GET['pageNum_WADAbc_news'];
}
$startRow_WADAbc_news = $pageNum_WADAbc_news * $maxRows_WADAbc_news;

mysql_select_db($database_local, $local);
$query_WADAbc_news = "SELECT * FROM bc_news";
$query_limit_WADAbc_news = sprintf("%s LIMIT %d, %d", $query_WADAbc_news, $startRow_WADAbc_news, $maxRows_WADAbc_news);
$WADAbc_news = mysql_query($query_limit_WADAbc_news, $local) or die(mysql_error());
$row_WADAbc_news = mysql_fetch_assoc($WADAbc_news);

if (isset($_GET['totalRows_WADAbc_news'])) {
  $totalRows_WADAbc_news = $_GET['totalRows_WADAbc_news'];
} else {
  $all_WADAbc_news = mysql_query($query_WADAbc_news);
  $totalRows_WADAbc_news = mysql_num_rows($all_WADAbc_news);
}
$totalPages_WADAbc_news = ceil($totalRows_WADAbc_news/$maxRows_WADAbc_news)-1;

$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: WADAbc_news;
//Searchpage: bc_news_search.php;
//Form: WADASearchForm;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if (isset($_GET["Search"]) || isset($_GET["Search_x"])) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromEdit("news_title","news_title","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("news_author","news_author","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("tags","tags","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("game_system","game_system","AND","Includes",0);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_bc_news_results"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_bc_news_results"]) && $_SESSION["WADbSearch1_bc_news_results"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_bc_news_results"];
    }
    else     {
      $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
    }
  }
  else     {
    $WADbSearch1->whereClause = $WADbSearch1_DefaultWhere;
  }
}
$WADbSearch1->whereClause = str_replace("\\''", "''", $WADbSearch1->whereClause);
$WADbSearch1whereClause = '';
?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>

<?php
$queryString_WADAbc_news = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_WADAbc_news") == false && 
        stristr($param, "totalRows_WADAbc_news") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_WADAbc_news = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_WADAbc_news = sprintf("&totalRows_WADAbc_news=%d%s", $totalRows_WADAbc_news, $queryString_WADAbc_news);
?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete"]) || isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "bc_news";
  $WA_redirectURL = "bc_news_results.php?news_id=".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "news_id";
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
$maxRows_WADAbc_news = 15;
$pageNum_WADAbc_news = 0;
if (isset($_GET['pageNum_WADAbc_news'])) {
  $pageNum_WADAbc_news = $_GET['pageNum_WADAbc_news'];
}
$startRow_WADAbc_news = $pageNum_WADAbc_news * $maxRows_WADAbc_news;

mysql_select_db($database_local, $local);
$query_WADAbc_news = "SELECT news_id, news_title, news_callout, news_author, publish FROM bc_news";
setQueryBuilderSource($query_WADAbc_news,$WADbSearch1,false);
$query_limit_WADAbc_news = sprintf("%s LIMIT %d, %d", $query_WADAbc_news, $startRow_WADAbc_news, $maxRows_WADAbc_news);
$WADAbc_news = mysql_query($query_limit_WADAbc_news, $local) or die(mysql_error());
$row_WADAbc_news = mysql_fetch_assoc($WADAbc_news);

if (isset($_GET['totalRows_WADAbc_news'])) {
  $totalRows_WADAbc_news = $_GET['totalRows_WADAbc_news'];
} else {
  $all_WADAbc_news = mysql_query($query_WADAbc_news);
  $totalRows_WADAbc_news = mysql_num_rows($all_WADAbc_news);
}
$totalPages_WADAbc_news = ceil($totalRows_WADAbc_news/$maxRows_WADAbc_news)-1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
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
  color: #ffffff;
  background-color: #287697;
}
.WADAResultsTableWrapper {
  clear: left;
  border: 1px solid #287697;
}
.WADAResultsRowDark {
  color:table;
  background-color: #CCF0FF;
}

form.Basic_Default input.formButton.Modular.DetailButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/view_details_white.png);
}
form.Basic_Default input.formButton.Modular.DetailButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/view_details_white.png);
}


form.Basic_Default input.formButton.Modular.UpdateButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/edit_white.png);
}
form.Basic_Default input.formButton.Modular.UpdateButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/edit_white.png);
}


form.Basic_Default input.formButton.Modular.DeleteButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/delete_white.png);
}
form.Basic_Default input.formButton.Modular.DeleteButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/delete_white.png);
}
</style>
</head>

<body>
<div id="Results_Basic_Default_ProgressWrapper">
<form class="DetailsPage Basic_Default" id="Results_Basic_Default" name="Results_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Results">
          <legend class="groupHeader">Results</legend>
        
<div class="WADAResultsContainer">
<a name="top"></a>
<?php if ($totalRows_WADAbc_news > 0) { // Show if recordset not empty ?>
  <div class="WADAResults">
    <div class="WADAResultsNavigation"><wa:insertbutton>
			<div class="WADAResultsInsertButton">
				<input type="button" value="Insert" class="formButton Modular" id="Insert" name="Insert" onclick="document.location.href='bc_news_insert.php';" />
			</div></wa:insertbutton>
      <div class="WADAResultsCount">Records  <?php echo ($startRow_WADAbc_news + 1) ?> to  <?php echo min($startRow_WADAbc_news + $maxRows_WADAbc_news, $totalRows_WADAbc_news) ?> of  <?php echo $totalRows_WADAbc_news ?></div>
			<div class="WADAResultsNavTop">
				<table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
					<tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAbc_news > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Modular" id="First" name="First" onclick="document.location.href='<?php printf("%s?pageNum_WADAbc_news=%d%s", $currentPage, 0, $queryString_WADAbc_news); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAbc_news > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Modular" id="Previous" name="Previous" onclick="document.location.href='<?php printf("%s?pageNum_WADAbc_news=%d%s", $currentPage, max(0, $pageNum_WADAbc_news - 1), $queryString_WADAbc_news); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAbc_news < $totalPages_WADAbc_news) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Modular" id="Next" name="Next" onclick="document.location.href='<?php printf("%s?pageNum_WADAbc_news=%d%s", $currentPage, min($totalPages_WADAbc_news, $pageNum_WADAbc_news + 1), $queryString_WADAbc_news); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAbc_news < $totalPages_WADAbc_news) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Modular" id="Last" name="Last" onclick="document.location.href='<?php printf("%s?pageNum_WADAbc_news=%d%s", $currentPage, $totalPages_WADAbc_news, $queryString_WADAbc_news); ?>';" /><?php } // Show if not last page ?></td>
					</tr>
				</table>
			</div>
    </div>
	<div class="WADAResultsTableWrapper">
    <table class="WADAResultsTable" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <th class="WADAResultsTableHeader">Title:</th>
        <th class="WADAResultsTableHeader">Callout:</th>
        <th class="WADAResultsTableHeader">Author:</th>
        <th class="WADAResultsTableHeader">Publish</th>
        
<wa:optiontest name="INCEDITBUTTONS" value="true">
		<th>&nbsp;</th>
</wa:optiontest>
      </tr>
<?php do { ?>
        <tr class="<?php echo($WARRT_AltClass1->getClass(true)); ?>">
          <td class="WADAResultsTableCell"><a href="bc_news_detail.php?news_id=<?php echo($row_WADAbc_news['news_id']); ?>
<?php echo(isset($_GET["pageNum_WADAbc_news"])?"&pageNum_WADAbc_news=".intval($_GET["pageNum_WADAbc_news"]):""); ?>" ><?php echo($row_WADAbc_news['news_title']); ?></a></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAbc_news['news_callout']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAbc_news['news_author']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAbc_news['publish']); ?></td>
          
		<td class="WADAResultsEditButtons" nowrap="nowrap"><input type="button" class="formButton ResultsPageButton Modular DetailButton" value="" onclick="document.location.href='bc_news_detail.php?news_id=<?php echo($row_WADAbc_news['news_id']); ?>
<?php echo(isset($_GET["pageNum_WADAbc_news"])?"&pageNum_WADAbc_news=".intval($_GET["pageNum_WADAbc_news"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Modular UpdateButton" value="" onclick="document.location.href='bc_news_update.php?news_id=<?php echo($row_WADAbc_news['news_id']); ?>
<?php echo(isset($_GET["pageNum_WADAbc_news"])?"&pageNum_WADAbc_news=".intval($_GET["pageNum_WADAbc_news"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Modular DeleteButton" value="" onclick="document.getElementById('WADADeleteRecordID').value=<?php echo($row_WADAbc_news['news_id']); ?>;document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';" /></td>
        </tr>
<?php } while ($row_WADAbc_news = mysql_fetch_assoc($WADAbc_news)); ?>
    </table>
	</div>
    <div class="WADAResultsNavigation">
      <div class="WADAResultsCountBottom">Records  <?php echo ($startRow_WADAbc_news + 1) ?> to  <?php echo min($startRow_WADAbc_news + $maxRows_WADAbc_news, $totalRows_WADAbc_news) ?> of  <?php echo $totalRows_WADAbc_news ?></div>
      <div class="WADAResultsNavBottom">
        <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
          <tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAbc_news > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Modular" id="First_2" name="First_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAbc_news=%d%s", $currentPage, 0, $queryString_WADAbc_news); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAbc_news > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Modular" id="Previous_2" name="Previous_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAbc_news=%d%s", $currentPage, max(0, $pageNum_WADAbc_news - 1), $queryString_WADAbc_news); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAbc_news < $totalPages_WADAbc_news) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Modular" id="Next_2" name="Next_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAbc_news=%d%s", $currentPage, min($totalPages_WADAbc_news, $pageNum_WADAbc_news + 1), $queryString_WADAbc_news); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAbc_news < $totalPages_WADAbc_news) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Modular" id="Last_2" name="Last_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAbc_news=%d%s", $currentPage, $totalPages_WADAbc_news, $queryString_WADAbc_news); ?>';" /><?php } // Show if not last page ?></td>
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
			<input type="submit" value="Delete" class="formButton Modular" id="Delete" name="Delete" />
			<input type="button" value="Cancel" class="formButton Modular" id="Cancel" name="Cancel" onclick="document.getElementById('deleteBox').style.display = 'none';document.getElementById('deleteMessage').style.display = 'none';"  />
		  </div>
	  </div>
	</div>
  </div>
<?php } // Show if recordset not empty ?>
<?php if ($totalRows_WADAbc_news == 0) { // Show if recordset empty ?>
  <div class="WADANoResults">
    <div class="WADANoResultsMessage">No Results Found</div><wa:insertbutton>
    <div>
      <input type="button" value="Insert" class="formButton Modular" id="Insert" name="Insert" onclick="document.location.href='bc_news_insert.php';" />
    </div></wa:insertbutton>
  </div>
<?php } // Show if recordset empty ?>
</div>

        </fieldset>
<input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAbc_news["news_id"]); ?>" />
</form></div><div id="Results_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Results_Basic_Default', 'Results_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Results_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


</body>
</html>
<?php
mysql_free_result($WADAbc_news);
?>
