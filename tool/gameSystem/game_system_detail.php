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
$Paramgame_system_id_WADAgame_system = "-1";
if (isset($_GET['game_system_id'])) {
  $Paramgame_system_id_WADAgame_system = $_GET['game_system_id'];
}
mysql_select_db($database_local_local, $local_local);
$query_WADAgame_system = sprintf("SELECT game_system_id, game_system_Title, game_system_Title_version, game_system_publisher, game_system_official_url, game_logo, games_category, games_time, noOfPlayers FROM game_system WHERE game_system_id = %s", GetSQLValueString($Paramgame_system_id_WADAgame_system, "int"));
$WADAgame_system = mysql_query($query_WADAgame_system, $local_local) or die(mysql_error());
$row_WADAgame_system = mysql_fetch_assoc($WADAgame_system);
$totalRows_WADAgame_system = mysql_num_rows($WADAgame_system);
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
<div id="Details_Basic_Default_ProgressWrapper">
<form class="DetailsPage Basic_Default" id="Details_Basic_Default" name="Details_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Details">
          <legend class="groupHeader"><?php echo $row_WADAgame_system['game_system_Title']; ?> Details</legend>
        
<div>
<a name="top"></a>
	<?php if ($totalRows_WADAgame_system > 0) { // Show if recordset not empty ?>
	<div id="WADADetails">
			<table class="WADADataTable" cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td class="DetailsSublabel">Title:</td>
				<td class="DetailsPage"><?php echo($row_WADAgame_system['game_system_Title']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Version:</td>
				<td class="DetailsPage"><?php echo($row_WADAgame_system['game_system_Title_version']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Publisher:</td>
				<td class="DetailsPage"><?php echo($row_WADAgame_system['game_system_publisher']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Game System URL:</td>
				<td class="DetailsPage"><?php echo($row_WADAgame_system['game_system_official_url']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Logo</td>
				<td class="DetailsPage"><?php echo($row_WADAgame_system['game_logo']); ?></td>
			</tr>
			<tr>
			  <td class="DetailsSublabel">Logo Thumbnail</td>
			  <td class="DetailsPage"><img src="../uploads/gameSystems/thumbnails/<?php echo $row_WADAgame_system['game_logo']; ?>" /></td>
			  </tr>
			<tr>
				<td class="DetailsSublabel">Category:</td>
				<td class="DetailsPage"><?php echo($row_WADAgame_system['games_category']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Time:</td>
				<td class="DetailsPage"><?php echo($row_WADAgame_system['games_time']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Number of Players:</td>
				<td class="DetailsPage"><?php echo($row_WADAgame_system['noOfPlayers']); ?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</table>
  <hr/>
	</div>
	<?php } // Show if recordset not empty ?>
<?php if ($totalRows_WADAgame_system == 0) { // Show if recordset empty ?>
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
				    <?php if ($totalRows_WADAgame_system > 0) { // Show if recordset not empty ?>
				  <td><input type="button" value="Top" class="" id="Top" name="Top" onclick="window.location.hash='top';" /></td>
					<td><input type="button" value="Update" class="" id="Update" name="Update" onclick="document.location.href = 'game_system_update.php?game_system_id=<?php echo($row_WADAgame_system["game_system_id"]); ?>
<?php echo(isset($_GET["pageNum_WADAgame_system"])?"&pageNum_WADAgame_system=".intval($_GET["pageNum_WADAgame_system"]):""); ?>';" /></td>
					<td><input type="button" value="Delete" class="" id="DeleteConfirm" name="DeleteConfirm" onclick="document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';"  /></td>
					<?php } // Show if recordset not empty ?>
					
				
					
					<td><input type="button" value="Back To Results" class="" id="BackToResults" name="BackToResults" onclick="document.location.href = 'game_system_results.php<?php echo(isset($_GET["pageNum_WADAgame_system"])?"?pageNum_WADAgame_system=".intval($_GET["pageNum_WADAgame_system"]):""); ?>';" /></td>
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
      <input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAgame_system["game_system_id"]); ?>" />
	  <div class="messageContent">
		This will permanently remove the record from your database.<br/>
		This action cannot be undone.<br/><br/>
		<input type="submit" value="Delete" class="" id="Delete" name="Delete" />
		<input type="button" value="Cancel" class="" id="Cancel" name="Cancel" onclick="document.getElementById('deleteBox').style.display = 'none';document.getElementById('deleteMessage').style.display = 'none';"  />
	  </div>
	</form>
  </div>
</div>

		<?php include '../includes/parts/container-bottom.php'; ?>
	<?php include '../includes/parts/footer.php'; ?>
<?php
mysql_free_result($WADAgame_system);
?>
