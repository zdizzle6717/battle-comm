<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php require_once("../webassist/database_management/wada_search.php"); ?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: WADAgame_system;
//Searchpage: game_system_search.php;
//Form: WADASearchForm;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if (isset($_GET["Search"]) || isset($_GET["Search_x"])) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromEdit("game_system_Title","game_system_Title","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("game_system_publisher","game_system_publisher","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("games_category","games_category","AND","=",0);
  $WADbSearch1->addComparisonFromEdit("games_time","games_time","AND","Includes",0);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_game_system_results"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_game_system_results"]) && $_SESSION["WADbSearch1_game_system_results"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_game_system_results"];
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
$maxRows_WADAgame_system = 15;
$pageNum_WADAgame_system = 0;
if (isset($_GET['pageNum_WADAgame_system'])) {
  $pageNum_WADAgame_system = $_GET['pageNum_WADAgame_system'];
}
$startRow_WADAgame_system = $pageNum_WADAgame_system * $maxRows_WADAgame_system;

mysql_select_db($database_local_local, $local_local);
$query_WADAgame_system = "SELECT game_system_id, game_system_Title, game_system_publisher, games_category, noOfPlayers FROM game_system";
setQueryBuilderSource($query_WADAgame_system,$WADbSearch1,false);
$query_limit_WADAgame_system = sprintf("%s LIMIT %d, %d", $query_WADAgame_system, $startRow_WADAgame_system, $maxRows_WADAgame_system);
$WADAgame_system = mysql_query($query_limit_WADAgame_system, $local_local) or die(mysql_error());
$row_WADAgame_system = mysql_fetch_assoc($WADAgame_system);

if (isset($_GET['totalRows_WADAgame_system'])) {
  $totalRows_WADAgame_system = $_GET['totalRows_WADAgame_system'];
} else {
  $all_WADAgame_system = mysql_query($query_WADAgame_system, $local_local);
  $totalRows_WADAgame_system = mysql_num_rows($all_WADAgame_system);
}
$totalPages_WADAgame_system = ceil($totalRows_WADAgame_system/$maxRows_WADAgame_system)-1;
?>
<?php
mysql_select_db($database_local_local, $local_local);
$query_WADAMenugames_category = "SELECT game_category FROM game_categories ORDER BY game_category ASC";
$WADAMenugames_category = mysql_query($query_WADAMenugames_category, $local_local) or die(mysql_error());
$row_WADAMenugames_category = mysql_fetch_assoc($WADAMenugames_category);
$totalRows_WADAMenugames_category = mysql_num_rows($WADAMenugames_category);
?>
<?php
$queryString_WADAgame_system = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_WADAgame_system") == false && 
        stristr($param, "totalRows_WADAgame_system") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_WADAgame_system = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_WADAgame_system = sprintf("&totalRows_WADAgame_system=%d%s", $totalRows_WADAgame_system, $queryString_WADAgame_system);
?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete"]) || isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "game_system";
  $WA_redirectURL = "game_system_results.php?game_system_id=".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "game_system_id";
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
<?php include '../includes/parts/head-gameSystem.php'; ?>
	<?php include '../includes/parts/header.php'; ?>
		<?php include '../includes/parts/container-top.php'; ?>

<div class="row">
    <div class="col-lg-12">
      <h2>Game Systems</h2>
    </div>
</div>
<div class="row" id="nav">
	<?php include("../nav.php"); ?>
</div>
<div id="Search_Basic_Default_ProgressWrapper">
  <form class="Basic_Default" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="game_system_results.php">
    <fieldset class="Basic_Default" id="Search">
      <legend class="groupHeader">Search</legend>
      <div class="lineGroup">
        <label for="game_system_Title" class="sublabel" > Title:</label>
        <input id="game_system_Title" name="game_system_Title" type="text" value="<?php echo((isset($_GET["game_system_Title"])?$_GET["game_system_Title"]:"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value.">
      </div>
      <div class="lineGroup">
        <label for="game_system_publisher" class="sublabel" > Publisher:</label>
        <input id="game_system_publisher" name="game_system_publisher" type="text" value="<?php echo((isset($_GET["game_system_publisher"])?$_GET["game_system_publisher"]:"")); ?>" class="formTextfield_Large" tabindex="2" title="Please enter a value.">
      </div>
      <div class="lineGroup">
        <label for="games_category" class="sublabel" > Category:</label>
        <select class="formMenufield_Large" name="games_category" id="games_category" rel="<?php echo((isset($_GET["games_category"])?$_GET["games_category"]:"")); ?>" tabindex="3" title="Please enter a value.">
          <option value="">Choose Category...</option>
          <?php
do {  
?>
          <option value="<?php echo $row_WADAMenugames_category['game_category']?>"<?php if (!(strcmp($row_WADAMenugames_category['game_category'], (isset($_GET["games_category"])?$_GET["games_category"]:"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugames_category['game_category']?></option>
          <?php
} while ($row_WADAMenugames_category = mysql_fetch_assoc($WADAMenugames_category));
  $rows = mysql_num_rows($WADAMenugames_category);
  if($rows > 0) {
      mysql_data_seek($WADAMenugames_category, 0);
	  $row_WADAMenugames_category = mysql_fetch_assoc($WADAMenugames_category);
  }
?>
        </select>
      </div>
      <div class="lineGroup">
        <label for="games_time" class="sublabel" > Time:</label>
        <input id="games_time" name="games_time" type="text" value="<?php echo((isset($_GET["games_time"])?$_GET["games_time"]:"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
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
<?php if ($totalRows_WADAgame_system > 0) { // Show if recordset not empty ?>
  <div class="WADAResults">
    <div class="WADAResultsNavigation"><wa:insertbutton>
			<div class="WADAResultsInsertButton">
				<input type="button" value="Insert" class="" id="Insert" name="Insert" onclick="document.location.href='game_system_insert.php';" />
			</div></wa:insertbutton>
      <div class="WADAResultsCount">Records  <?php echo ($startRow_WADAgame_system + 1) ?> to  <?php echo min($startRow_WADAgame_system + $maxRows_WADAgame_system, $totalRows_WADAgame_system) ?> of  <?php echo $totalRows_WADAgame_system ?></div>
			<div class="WADAResultsNavTop">
				<table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
					<tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_system > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Dark" id="First" name="First" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_system=%d%s", $currentPage, 0, $queryString_WADAgame_system); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_system > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Dark" id="Previous" name="Previous" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_system=%d%s", $currentPage, max(0, $pageNum_WADAgame_system - 1), $queryString_WADAgame_system); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_system < $totalPages_WADAgame_system) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Dark" id="Next" name="Next" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_system=%d%s", $currentPage, min($totalPages_WADAgame_system, $pageNum_WADAgame_system + 1), $queryString_WADAgame_system); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_system < $totalPages_WADAgame_system) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Dark" id="Last" name="Last" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_system=%d%s", $currentPage, $totalPages_WADAgame_system, $queryString_WADAgame_system); ?>';" /><?php } // Show if not last page ?></td>
					</tr>
				</table>
			</div>
    </div>
	<div class="WADAResultsTableWrapper">
    <table class="WADAResultsTable" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <th class="WADAResultsTableHeader">Title:</th>
        <th class="WADAResultsTableHeader">Publisher:</th>
        <th class="WADAResultsTableHeader">Category:</th>
        <th class="WADAResultsTableHeader">Number of Players:</th>
        
