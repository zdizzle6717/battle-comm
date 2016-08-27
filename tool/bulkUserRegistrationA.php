<?php require_once('Connections/local_local.php'); ?>
<?php require_once("webassist/database_management/wa_appbuilder_php.php"); ?>
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

mysql_select_db($database_local_local, $local_local);
$query_RandomPlayerData = "SELECT * FROM randomPlayerInfo ORDER BY RAND() LIMIT 10";
$RandomPlayerData = mysql_query($query_RandomPlayerData, $local_local) or die(mysql_error());
$row_RandomPlayerData = mysql_fetch_assoc($RandomPlayerData);
$totalRows_RandomPlayerData = mysql_num_rows($RandomPlayerData);

$colname_AdminAssignedPlayers = "-1";
if (isset($_SESSION['svAdminName'])) {
  $colname_AdminAssignedPlayers = $_SESSION['svAdminName'];
}
mysql_select_db($database_local_local, $local_local);
$query_AdminAssignedPlayers = sprintf("SELECT * FROM players WHERE testingAdmin = %s", GetSQLValueString($colname_AdminAssignedPlayers, "text"));
$AdminAssignedPlayers = mysql_query($query_AdminAssignedPlayers, $local_local) or die(mysql_error());
$row_AdminAssignedPlayers = mysql_fetch_assoc($AdminAssignedPlayers);
$totalRows_AdminAssignedPlayers = mysql_num_rows($AdminAssignedPlayers);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["AddPlayers_<?php echo $RepeatSelectionCounter_1; ?>"]) || isset($_POST["AddPlayers_<?php echo $RepeatSelectionCounter_1; ?>_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("player_handle", "player_FirstName", "player_LastName", "playerEmail", "setActive");
  $WA_connection = $local_local;
  $WA_table = "players";
  $WA_redirectURL = "bulkUserRegistrationA.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "playerHandle|playerFirstName|playerLastName|playerEmail|active|testingAdmin";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("player_handle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("player_FirstName", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("player_LastName", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("playerEmail", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("setActive", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".$_SESSION['svAdminName']  ."";
      $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
      $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
      $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj->WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues . ")";
      $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
    }
    $WA_multipleInsertCounter++;
  }
  if ($WA_redirectURL != "")  {
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
}
?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = false;
	$RepeatSelectionCounter_1_Iterations = "-1";
?>
<?php
	// RepeatSelectionCounter_2 Initialization
	$RepeatSelectionCounter_2 = 0;
	$RepeatSelectionCounterBasedLooping_2 = false;
	$RepeatSelectionCounter_2_Iterations = "-1";
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Add Admin Assigned Players to System</title>
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap-theme.css" />
<link href="admin_temp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/3/js/bootstrap.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
function dmxDataBindingsAction(action, target) { // v1.72
 var inst, evt = jQuery.event.fix(window.event || arguments.callee.caller.arguments[0]),
  args = Array.prototype.slice.call(arguments, 2);

 switch (action) {
  case 'refresh': inst = 'ds'; action = 'load'; break;
  case 'setPage': inst = 'ds'; break;
  case 'selectCurrent': inst = 'rp'; action = 'select'; break;
 }

 inst = (inst == 'ds')
  ? jQuery.dmxDataSet.dataSets[target]
  : jQuery(evt.target).closest('[data-binding-id="' + target + '"]').data('repeater')
  || jQuery.dmxDataBindings.regions[target];

 if (inst) inst[action].apply(inst, args);

 evt.preventDefault();
}
</script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"> 
  	  <?php include("nav.php"); ?>
  	</div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Heading</h2>
      <p>&nbsp;</p>
      <p>Currently showing as: <?php echo $_SESSION['svAdminName'];?></p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Heading</h2>
     <form action="bulkUserRegistrationA.php" method="post" name="adminPlayersRandom" id="adminPlayersRandom">
<table width="95%" border="1">
  <tbody>
    <tr>
      <th scope="col">UserName/Handle</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Set Active</th>
      <th scope="col">Admin</th>
    </tr>
     <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_RandomPlayerData){
?>
     <tr>
       <td><input type="hidden" name="player_handle_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="player_handle_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
         <input name="player_handle_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="player_handle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_RandomPlayerData['player_handle']; ?>"></td>
       <td><input name="player_FirstName_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="player_FirstName_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_RandomPlayerData['playerFirstName']; ?>"></td>
       <td><input name="player_LastName_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="player_LastName_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_RandomPlayerData['playerLastName']; ?>"></td>
       <td><input name="playerEmail_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="playerEmail_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_RandomPlayerData['playerEmail']; ?>"></td>
       <td>&nbsp;</td>
       <td><?php echo $_SESSION['svAdminName'];?></td>
     </tr>
     <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
    <tr>
      <td colspan="2"><input name="AddPlayers_<?php echo $RepeatSelectionCounter_1; ?>" type="submit" id="AddPlayers_<?php echo $RepeatSelectionCounter_1; ?>" formaction="bulkUserRegistrationA.php" formmethod="POST" value="Add Players"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

</form>

<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_RandomPlayerData && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_RandomPlayerData = mysql_fetch_assoc($RandomPlayerData);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
      <p><h2>Currently Registered Players for <?php echo $_SESSION['svAdminName'];?></h2>
      </p>
      <p>
       
<table width="95%" border="1">
  <tbody>
    <tr>
      <th scope="col">(ID)- Username/Handle</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Active</th>
      <th scope="col">Admin</th>
    </tr>
    <?php
	// RepeatSelectionCounter_2 Begin Loop
	$RepeatSelectionCounter_2_IterationsRemaining = $RepeatSelectionCounter_2_Iterations;
	while($RepeatSelectionCounter_2_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_2 || $row_AdminAssignedPlayers){
?> <tr>
      <td>(<?php echo $row_AdminAssignedPlayers['playerId']; ?>) <?php echo $row_AdminAssignedPlayers['playerHandle']; ?></td>
      <td><?php echo $row_AdminAssignedPlayers['playerFirstName']; ?></td>
      <td><?php echo $row_AdminAssignedPlayers['playerLastName']; ?></td>
      <td><?php echo $row_AdminAssignedPlayers['playerEmail']; ?></td>
      <td><?php echo $row_AdminAssignedPlayers['active']; ?></td>
      <td><?php echo $row_AdminAssignedPlayers['testingAdmin']; ?></td>
    </tr>
    <tr><?php
	} // RepeatSelectionCounter_2 Begin Alternate Content
	else{
?>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<?php } // RepeatSelectionCounter_2 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_2 && $RepeatSelectionCounter_2_IterationsRemaining != 0){
			if(!$row_AdminAssignedPlayers && $RepeatSelectionCounter_2_Iterations == -1){$RepeatSelectionCounter_2_IterationsRemaining = 0;}
			$row_AdminAssignedPlayers = mysql_fetch_assoc($AdminAssignedPlayers);
		}
		$RepeatSelectionCounter_2++;
	} // RepeatSelectionCounter_2 End Loop
?>
</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>Footer Left</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
    <div class="col-lg-6">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($RandomPlayerData);

mysql_free_result($AdminAssignedPlayers);
?>
