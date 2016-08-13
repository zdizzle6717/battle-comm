<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
 if ((isset($_GET["Search"]) || isset($_GET["Search_x"])) && !isset($_GET["invalid"]))  {
   $WAFV_Redirect = "user_profile_search.php?invalid=true";
   $_SESSION['WAVT_userprofilesearch_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_GET["user_email"])?$_GET["user_email"]:"") . "",false,1);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userprofilesearch");
   }
 }
 ?>
<?php require_once("../webassist/database_management/wada_search.php"); ?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: WADAuser_profile;
//Searchpage: user_profile_search.php;
//Form: WADASearchForm;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if (isset($_GET["Search"]) || isset($_GET["Search_x"])) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromEdit("username","username","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("user_firstName","user_firstName","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("user_lastName","user_lastName","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("user_email","user_email","AND","Includes",0);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_user_profile_results"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_user_profile_results"]) && $_SESSION["WADbSearch1_user_profile_results"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_user_profile_results"];
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
$maxRows_WADAuser_profile = 10;
$pageNum_WADAuser_profile = 0;
if (isset($_GET['pageNum_WADAuser_profile'])) {
  $pageNum_WADAuser_profile = $_GET['pageNum_WADAuser_profile'];
}
$startRow_WADAuser_profile = $pageNum_WADAuser_profile * $maxRows_WADAuser_profile;

mysql_select_db($database_local_local, $local_local);
$query_WADAuser_profile = "SELECT iduser_profile, username, user_lastName, user_firstName, user_email FROM user_profile";
setQueryBuilderSource($query_WADAuser_profile,$WADbSearch1,false);
$query_limit_WADAuser_profile = sprintf("%s LIMIT %d, %d", $query_WADAuser_profile, $startRow_WADAuser_profile, $maxRows_WADAuser_profile);
$WADAuser_profile = mysql_query($query_limit_WADAuser_profile, $local_local) or die(mysql_error());
$row_WADAuser_profile = mysql_fetch_assoc($WADAuser_profile);

if (isset($_GET['totalRows_WADAuser_profile'])) {
  $totalRows_WADAuser_profile = $_GET['totalRows_WADAuser_profile'];
} else {
  $all_WADAuser_profile = mysql_query($query_WADAuser_profile, $local_local);
  $totalRows_WADAuser_profile = mysql_num_rows($all_WADAuser_profile);
}
$totalPages_WADAuser_profile = ceil($totalRows_WADAuser_profile/$maxRows_WADAuser_profile)-1;
?>
<?php
$queryString_WADAuser_profile = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_WADAuser_profile") == false && 
        stristr($param, "totalRows_WADAuser_profile") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_WADAuser_profile = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_WADAuser_profile = sprintf("&totalRows_WADAuser_profile=%d%s", $totalRows_WADAuser_profile, $queryString_WADAuser_profile);
?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete"]) || isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "user_profile";
  $WA_redirectURL = "user_profile_results.php?iduser_profile=".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "iduser_profile";
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
<link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Search_Basic_Default_ProgressWrapper">
  <form class="Basic_Default" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="user_profile_results.php">
    <fieldset class="Basic_Default" id="Search">
      <legend class="groupHeader">Search</legend>
      <div class="lineGroup">
        <label for="username" class="sublabel" > Username:</label>
        <input id="username" name="username" type="text" value="<?php echo((isset($_GET["username"])?$_GET["username"]:"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
      </div>
      <div class="lineGroup">
        <label for="user_firstName" class="sublabel" > First Name:</label>
        <input id="user_firstName" name="user_firstName" type="text" value="<?php echo((isset($_GET["user_firstName"])?$_GET["user_firstName"]:"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
      </div>
      <div class="lineGroup">
        <label for="user_lastName" class="sublabel" > Last Name:</label>
        <input id="user_lastName" name="user_lastName" type="text" value="<?php echo((isset($_GET["user_lastName"])?$_GET["user_lastName"]:"")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
      </div>
      <div class="lineGroup">
        <label for="user_email" class="sublabel" > Email:</label>
        <input id="user_email" name="user_email" type="text" value="<?php echo((isset($_GET["user_email"])?$_GET["user_email"]:"")); ?>" class="formTextfield_Large" tabindex="4" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value.">
        <?php
