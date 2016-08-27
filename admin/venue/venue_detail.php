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
$Paramvenue_id_WADAvenue = "-1";
if (isset($_GET['venue_id'])) {
  $Paramvenue_id_WADAvenue = $_GET['venue_id'];
}
mysql_select_db($database_local, $local);
$query_WADAvenue = sprintf("SELECT venue_id, venue_Name, venue_logo_icon, venue_Street_Address, venue_city, `tbl_state`.`state_name` AS tbl_state_state_name, venue_zip_cc_code, venue_phone, venue_fax, venue_email, venue_website, venue_contact_name, venue_about, venue_notes, venue_outriders, venue_player_capacity, venue_map_URL FROM venue LEFT JOIN tbl_state ON tbl_state.state_abbr = venue.venue_state WHERE venue_id = %s", GetSQLValueString($Paramvenue_id_WADAvenue, "int"));
$WADAvenue = mysql_query($query_WADAvenue, $local) or die(mysql_error());
$row_WADAvenue = mysql_fetch_assoc($WADAvenue);
$totalRows_WADAvenue = mysql_num_rows($WADAvenue);
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
<?php include '../includes/parts/head-venue-list.php'; ?>
	<?php include '../includes/parts/header.php'; ?>
		<?php include '../includes/parts/container-top-create-venue.php'; ?>
        
        
<div id="Details_Basic_Default_ProgressWrapper">
<form class="DetailsPage Basic_Default" id="Details_Basic_Default" name="Details_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Details">
          <legend class="groupHeader">Details</legend>
        
<div>
<a name="top"></a>
	<?php if ($totalRows_WADAvenue > 0) { // Show if recordset not empty ?>
	<div id="WADADetails">
			<table class="WADADataTable" cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td class="DetailsSublabel">Name:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_Name']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Upload Logo:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_logo_icon']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Street Address:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_Street_Address']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">City:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_city']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">State:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['tbl_state_state_name']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Zip Code:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_zip_cc_code']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Phone:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_phone']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Fax:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_fax']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Email:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_email']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Website:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_website']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Main Contact:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_contact_name']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">About:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_about']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Notes:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_notes']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Outriders:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_outriders']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Player Capacity:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_player_capacity']); ?></td>
			</tr>
			<tr>
				<td class="DetailsSublabel">Google Map URL:</td>
				<td class="DetailsPage"><?php echo($row_WADAvenue['venue_map_URL']); ?></td>
			</tr>
            <tr>
				<td class="DetailsSublabel">View Public Page:</td>
				<td class="DetailsPage"><a href="http://testbattlecomm.com/public-flgs-profile.php?vid=<?php echo $row_WADAvenue['venue_id']; ?>">http://testbattlecomm.com/public-flgs-profile.php?vid=<?php echo $row_WADAvenue['venue_id']; ?></a></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</table>
  <hr/>
	</div>
	<?php } // Show if recordset not empty ?>
<?php if ($totalRows_WADAvenue == 0) { // Show if recordset empty ?>
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
				    <?php if ($totalRows_WADAvenue > 0) { // Show if recordset not empty ?>
				  <td><input type="button" value="Top" class="formButton Modular" id="Top" name="Top" onclick="window.location.hash='top';" /></td>
					<td><input type="button" value="Update" class="formButton Modular" id="Update" name="Update" onclick="document.location.href = 'venue_update.php?venue_id=<?php echo($row_WADAvenue["venue_id"]); ?>
<?php echo(isset($_GET["pageNum_WADAvenue"])?"&pageNum_WADAvenue=".intval($_GET["pageNum_WADAvenue"]):""); ?>';" /></td>
					<td><input type="button" value="Delete" class="formButton Modular" id="DeleteConfirm" name="DeleteConfirm" onclick="document.getElementById('deleteBox').style.display = 'block';document.getElementById('deleteMessage').style.display = 'table';"  /></td>
					<?php } // Show if recordset not empty ?>
					
				
					
					<td><input type="button" value="Back To Results" class="formButton Modular" id="BackToResults" name="BackToResults" onclick="document.location.href = 'venue_results.php<?php echo(isset($_GET["pageNum_WADAvenue"])?"?pageNum_WADAvenue=".intval($_GET["pageNum_WADAvenue"]):""); ?>';" /></td>
				   </tr>
			</table>
		</div></span>
        </fieldset>
</form></div><div id="Details_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Details_Basic_Default', 'Details_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Details_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<div class="black_overlay" id="deleteBox"></div>
<div class="messageContainer" id="deleteMessage">
	<div class="messageWrapper">
	<form class="Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>" style="width:auto;">
      <input type="hidden" name="WADADeleteRecordID" id="WADADeleteRecordID" value="<?php echo($row_WADAvenue["venue_id"]); ?>" />
	  <div class="messageContent">
		This will permanently remove the record from your database.<br/>
		This action cannot be undone.<br/><br/>
		<input type="submit" value="Delete" class="formButton Modular" id="Delete" name="Delete" />
		<input type="button" value="Cancel" class="formButton Modular" id="Cancel" name="Cancel" onclick="document.getElementById('deleteBox').style.display = 'none';document.getElementById('deleteMessage').style.display = 'none';"  />
	  </div>
	</form>
  </div>
</div>

		<?php include '../includes/parts/container-bottom.php'; ?>
	<?php include '../includes/parts/footer.php'; ?>
<?php
mysql_free_result($WADAvenue);
?>
