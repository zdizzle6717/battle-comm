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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<p>Game Results for <?php echo $row_Tournament['tournament_name']; ?>
</p>
<p>&nbsp;</p>
<p>[Player] played against [OpponentPlayer] in a game of [GameSystem] at [Match] during [Round]</p>
<p>&nbsp;</p>
<p>[Player] was victorious. And will be awarded [Win Points]</p>
<p>[Player] also took part in the following missions:</p>
<p>[Player] did complete [tiebreaker] and got [points]<br>
[Player] did not complete [tiebreaker]<br>
[Player] did complete [tiebreaker] and got [points]<br>
<br>
<br>
[Opponent] was defeated and will be awarded [LossPoints].</p>
<p>[Opponent] did complete [tiebreaker] and got [points]<br>
[Opponent] did not complete [tiebreaker]<br>
[Opponent] did complete [tiebreaker] and got [points]<br>
<br>
Final Total for [Match] during [Round]<br>
<br>
[Player] got [Total Points]<br>
Opponent got [OTotalPoints]<br>
<br>
<br><input name="Agree" type="button" id="Agree" value="Agree">   <input name="Reject" type="button" id="Reject" value="Reject">
<br>
</p>
</body>
</html>
<?php
mysql_free_result($Tournament);
?>