if (ValidatedField('userprofileresults','userprofileresults'))  {
  if ((strpos((",".ValidatedField("userprofileresults","userprofileresults").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?>
          <span class="serverInvalidState" id="user_email_ServerError">Please enter a value.</span>
          <?php //WAFV_Conditional user_profile_results.php userprofileresults(1:)
    }
  }
}?>
      </div>
      <span class="buttonFieldGroup" >
        <input type="submit" value="Search" class="" id="Search" name="Search" />
      </span>
    </fieldset>
  </form>
</div>
<div id="Results_Basic_Default_ProgressResultsWrapper">
<form class="DetailsPage Basic_Default" id="Results_Basic_Default" name="Results_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Results">
          <legend class="groupHeader">Results</legend>
        
<div class="WADAResultsContainer">
<a name="top"></a>
<?php if ($totalRows_WADAuser_profile > 0) { // Show if recordset not empty ?>
  <div class="WADAResults">
    <div class="WADAResultsNavigation"><wa:insertbutton>
			<div class="WADAResultsInsertButton">
				<input type="button" value="Insert" class="" id="Insert" name="Insert" onclick="document.location.href='user_profile_insert.php';" />
			</div></wa:insertbutton>
      <div class="WADAResultsCount">Records  <?php echo ($startRow_WADAuser_profile + 1) ?> to  <?php echo min($startRow_WADAuser_profile + $maxRows_WADAuser_profile, $totalRows_WADAuser_profile) ?> of  <?php echo $totalRows_WADAuser_profile ?></div>
			<div class="WADAResultsNavTop">
				<table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
					<tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAuser_profile > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Dark" id="First" name="First" onclick="document.location.href='<?php printf("%s?pageNum_WADAuser_profile=%d%s", $currentPage, 0, $queryString_WADAuser_profile); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAuser_profile > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Dark" id="Previous" name="Previous" onclick="document.location.href='<?php printf("%s?pageNum_WADAuser_profile=%d%s", $currentPage, max(0, $pageNum_WADAuser_profile - 1), $queryString_WADAuser_profile); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAuser_profile < $totalPages_WADAuser_profile) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Dark" id="Next" name="Next" onclick="document.location.href='<?php printf("%s?pageNum_WADAuser_profile=%d%s", $currentPage, min($totalPages_WADAuser_profile, $pageNum_WADAuser_profile + 1), $queryString_WADAuser_profile); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAuser_profile < $totalPages_WADAuser_profile) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Dark" id="Last" name="Last" onclick="document.location.href='<?php printf("%s?pageNum_WADAuser_profile=%d%s", $currentPage, $totalPages_WADAuser_profile, $queryString_WADAuser_profile); ?>';" /><?php } // Show if not last page ?></td>
					</tr>
				</table>
			</div>
    </div>
	<div class="WADAResultsTableWrapper">
    <table class="WADAResultsTable" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <th class="WADAResultsTableHeader">Username:</th>
        <th class="WADAResultsTableHeader">Last Name</th>
        <th class="WADAResultsTableHeader">First Name:</th>
        <th class="WADAResultsTableHeader">Email:</th>
        
<wa:optiontest name="INCEDITBUTTONS" value="true">
		<th>&nbsp;</th>
</wa:optiontest>
      </tr>
<?php do { ?>
        <tr class="<?php echo($WARRT_AltClass1->getClass(true)); ?>">
          <td class="WADAResultsTableCell"><a href="user_profile_detail.php?iduser_profile=<?php echo($row_WADAuser_profile['iduser_profile']); ?>
<?php echo(isset($_GET["pageNum_WADAuser_profile"])?"&pageNum_WADAuser_profile=".intval($_GET["pageNum_WADAuser_profile"]):""); ?>" ><?php echo($row_WADAuser_profile['username']); ?></a></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAuser_profile['user_lastName']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAuser_profile['user_firstName']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAuser_profile['user_email']); ?></td>
          
		<td class="WADAResultsEditButtons" nowrap="nowrap"><input type="button" class="formButton ResultsPageButton Dark DetailButton" value="" onclick="document.location.href='user_profile_detail.php?iduser_profile=<?php echo($row_WADAuser_profile['iduser_profile']); ?>
<?php echo(isset($_GET["pageNum_WADAuser_profile"])?"&pageNum_WADAuser_profile=".intval($_GET["pageNum_WADAuser_profile"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Dark UpdateButton" value="" onclick="document.location.href='user_profile_update.php?iduser_profile=<?php echo($row_WADAuser_profile['iduser_profile']); ?>
<?php echo(isset($_GET["pageNum_WADAuser_profile"])?"&pageNum_WADAuser_profile=".intval($_GET["pageNum_WADAuser_profile"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Dark DeleteButton" value="" onclick="document.getElementById('WADADeleteRecordID').value=<?php echo($row_WADAuser_profile['iduser_profile']); ?>;document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';" /></td>
        </tr>
<?php } while ($row_WADAuser_profile = mysql_fetch_assoc($WADAuser_profile)); ?>
    </table>
	</div>
    <div class="WADAResultsNavigation">
      <div class="WADAResultsCountBottom">Records  <?php echo ($startRow_WADAuser_profile + 1) ?> to  <?php echo min($startRow_WADAuser_profile + $maxRows_WADAuser_profile, $totalRows_WADAuser_profile) ?> of  <?php echo $totalRows_WADAuser_profile ?></div>
      <div class="WADAResultsNavBottom">
        <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
          <tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAuser_profile > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Dark" id="First_2" name="First_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAuser_profile=%d%s", $currentPage, 0, $queryString_WADAuser_profile); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAuser_profile > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Dark" id="Previous_2" name="Previous_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAuser_profile=%d%s", $currentPage, max(0, $pageNum_WADAuser_profile - 1), $queryString_WADAuser_profile); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAuser_profile < $totalPages_WADAuser_profile) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Dark" id="Next_2" name="Next_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAuser_profile=%d%s", $currentPage, min($totalPages_WADAuser_profile, $pageNum_WADAuser_profile + 1), $queryString_WADAuser_profile); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAuser_profile < $totalPages_WADAuser_profile) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Dark" id="Last_2" name="Last_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAuser_profile=%d%s", $currentPage, $totalPages_WADAuser_profile, $queryString_WADAuser_profile); ?>';" /><?php } // Show if not last page ?></td>
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
<?php if ($totalRows_WADAuser_profile == 0) { // Show if recordset empty ?>
  <div class="WADANoResults">
    <div class="WADANoResultsMessage">No Results Found</div><wa:insertbutton>
    <div>
      <input type="button" value="Insert" class="" id="Insert" name="Insert" onclick="document.location.href='user_profile_insert.php';" />
    </div></wa:insertbutton>
  </div>
<?php } // Show if recordset empty ?>
</div>

        </fieldset>
<input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAuser_profile["iduser_profile"]); ?>" />
</form></div><div id="Results_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Results_Basic_Default', 'Results_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Results_Basic_Default_ProgressMessage" >
  <div id="Search_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
    <script type="text/javascript">
WADFP_SetProgressToForm('Search_Basic_Default', 'Search_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
  </script>
    <div id="Search_Basic_Default_ProgressMessage" >
      <p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
    </div>
  </div>
</div>
</div>
<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
</body>
</html>
<?php
mysql_free_result($WADAuser_profile);
?>