<wa:optiontest name="INCEDITBUTTONS" value="true">
		<th>&nbsp;</th>
</wa:optiontest>
      </tr>
<?php do { ?>
        <tr class="<?php echo($WARRT_AltClass1->getClass(true)); ?>">
          <td class="WADAResultsTableCell"><a href="game_system_detail.php?game_system_id=<?php echo($row_WADAgame_system['game_system_id']); ?>
<?php echo(isset($_GET["pageNum_WADAgame_system"])?"&pageNum_WADAgame_system=".intval($_GET["pageNum_WADAgame_system"]):""); ?>" ><?php echo($row_WADAgame_system['game_system_Title']); ?></a></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAgame_system['game_system_publisher']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAgame_system['games_category']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAgame_system['noOfPlayers']); ?></td>
          
		<td class="WADAResultsEditButtons" nowrap="nowrap"><input type="button" class="formButton ResultsPageButton Dark DetailButton" value="" onclick="document.location.href='game_system_detail.php?game_system_id=<?php echo($row_WADAgame_system['game_system_id']); ?>
<?php echo(isset($_GET["pageNum_WADAgame_system"])?"&pageNum_WADAgame_system=".intval($_GET["pageNum_WADAgame_system"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Dark UpdateButton" value="" onclick="document.location.href='game_system_update.php?game_system_id=<?php echo($row_WADAgame_system['game_system_id']); ?>
<?php echo(isset($_GET["pageNum_WADAgame_system"])?"&pageNum_WADAgame_system=".intval($_GET["pageNum_WADAgame_system"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Dark DeleteButton" value="" onclick="document.getElementById('WADADeleteRecordID').value=<?php echo($row_WADAgame_system['game_system_id']); ?>;document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';" /></td>
        </tr>
<?php } while ($row_WADAgame_system = mysql_fetch_assoc($WADAgame_system)); ?>
    </table>
	</div>
    <div class="WADAResultsNavigation">
      <div class="WADAResultsCountBottom">Records  <?php echo ($startRow_WADAgame_system + 1) ?> to  <?php echo min($startRow_WADAgame_system + $maxRows_WADAgame_system, $totalRows_WADAgame_system) ?> of  <?php echo $totalRows_WADAgame_system ?></div>
      <div class="WADAResultsNavBottom">
        <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
          <tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_system > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Dark" id="First_2" name="First_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_system=%d%s", $currentPage, 0, $queryString_WADAgame_system); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_system > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Dark" id="Previous_2" name="Previous_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_system=%d%s", $currentPage, max(0, $pageNum_WADAgame_system - 1), $queryString_WADAgame_system); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_system < $totalPages_WADAgame_system) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Dark" id="Next_2" name="Next_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_system=%d%s", $currentPage, min($totalPages_WADAgame_system, $pageNum_WADAgame_system + 1), $queryString_WADAgame_system); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAgame_system < $totalPages_WADAgame_system) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Dark" id="Last_2" name="Last_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAgame_system=%d%s", $currentPage, $totalPages_WADAgame_system, $queryString_WADAgame_system); ?>';" /><?php } // Show if not last page ?></td>
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
<?php if ($totalRows_WADAgame_system == 0) { // Show if recordset empty ?>
  <div class="WADANoResults">
    <div class="WADANoResultsMessage">No Results Found</div><wa:insertbutton>
    <div>
      <input type="button" value="Insert" class="" id="Insert" name="Insert" onclick="document.location.href='game_system_insert.php';" />
    </div></wa:insertbutton>
  </div>
<?php } // Show if recordset empty ?>
</div>

        </fieldset>
<input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAgame_system["game_system_id"]); ?>" />
</form></div><div id="Results_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Results_Basic_Default', 'Results_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Results_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
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

		<?php include '../includes/parts/container-bottom.php'; ?>
	<?php include '../includes/parts/footer.php'; ?>
<?php
mysql_free_result($WADAgame_system);
?>
<?php
mysql_free_result($WADAMenugames_category);
?>
