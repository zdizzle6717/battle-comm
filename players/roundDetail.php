<?php require_once( "../webassist/security_assist/helper_php.php" ); 
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>BattleComm: Round Details</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../../js/mobile-toggle.js"></script>
<script type="text/javascript" src="../../js/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "roundGameTourneyDetails_Player" */
       jQuery.dmxDataSet(
         {"id": "roundGameTourneyDetails_Player", "url": "../dmxDatabaseSources/round_tourney_details_Player.php", "data": {"td": "{{$URL.td}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "roundGameTourneyDetails_Player" */
  /* dmxDataSet name "tourney_players_detail" */
       jQuery.dmxDataSet(
         {"id": "tourney_players_detail", "url": "../dmxDatabaseSources/players_details.php", "data": {"td": "{{$URL.td}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tourney_players_detail" */
  /* dmxDataSet name "tiebreakers" */
       jQuery.dmxDataSet(
         {"id": "tiebreakers", "url": "../dmxDatabaseSources/matchedTiebreakers.php", "data": {"td": "{{$URL.td}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tiebreakers" */
  /* dmxDataSet name "AssignedFactions" */
       jQuery.dmxDataSet(
         {"id": "AssignedFactions", "url": "../dmxDatabaseSources/AssignedFactions.php", "data": {"td": "{{$URL.td}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "AssignedFactions" */
</script>
<link href="css/customPlayer.css" rel="stylesheet" type="text/css">
</head>
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
<br/>
<div class="full_width">
    <h2>{{roundGameTourneyDetails_Player.data[0].tournament_name}} - {{roundGameTourneyDetails_Player.data[0].Round_Title}}
    </h2>
    <p>{{roundGameTourneyDetails_Player.data[0].startTime}} - {{roundGameTourneyDetails_Player.data[0].endTime}}</p>
    <p><strong>Location</strong></p>
    <p>{{roundGameTourneyDetails_Player.data[0]["tournament_location _name"]}}<br>
    {{roundGameTourneyDetails_Player.data[0].tournament_address}}<br>
    {{roundGameTourneyDetails_Player.data[0].tournament_city}} {{roundGameTourneyDetails_Player.data[0].tournament_state}}, {{roundGameTourneyDetails_Player.data[0].tournament_zip}}</p>
    <p>{{roundGameTourneyDetails_Player.data[0].tournament_phone}} | {{roundGameTourneyDetails_Player.data[0].tournament_email}}</p>
    <p>{{roundGameTourneyDetails_Player.data[0].game_title}}</p>
    <p><strong>Optional Missions</strong>
    <div data-binding-id="repeat1" data-binding-repeat="{{tiebreakers.data}}">{{mission_name}} - {{tiebreaker_points}}points</div></p>
    <p>Factions Cap: {{roundGameTourneyDetails_Player.data[0].factions_cap}}</p>
    <p><strong>Factions</strong></p>
    <ul>
       <div data-binding-id="repeat2" data-binding-repeat="AssignedFactions.data"><li>
       {{factions_Name}}   
      </li> </div>
    </ul>
    <p><strong>Game Point Values</strong></p>
    <p>Win:{{roundGameTourneyDetails_Player.data[0].WinPointValue}} Draw: {{roundGameTourneyDetails_Player.data[0].DrawPointValue}}Loss: {{roundGameTourneyDetails_Player.data[0].LossPointValue}}</p>
    <p><?php include("../includes/lowernav.php"); ?></p>
</div>

 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 