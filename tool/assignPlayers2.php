<?php require_once('Connections/local_local.php'); ?>
<?php require_once('Connections/localhost.php'); ?>
<?php require_once('webassist/mysqli/rsobj.php'); ?>
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

$colname_tournament = "-1";
if (isset($_GET['tourney'])) {
  $colname_tournament = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_tournament = sprintf("SELECT * FROM tournament WHERE tournament_id = %s", GetSQLValueString($colname_tournament, "int"));
$tournament = mysql_query($query_tournament, $local_local) or die(mysql_error());
$row_tournament = mysql_fetch_assoc($tournament);
$totalRows_tournament = mysql_num_rows($tournament);

$colname_rounds = "-1";
if (isset($_GET['r'])) {
  $colname_rounds = $_GET['r'];
}
mysql_select_db($database_local_local, $local_local);
$query_rounds = sprintf("SELECT * FROM tournament_rounds WHERE rounds_id = %s", GetSQLValueString($colname_rounds, "int"));
$rounds = mysql_query($query_rounds, $local_local) or die(mysql_error());
$row_rounds = mysql_fetch_assoc($rounds);
$totalRows_rounds = mysql_num_rows($rounds);

mysql_select_db($database_local_local, $local_local);
$query_Players = "SELECT * FROM tournament_players ORDER BY RAND()";
$Players = mysql_query($query_Players, $local_local) or die(mysql_error());
$row_Players = mysql_fetch_assoc($Players);
$totalRows_Players = mysql_num_rows($Players);?>
<?php
$Recordset1A = new WA_MySQLi_RS("Recordset1A",$localhost,1);
$Recordset1A->setQuery("SELECT * FROM tournament_players ORDER BY RAND()");
$Recordset1A->execute();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
null
null
null
<p>Assign Players to Round &quot;<?php echo $row_rounds['Round_Title']; ?>&quot; for <?php echo $row_tournament['tournament_name']; ?>
</p>
<p>&nbsp;</p>  
<form action="" method="post" name="playerSubmit" id="playerSubmit">
<table width="700" border="1">
  <tr>
    <th width="252" scope="col">&nbsp;</th>
    <th width="390" scope="col">&nbsp;</th>
    <th width="36" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td><input name="player_<?php echo($Recordset1A->getColumnVal("tournament_players_id")); ?>" type="text" id="player" value="<?php echo $row_Players['userHandle']; ?>"></td>
    <td><input name="players_<?php echo $row_rounds['num_participants']; ?>" type="text" id="players_" value="<?php echo $row_Players['userHandle']; ?>"></td>
    <td>&nbsp;</td>
  </tr>
<tr>
  <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
</table>

  <p>&nbsp;</p>
<p>
    <input name="playerSubmit2" type="submit" id="playerSubmit2" formmethod="POST" value="Submit">
  </p>
</form>

</body>
</html>
<?php
mysql_free_result($tournament);


mysql_free_result($rounds);

mysql_free_result($Players);
?>
