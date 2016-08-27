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

$colname_Tournament = "-1";
if (isset($_GET['tourney'])) {
  $colname_Tournament = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Tournament = sprintf("SELECT * FROM tournament WHERE tournament_id = %s", GetSQLValueString($colname_Tournament, "int"));
$Tournament = mysql_query($query_Tournament, $local_local) or die(mysql_error());
$row_Tournament = mysql_fetch_assoc($Tournament);
$totalRows_Tournament = mysql_num_rows($Tournament);

$colname_Rounds = "-1";
if (isset($_GET['tourney'])) {
  $colname_Rounds = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Rounds = sprintf("SELECT * FROM tournament_rounds WHERE tournament_id = %s", GetSQLValueString($colname_Rounds, "int"));
$Rounds = mysql_query($query_Rounds, $local_local) or die(mysql_error());
$row_Rounds = mysql_fetch_assoc($Rounds);
$totalRows_Rounds = mysql_num_rows($Rounds);
?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = false;
	$RepeatSelectionCounter_1_Iterations = "-1";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<p>Assign players for <?php echo $row_Tournament['tournament_id']; ?>
</p>
<p>&nbsp;</p>
<p>Rounds:</p>
<table width="700" border="1">
  <tr>
    <th scope="col">Round Title</th>
    <th scope="col">Start Time</th>
    <th scope="col">EndTime</th>
    <th scope="col">Participants</th>
    <th scope="col">Assign</th>
  </tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_Rounds){
?>
  <tr>
    <td><?php echo $row_Rounds['Round_Title']; ?></td>
    <td><?php echo $row_Rounds['startTime']; ?></td>
    <td><?php echo $row_Rounds['endTime']; ?></td>
    <td><?php echo $row_Rounds['num_participants']; ?></td>
    <td><a href="assignPlayers2.php?tourney=<?php echo $row_Tournament['tournament_id']; ?>&r=<?php echo $row_Rounds['rounds_id']; ?>">[Assign Players]</a></td>
  </tr>
  <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_Rounds && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_Rounds = mysql_fetch_assoc($Rounds);
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
</table>
<p><br>
  <br>
</p>
</body>
</html>
<?php
mysql_free_result($Tournament);

mysql_free_result($Rounds);
?>
