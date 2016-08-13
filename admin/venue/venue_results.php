<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/database_management/wada_search.php"); ?>
<?php
//WA Database Search (Copyright 2005, WebAssist.com)
//Recordset: WADAvenue;
//Searchpage: venue_search.php;
//Form: WADASearchForm;
$WADbSearch1_DefaultWhere = "";
if (!session_id()) session_start();
if (isset($_GET["Search"]) || isset($_GET["Search_x"])) {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //keyword array declarations

  //comparison list additions
  $WADbSearch1->addComparisonFromEdit("venue_Name","venue_Name","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("venue_Street_Address","venue_Street_Address","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("venue_city","venue_city","AND","Includes",0);
  $WADbSearch1->addComparisonFromEdit("venue_state","venue_state","AND","=",0);
  $WADbSearch1->addComparisonFromEdit("venue_contact_name","venue_contact_name","AND","Includes",0);

  //save the query in a session variable
  if (1 == 1) {
    $_SESSION["WADbSearch1_venue_results"]=$WADbSearch1->whereClause;
  }
}
else     {
  $WADbSearch1 = new FilterDef;
  $WADbSearch1->initializeQueryBuilder("MYSQL","1");
  //get the filter definition from a session variable
  if (1 == 1)     {
    if (isset($_SESSION["WADbSearch1_venue_results"]) && $_SESSION["WADbSearch1_venue_results"] != "")     {
      $WADbSearch1->whereClause = $_SESSION["WADbSearch1_venue_results"];
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
mysql_select_db($database_local, $local);
$query_WADAMenuvenue_state = "SELECT state_name, state_abbr FROM tbl_state ORDER BY state_name ASC";
$WADAMenuvenue_state = mysql_query($query_WADAMenuvenue_state, $local) or die(mysql_error());
$row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state);
$totalRows_WADAMenuvenue_state = mysql_num_rows($WADAMenuvenue_state);
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
?>
<?php
$queryString_WADAvenue = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_WADAvenue") == false && 
        stristr($param, "totalRows_WADAvenue") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_WADAvenue = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_WADAvenue = sprintf("&totalRows_WADAvenue=%d%s", $totalRows_WADAvenue, $queryString_WADAvenue);
?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete"]) || isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "venue";
  $WA_redirectURL = "venue_results.php?venue_id=".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "venue_id";
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
$maxRows_WADAvenue = 15;
$pageNum_WADAvenue = 0;
if (isset($_GET['pageNum_WADAvenue'])) {
  $pageNum_WADAvenue = $_GET['pageNum_WADAvenue'];
}
$startRow_WADAvenue = $pageNum_WADAvenue * $maxRows_WADAvenue;

mysql_select_db($database_local, $local);
$query_WADAvenue = "SELECT venue_id, venue_Name, venue_city, `tbl_state`.`state_name` AS tbl_state_state_name, venue_outriders, venue_player_capacity FROM venue LEFT JOIN tbl_state ON tbl_state.state_abbr = venue.venue_state";
setQueryBuilderSource($query_WADAvenue,$WADbSearch1,false);
$query_limit_WADAvenue = sprintf("%s LIMIT %d, %d", $query_WADAvenue, $startRow_WADAvenue, $maxRows_WADAvenue);
$WADAvenue = mysql_query($query_limit_WADAvenue, $local) or die(mysql_error());
$row_WADAvenue = mysql_fetch_assoc($WADAvenue);

if (isset($_GET['totalRows_WADAvenue'])) {
  $totalRows_WADAvenue = $_GET['totalRows_WADAvenue'];
} else {
  $all_WADAvenue = mysql_query($query_WADAvenue);
  $totalRows_WADAvenue = mysql_num_rows($all_WADAvenue);
}
$totalPages_WADAvenue = ceil($totalRows_WADAvenue/$maxRows_WADAvenue)-1;
?>

<?php include '../includes/parts/head-venue-list.php'; ?>
	<?php include '../includes/parts/header.php'; ?>
		<?php include '../includes/parts/container-top-create-venue.php'; ?>
<body>
<div id="Search_Basic_Default_ProgressWrapper">
  <form class="Basic_Default" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="venue_results.php">
    <fieldset class="Basic_Default" id="Search">
      <legend class="groupHeader">Search</legend>
      <div class="lineGroup">
        <label for="venue_Name" class="sublabel" > Name:</label>
        <input id="venue_Name" name="venue_Name" type="text" value="<?php echo((isset($_GET["venue_Name"])?$_GET["venue_Name"]:"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value.">
      </div>
      <div class="lineGroup">
        <label for="venue_Street_Address" class="sublabel" > Street Address:</label>
        <input id="venue_Street_Address" name="venue_Street_Address" type="text" value="<?php echo((isset($_GET["venue_Street_Address"])?$_GET["venue_Street_Address"]:"")); ?>" class="formTextfield_Large" tabindex="2" title="Please enter a value.">
      </div>
      <div class="lineGroup">
        <label for="venue_city" class="sublabel" > City:</label>
        <input id="venue_city" name="venue_city" type="text" value="<?php echo((isset($_GET["venue_city"])?$_GET["venue_city"]:"")); ?>" class="formTextfield_Large" tabindex="3" title="Please enter a value.">
      </div>
      <div class="lineGroup">
        <label for="venue_state" class="sublabel" > State:</label>
        <select class="formMenufield_Large" name="venue_state" id="venue_state" rel="<?php echo((isset($_GET["venue_state"])?$_GET["venue_state"]:"")); ?>" tabindex="4" title="Please enter a value.">
          <option value="">Choose State...</option>
          <?php
do {  
?>
          <option value="<?php echo $row_WADAMenuvenue_state['state_abbr']?>"<?php if (!(strcmp($row_WADAMenuvenue_state['state_abbr'], (isset($_GET["venue_state"])?$_GET["venue_state"]:"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuvenue_state['state_name']?></option>
          <?php
} while ($row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state));
  $rows = mysql_num_rows($WADAMenuvenue_state);
  if($rows > 0) {
      mysql_data_seek($WADAMenuvenue_state, 0);
	  $row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state);
  }
?>
        </select>
      </div>
      <div class="lineGroup">
        <label for="venue_contact_name" class="sublabel" > Main Contact:</label>
        <input id="venue_contact_name" name="venue_contact_name" type="text" value="<?php echo((isset($_GET["venue_contact_name"])?$_GET["venue_contact_name"]:"")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
      </div>
      <span class="buttonFieldGroup" >
        <input type="submit" value="Search" class="formButton Modular" id="Search" name="Search" />
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
<?php if ($totalRows_WADAvenue > 0) { // Show if recordset not empty ?>
  <div class="WADAResults">
    <div class="WADAResultsNavigation"><wa:insertbutton>
			<div class="WADAResultsInsertButton">
				<input type="button" value="Insert" class="formButton Modular" id="Insert" name="Insert" onclick="document.location.href='venue_insert.php';" />
			</div></wa:insertbutton>
      <div class="WADAResultsCount">Records  <?php echo ($startRow_WADAvenue + 1) ?> to  <?php echo min($startRow_WADAvenue + $maxRows_WADAvenue, $totalRows_WADAvenue) ?> of  <?php echo $totalRows_WADAvenue ?></div>
			<div class="WADAResultsNavTop">
				<table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
					<tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAvenue > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Modular" id="First" name="First" onclick="document.location.href='<?php printf("%s?pageNum_WADAvenue=%d%s", $currentPage, 0, $queryString_WADAvenue); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAvenue > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Modular" id="Previous" name="Previous" onclick="document.location.href='<?php printf("%s?pageNum_WADAvenue=%d%s", $currentPage, max(0, $pageNum_WADAvenue - 1), $queryString_WADAvenue); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAvenue < $totalPages_WADAvenue) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Modular" id="Next" name="Next" onclick="document.location.href='<?php printf("%s?pageNum_WADAvenue=%d%s", $currentPage, min($totalPages_WADAvenue, $pageNum_WADAvenue + 1), $queryString_WADAvenue); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAvenue < $totalPages_WADAvenue) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Modular" id="Last" name="Last" onclick="document.location.href='<?php printf("%s?pageNum_WADAvenue=%d%s", $currentPage, $totalPages_WADAvenue, $queryString_WADAvenue); ?>';" /><?php } // Show if not last page ?></td>
					</tr>
				</table>
			</div>
    </div>
	<div class="WADAResultsTableWrapper">
    <table class="WADAResultsTable" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <th class="WADAResultsTableHeader">Name:</th>
        <th class="WADAResultsTableHeader">City:</th>
        <th class="WADAResultsTableHeader">State:</th>
        <th class="WADAResultsTableHeader">Outriders:</th>
        <th class="WADAResultsTableHeader">Player Capacity:</th>
        
<wa:optiontest name="INCEDITBUTTONS" value="true">
		<th>&nbsp;</th>
</wa:optiontest>
      </tr>
<?php do { ?>
        <tr class="<?php echo($WARRT_AltClass1->getClass(true)); ?>">
          <td class="WADAResultsTableCell"><a href="venue_detail.php?venue_id=<?php echo($row_WADAvenue['venue_id']); ?>
<?php echo(isset($_GET["pageNum_WADAvenue"])?"&pageNum_WADAvenue=".intval($_GET["pageNum_WADAvenue"]):""); ?>" ><?php echo($row_WADAvenue['venue_Name']); ?></a></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAvenue['venue_city']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAvenue['tbl_state_state_name']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAvenue['venue_outriders']); ?></td>
          <td class="WADAResultsTableCell"><?php echo($row_WADAvenue['venue_player_capacity']); ?></td>
          
		<td class="WADAResultsEditButtons" nowrap="nowrap"><input type="button" class="formButton ResultsPageButton Modular DetailButton" value="" onclick="document.location.href='venue_detail.php?venue_id=<?php echo($row_WADAvenue['venue_id']); ?>
<?php echo(isset($_GET["pageNum_WADAvenue"])?"&pageNum_WADAvenue=".intval($_GET["pageNum_WADAvenue"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Modular UpdateButton" value="" onclick="document.location.href='venue_update.php?venue_id=<?php echo($row_WADAvenue['venue_id']); ?>
<?php echo(isset($_GET["pageNum_WADAvenue"])?"&pageNum_WADAvenue=".intval($_GET["pageNum_WADAvenue"]):""); ?>';"/><input type="button" class="formButton ResultsPageButton Modular DeleteButton" value="" onclick="document.getElementById('WADADeleteRecordID').value=<?php echo($row_WADAvenue['venue_id']); ?>;document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';" /></td>
        </tr>
<?php } while ($row_WADAvenue = mysql_fetch_assoc($WADAvenue)); ?>
    </table>
	</div>
    <div class="WADAResultsNavigation">
      <div class="WADAResultsCountBottom">Records  <?php echo ($startRow_WADAvenue + 1) ?> to  <?php echo min($startRow_WADAvenue + $maxRows_WADAvenue, $totalRows_WADAvenue) ?> of  <?php echo $totalRows_WADAvenue ?></div>
      <div class="WADAResultsNavBottom">
        <table border="0" cellpadding="0" cellspacing="0" class="WADAResultsNavTable">
          <tr valign="middle">
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAvenue > 0) { // Show if not first page ?><input type="button" value="<<" class="formButton ResultsNavButton Modular" id="First_2" name="First_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAvenue=%d%s", $currentPage, 0, $queryString_WADAvenue); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAvenue > 0) { // Show if not first page ?><input type="button" value="<" class="formButton ResultsNavButton Modular" id="Previous_2" name="Previous_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAvenue=%d%s", $currentPage, max(0, $pageNum_WADAvenue - 1), $queryString_WADAvenue); ?>';" /><?php } // Show if not first page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAvenue < $totalPages_WADAvenue) { // Show if not last page ?><input type="button" value=">" class="formButton ResultsNavButton Modular" id="Next_2" name="Next_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAvenue=%d%s", $currentPage, min($totalPages_WADAvenue, $pageNum_WADAvenue + 1), $queryString_WADAvenue); ?>';" /><?php } // Show if not last page ?></td>
            <td class="WADAResultsNavButtonCell" nowrap="nowrap"><?php if ($pageNum_WADAvenue < $totalPages_WADAvenue) { // Show if not last page ?><input type="button" value=">>" class="formButton ResultsNavButton Modular" id="Last_2" name="Last_2" onclick="document.location.href='<?php printf("%s?pageNum_WADAvenue=%d%s", $currentPage, $totalPages_WADAvenue, $queryString_WADAvenue); ?>';" /><?php } // Show if not last page ?></td>
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
<?php if ($totalRows_WADAvenue == 0) { // Show if recordset empty ?>
  <div class="WADANoResults">
    <div class="WADANoResultsMessage">No Results Found</div><wa:insertbutton>
    <div>
      <input type="button" value="Insert" class="formButton Modular" id="Insert" name="Insert" onclick="document.location.href='venue_insert.php';" />
    </div></wa:insertbutton>
  </div>
<?php } // Show if recordset empty ?>
</div>

        </fieldset>
<input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAvenue["venue_id"]); ?>" />
</form></div><div id="Results_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Results_Basic_Default', 'Results_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Results_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>
<div id="Search_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
  <script type="text/javascript">
WADFP_SetProgressToForm('Search_Basic_Default', 'Search_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
  </script>
  <div id="Search_Basic_Default_ProgressMessage" >
    <p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
  </div>
</div>
<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>

		<?php include '../includes/parts/container-bottom.php'; ?>
	<?php include '../includes/parts/footer.php'; ?>
<?php
mysql_free_result($WADAMenuvenue_state);
?>
<?php
mysql_free_result($WADAvenue);
?>
