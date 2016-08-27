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

mysql_select_db($database_local_local, $local_local);
$query_Players = "SELECT id, username FROM user_login ORDER BY username ASC";
$Players = mysql_query($query_Players, $local_local) or die(mysql_error());
$row_Players = mysql_fetch_assoc($Players);
$totalRows_Players = mysql_num_rows($Players);

$colname_Rounds = "-1";
if (isset($_GET['tourney'])) {
  $colname_Rounds = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Rounds = sprintf("SELECT * FROM tournament_rounds WHERE tournament_id = %s ORDER BY round_sort ASC", GetSQLValueString($colname_Rounds, "int"));
$Rounds = mysql_query($query_Rounds, $local_local) or die(mysql_error());
$row_Rounds = mysql_fetch_assoc($Rounds);
$totalRows_Rounds = mysql_num_rows($Rounds);

$colname_Match = "-1";
if (isset($_GET['tourney'])) {
  $colname_Match = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Match = sprintf("SELECT * FROM tournament_match WHERE tournament_id = %s", GetSQLValueString($colname_Match, "text"));
$Match = mysql_query($query_Match, $local_local) or die(mysql_error());
$row_Match = mysql_fetch_assoc($Match);
$totalRows_Match = mysql_num_rows($Match);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<p>Assign Players <?php echo $row_Tournament['tournament_name']; ?>
</p>
<p>&nbsp;</p>
<table width="600" border="1">
  <tr>
    <th scope="col">Player</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">Round</th>
    <th scope="col">Match</th>
  </tr>
  <tr>
    <td><select>
    	<option>Choose Player...</option>
      <?php
do {  
?>
      <option value="<?php echo $row_Players['username']?>"><?php echo $row_Players['username']?></option>
      <?php
} while ($row_Players = mysql_fetch_assoc($Players));
  $rows = mysql_num_rows($Players);
  if($rows > 0) {
      mysql_data_seek($Players, 0);
	  $row_Players = mysql_fetch_assoc($Players);
  }
?>
    </select></td>
    <td>&nbsp;</td>
    <td><select>&nbsp;
    		<option>Choose Round...</option>
      <?php
do {  
?>
      <option value="<?php echo $row_Rounds['Round_Title']?>"><?php echo $row_Rounds['Round_Title']?></option>
      <?php
} while ($row_Rounds = mysql_fetch_assoc($Rounds));
  $rows = mysql_num_rows($Rounds);
  if($rows > 0) {
      mysql_data_seek($Rounds, 0);
	  $row_Rounds = mysql_fetch_assoc($Rounds);
  }
?>
    </select></td>
    <td><select>&nbsp;
    		<option>Choose Match...</option>
      <?php
do {  
?>
      <option value="<?php echo $row_Match['tournament_match_id']?>"><?php echo $row_Match['tournament_match_id']?></option>
      <?php
} while ($row_Match = mysql_fetch_assoc($Match));
  $rows = mysql_num_rows($Match);
  if($rows > 0) {
      mysql_data_seek($Match, 0);
	  $row_Match = mysql_fetch_assoc($Match);
  }
?>
    </select></td>
  </tr>
  <tr>
    <td><input type="submit"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Tournament);

mysql_free_result($Players);

mysql_free_result($Rounds);

mysql_free_result($Match);
?>
