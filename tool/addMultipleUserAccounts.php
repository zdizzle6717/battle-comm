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
$query_Players = "SELECT * FROM players";
$Players = mysql_query($query_Players, $local_local) or die(mysql_error());
$row_Players = mysql_fetch_assoc($Players);
$totalRows_Players = mysql_num_rows($Players);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["AddPlayers"]) || isset($_POST["AddPlayers_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("handle", "firstName", "lastName", "emailAddress");
  $WA_connection = $local_local;
  $WA_table = "players";
  $WA_redirectURL = "addMultipleUserAccounts.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "playerHandle|playerFirstName|playerLastName|playerEmail";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''";
  $WA_insertIfNotBlank = "handle";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("handle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("firstName", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("lastName", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("emailAddress", $WA_multipleInsertCounter)  ."";
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
	$RepeatSelectionCounterBasedLooping_1 = true;
	$RepeatSelectionCounter_1_Iterations = "10";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Multiple Players</title>
</head>

<body>
<p>Add Multiple user Player Accounts</p>
<p>&nbsp;</p>
<form method="post" id="addPlayers"><table width="800" border="1">
  <tr>
    <th scope="col">Handle/Username</th>
    <th scope="col">First Name</th>
    <th scope="col">Last Name</th>
    <th scope="col">Email Address</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_None){
?>
  <tr align="center">
    <td><input type="hidden" name="handle_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="handle_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
      <input name="handle_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="handle_<?php echo $RepeatSelectionCounter_1; ?>">
      &nbsp;</td>
    <td><input name="firstName_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="firstName_<?php echo $RepeatSelectionCounter_1; ?>"></td>
    <td><input name="lastName_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="lastName_<?php echo $RepeatSelectionCounter_1; ?>"></td>
    <td><input name="emailAddress_<?php echo $RepeatSelectionCounter_1; ?>" type="email" id="emailAddress_<?php echo $RepeatSelectionCounter_1; ?>"></td>
    <td>&nbsp;</td>
  </tr>
  <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
  <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_None && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_None = mysql_fetch_assoc($None);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
  <tr>
    <td><input name="AddPlayers" type="submit" id="AddPlayers" value="Add Players">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table></form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Players);
?>
