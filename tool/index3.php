<?php require_once('../Connections/local.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
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

mysql_select_db($database_local, $local);
$query_Tournaments = "SELECT * FROM tournament";
$Tournaments = mysql_query($query_Tournaments, $local) or die(mysql_error());
$row_Tournaments = mysql_fetch_assoc($Tournaments);
$totalRows_Tournaments = mysql_num_rows($Tournaments);
$query_Tournaments = "SELECT * FROM tournament";
$Tournaments = mysql_query($query_Tournaments, $local) or die(mysql_error());
$row_Tournaments = mysql_fetch_assoc($Tournaments);
$totalRows_Tournaments = mysql_num_rows($Tournaments);
$query_Tournaments = "SELECT * FROM tournament";
$Tournaments = mysql_query($query_Tournaments, $local_local) or die(mysql_error());
$row_Tournaments = mysql_fetch_assoc($Tournaments);
$totalRows_Tournaments = mysql_num_rows($Tournaments);
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Battle-Comm.com Tournaments</title>
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="../players/css/customPlayer.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxBootstrap3Navigation.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxSecurityProvider.js"></script>
<script type="text/javascript">
function dmxSecurityProviderControl(action) { // v1.0
  if (jQuery.dmxSecurityProvider) {
    var args = Array.prototype.slice.call(arguments, 2);
    jQuery.dmxSecurityProvider[action].apply(args);
  }
}
  /* dmxDataSet name "tournamentAdminFilter" */
       jQuery.dmxDataSet(
         {"id": "tournamentAdminFilter", "url": "dmxDatabaseSources/tournamentAdminFilter.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentAdminFilter" */
</script>
</head>

<body data-spy="scroll" data-target=".nav-container">
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="nav-container container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs3-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
      <a class="navbar-brand" href="/">Battle-Comm</a></div>
    <div class="collapse navbar-collapse" id="bs3-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="../players/index.php">Home</a></li>
        <li><a href="../players/index.php">Profile</a></li>
        <li><a href="#">Messages</a></li>
        <li><a href="#" onClick="dmxSecurityProviderControl('modal')">Login</a></li>
        <li><a href="#" onClick="dmxSecurityProviderControl('logout')">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--/Static navbar --> 

<!-- Container -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center" onfocus="dmxSecurityProviderControl('modal')">Administration</h2>
      <p class="text-center text-muted"><strong>Other Admin Tools</strong></p>
      <ul>
        <li><a href="gameSystem/game_system_results.php"><strong>Game Systems Admin<br>
        </strong></a></li>
        <li><strong><a href="GameCategories/game_categories_results.php">Game Categories Admin</a></strong></li>
        <li><strong><a href="tournamentAdmin/index.php">Tournament Admin</a></strong>
          <ul>
            <li><a href="tournamentAdmin/tournament_insert.php">Create New Tournament</a></li>
          </ul>
        </li>
        <li><strong><a href="venue_admin/venue_results.php">Venue Admin</a></strong></li>
        <li>Clubs Admin
          <ul>
            <li><a href="../clubsAdmin/clubinsert_ajax.php">Create New Club</a></li>
            <li><a href="http://www.testbattlecomm.com/ClubsList.php">List of Clubs (public)</a></li>
            <li><a href="../admin/clubs/club_results.php">Club Admin (Site Administrators View)</a></li>
          </ul>
        </li>
        <li><a href="factions/factions_results.php"><strong>Factions</strong></a>
  <ul>
    <li><a href="factions/factions_insert.php">Create New/Add Faction</a></li>
    </ul>
        </li>
        <li><strong><a href="tiebreakersAdmin/tournament_tiebreaker_results.php">Add/Edit Tiebreakers/Missions</a></strong></li>
        <li>Users Admin (pending)</li>
        <li><a href="tourneyRegistration/index.php"><strong>Player Tournament Registration</strong></a></li>
      </ul>
      <p class="text-center text-muted"><strong>Current Tournaments</strong></p>
      <table width="95%" border="0" align="center">
        <tbody>
          <tr data-binding-repeat="{{tournamentAdminFilter.data}}" data-binding-id="repeat1">
            <td>{{tournament_name}}</td>
            <td>{{tournament_startDate}}- {{Tournament_endDate}}</td>
            <td><a href="tourney_SetupRevA.php?tourney={{tournament_id}}&gs={{game_id}}">Configure Tournament</a></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
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
          </tr>
        </tbody>
      </table>
      <?php include("../includes/lowernav.php"); ?>
      <p class="text-center text-muted">&nbsp;</p>
    </div>
  </div>
</div>
<!-- /.container -->
<div><?php 
// No argument required for current year.
// Otherwise, pass start year as a 4-digit value.
function auto_copyright($startYear = null) {
	$thisYear = date('Y');  // get this year as 4-digit value
    if (!is_numeric($startYear)) {
		$year = $thisYear; // use this year as default
	} else {
		$year = intval($startYear);
	}
	if ($year == $thisYear || $year > $thisYear) { // $year cannot be greater than this year - if it is then echo only current year
		echo "&copy; $thisYear"; // display single year
	} else {
		echo "&copy; $year&ndash;$thisYear"; // display range of years
	}   
 } 
 ?>
<?php auto_copyright(); // Current year?> Battle-Comm.  All Rights Reserved unless otherwise noted.

</div>
</body>
</html>
<?php
mysql_free_result($Tournaments);
?>
