<?php require_once('Connections/local_local.php'); ?>
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

$colname_Recordset1 = "2";
if (isset($_GET['tourney'])) {
  $colname_Recordset1 = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Recordset1 = sprintf("SELECT * FROM tournament_players WHERE tournament_id = %s ORDER BY RAND()", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $local_local) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$colname_Recordset2 = "-1";
if (isset($_GET['r'])) {
  $colname_Recordset2 = $_GET['r'];
}
mysql_select_db($database_local_local, $local_local);
$query_Recordset2 = sprintf("SELECT * FROM tournament_rounds WHERE rounds_id = %s", GetSQLValueString($colname_Recordset2, "int"));
$Recordset2 = mysql_query($query_Recordset2, $local_local) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$colname_Recordset3 = "2";
if (isset($_GET['tourney'])) {
  $colname_Recordset3 = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Recordset3 = sprintf("SELECT * FROM tournament_players WHERE tournament_id = %s ORDER BY RAND()", GetSQLValueString($colname_Recordset3, "int"));
$Recordset3 = mysql_query($query_Recordset3, $local_local) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<?php
	// RepeatSelectionCounter_2 Initialization
	$RepeatSelectionCounter_2 = 0;
	$RepeatSelectionCounterBasedLooping_2 = true;
	$RepeatSelectionCounter_2_Iterations = "4";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p><form name="playerSubmit" method="post" action="">
<table width="700" border="1">
  <tr>
    <th scope="col">recordCount</th>
    <th scope="col">tourneyID</th>
    <th scope="col">userID</th>
    <th scope="col">Registered</th>
    <th scope="col">Date</th>
  </tr>
  <?php
	// RepeatSelectionCounter_2 Begin Loop
	$RepeatSelectionCounter_2_IterationsRemaining = $RepeatSelectionCounter_2_Iterations;
	while($RepeatSelectionCounter_2_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_2 || $row_None){
?>
  <tr>
    <td><input name="round" type="hidden" id="round" value="<?php echo $row_Recordset2['rounds_id']; ?>"></td>
    <td><input name="Player<?php echo $row_Recordset1['tournament_players_id']; ?>" type="text" id="Player" value="<?php echo $row_Recordset1['user_login_id']; ?>">
  &nbsp;
  <input name="Player<?php echo $row_Recordset1['tournament_players_id']++; ?>" type="text" id="Player" value="<?php echo $row_Recordset3['user_login_id']; ?>"></td>
    <td>&nbsp;</td>
<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
	} // RepeatSelectionCounter_2 Begin Alternate Content
	else{
?>
  <?php } // RepeatSelectionCounter_2 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_2 && $RepeatSelectionCounter_2_IterationsRemaining != 0){
			if(!$row_None && $RepeatSelectionCounter_2_Iterations == -1){$RepeatSelectionCounter_2_IterationsRemaining = 0;}
			$row_None = mysql_fetch_assoc($None);
		}
		$RepeatSelectionCounter_2++;
	} // RepeatSelectionCounter_2 End Loop
?>
  <tr>
    <td><?php $row_Recordset1++; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
?>
