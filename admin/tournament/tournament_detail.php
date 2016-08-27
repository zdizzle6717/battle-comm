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
$Paramtournament_id_WADAtournament = "-1";
if (isset($_GET['tournament_id'])) {
  $Paramtournament_id_WADAtournament = $_GET['tournament_id'];
}
mysql_select_db($database_local, $local);
$query_WADAtournament = sprintf("SELECT tournament_id, tournament_name, tournament_startDate, tournament_startTime, Tournament_endDate, Tournament_endTime, tournament_store_location, tournament_add_new_location, `tournament_location _name`, tournament_logo_icon, tournament_address, tournament_city, tournament_state, tournament_zip, tournament_phone, tournament_email, tournament_URL, tournament_admin_id, tournament_admin_name, tournament_info, tournament_notes, tournament_rounds, factions_cap, No_of_Games, `game_system`.`game_system_Title` AS game_system_game_system_Title, game_title, WinPointValue, DrawPointValue, LossPointValue FROM tournament LEFT JOIN game_system ON game_system.game_system_id = tournament.game_id WHERE tournament_id = %s", GetSQLValueString($Paramtournament_id_WADAtournament, "int"));
$WADAtournament = mysql_query($query_WADAtournament, $local) or die(mysql_error());
$row_WADAtournament = mysql_fetch_assoc($WADAtournament);
$totalRows_WADAtournament = mysql_num_rows($WADAtournament);
?>
<?php 
// WA Application Builder Delete
if (isset($_POST["Delete"]) || isset($_POST["Delete_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "tournament";
  $WA_redirectURL = "tournament_results.php?tournament_id=".((isset($_POST["WADADeleteRecordID"]))?$_POST["WADADeleteRecordID"]:"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "tournament_id";
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
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../webassist/forms/fd_basic_defaultmod.css" rel="stylesheet" type="text/css">
<link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
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
	background-color:#FFFFFF;
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
<div id="Details_Basic_Defaultmod_ProgressWrapper">
<form class="DetailsPage Basic_Defaultmod" id="Details_Basic_Defaultmod" name="Details_Basic_Defaultmod" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Defaultmod" id="Details">
          <legend class="groupHeader">Details</legend>
        
<div>
<a name="top"></a>
	<?php if ($totalRows_WADAtournament > 0) { // Show if recordset not empty ?>
	<div id="WADADetails">
			<table class="WADADataTable" cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td class="DetailsSublabel">Name:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_name']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Start Date:</td>
				<td class="DetailsPage"><?php echo(($row_WADAtournament['tournament_startDate'])?date('n/d/Y',strtotime($row_WADAtournament['tournament_startDate'])):''); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Time:</td>
				<td class="DetailsPage"><?php echo(($row_WADAtournament['tournament_startTime'])?date('g:i A',strtotime($row_WADAtournament['tournament_startTime'])):''); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">End Date:</td>
				<td class="DetailsPage"><?php echo(($row_WADAtournament['Tournament_endDate'])?date('n/d/Y',strtotime($row_WADAtournament['Tournament_endDate'])):''); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">End Time:</td>
				<td class="DetailsPage"><?php echo(($row_WADAtournament['Tournament_endTime'])?date('g:i A',strtotime($row_WADAtournament['Tournament_endTime'])):''); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">tournament_store_location:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_store_location']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">tournament_add_new_location:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_add_new_location']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Location Name: </td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_location _name']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Logo/Icon:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_logo_icon']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Address:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_address']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">City:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_city']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">State:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_state']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Zip:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_zip']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Phone:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_phone']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Email:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_email']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">URL:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_URL']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Admin:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_admin_id']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Tournament Admin Name</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_admin_name']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Tournament Information:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_info']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Notes:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_notes']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Tournament Rounds:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['tournament_rounds']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Factions Cap:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['factions_cap']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Number of Concurrent Games Per Round</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['No_of_Games']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Game:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['game_system_game_system_Title']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Game Title</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['game_title']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Win Point Value:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['WinPointValue']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Draw Point Value:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['DrawPointValue']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Loss Point Value:</td>
				<td class="DetailsPage"><?php echo($row_WADAtournament['LossPointValue']); ?></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</table>
  <hr/>
	</div>
	<?php } // Show if recordset not empty ?>
<?php if ($totalRows_WADAtournament == 0) { // Show if recordset empty ?>
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
				    <?php if ($totalRows_WADAtournament > 0) { // Show if recordset not empty ?>
				  <td><input type="button" value="Top" class="formButton Spacious" id="Top" name="Top" onclick="window.location.hash='top';" /></td>
					<td><input type="button" value="Update" class="formButton Spacious" id="Update" name="Update" onclick="document.location.href = 'tournament_update.php?tournament_id=<?php echo($row_WADAtournament["tournament_id"]); ?>
<?php echo(isset($_GET["pageNum_WADAtournament"])?"&pageNum_WADAtournament=".intval($_GET["pageNum_WADAtournament"]):""); ?>';" /></td>
					<td><input type="button" value="Delete" class="formButton Spacious" id="DeleteConfirm" name="DeleteConfirm" onclick="document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';"  /></td>
					<?php } // Show if recordset not empty ?>
					
				
					
					<td><input type="button" value="Back To Results" class="formButton Spacious" id="BackToResults" name="BackToResults" onclick="document.location.href = 'tournament_results.php<?php echo(isset($_GET["pageNum_WADAtournament"])?"?pageNum_WADAtournament=".intval($_GET["pageNum_WADAtournament"]):""); ?>';" /></td>
				   </tr>
			</table>
		</div></span>
        </fieldset>
</form></div><div id="Details_Basic_Defaultmod_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Details_Basic_Defaultmod', 'Details_Basic_Defaultmod_ProgressMessageWrapper', WADFP_Theme_Options['Bar:Nautica']);
</script>
<div id="Details_Basic_Defaultmod_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/nautica-bar.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<div class="black_overlay" id="deleteBox"></div>
<div class="messageContainer" id="deleteMessage">
	<div class="messageWrapper">
	<form class="Basic_Defaultmod" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>" style="width:auto;">
      <input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAtournament["tournament_id"]); ?>" />
	  <div class="messageContent">
		This will permanently remove the record from your database.<br/>
		This action cannot be undone.<br/><br/>
		<input type="submit" value="Delete" class="formButton Spacious" id="Delete" name="Delete" />
		<input type="button" value="Cancel" class="formButton Spacious" id="Cancel" name="Cancel" onclick="document.getElementById('deleteBox').style.display = 'none';document.getElementById('deleteMessage').style.display = 'none';"  />
	  </div>
	</form>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($WADAtournament);
?>
