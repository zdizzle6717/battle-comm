<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: Home</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
  /* dmxDataSet name "tournamentAdminFilter" */
       jQuery.dmxDataSet(
         {"id": "tournamentAdminFilter", "url": "dmxDatabaseSources/tournamentAdminFilter.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentAdminFilter" */
</script>

</head>
<?php include '../Templates/parts/header.php'; ?>
        <?php include '../Templates/parts/container-top.php'; ?>
        <!-- Begin User Level Navigation -->
        	<div id="PlayerNav">
                <a href="/players/index.php">Player Home</a> | <a href="/players/mydashboard.php">My Dashboard</a> | 
                <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
                <a href="../tool/index.php">Tournament Admin</a> |
                  <?php } // End Show Region ?>
                <a href="../players/user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Edit Account</a> |
                <a href="../players/editProfileA.php">Edit Profile</a> |
                <?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
                  <a href="index.php"> System Administrator</a>
                  <?php } // End Show Region ?>
                 | 
                <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
                <a href="../clubsAdmin/index.php">Club Admin</a>
                <?php } // End Show Region ?>
            </div>
<!-- End User Level Navigation -->
			<h2>Site Administration Tools</h2>
            <p>&nbsp;</p>
            
           <p> <table width="90%" border="1">
        <tbody>
          <tr>
            <td colspan="2"><strong>Player Profiles</strong></td>
            </tr>
          <tr>
            <td><a href="players/playersLogin/user_profile_insert.php"><strong>Insert/Add New Player</strong></a></td>
            <td><a href="players/playersLogin/user_login_results.php"><strong>List All Player Profiles</strong></a></td>
            </tr>
          <tr>
            <td><a href="players/playersLogin/user_login_search.php"><strong>Search Player Profiles</strong></a></td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td colspan="2"><strong>Clubs Admin</strong></td>
            </tr>
          <tr>
            <td><a href="clubs/club_insert.php"><strong>Insert/Add NewClub (Admin)</strong></a></td>
            <td><a href="clubs/club_results.php"><strong>List All Clubs</strong></a></td>
            </tr>
          <tr>
            <td><a href="clubs/club_search.php"><strong>Search Clubs</strong></a></td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td colspan="2"><strong>Tournament Admin</strong></td>
            </tr>
          <tr>
            <td><strong><a href="tournaments/tournament_insert.php">Create New Tournament</a></strong></td>
            <td><strong><a href="tournaments/tournament_results.php">List All Tournaments</a></strong></td>
            </tr>
          <tr>
            <td><strong><a href="tournaments/tournament_search.php">Search Tournaments</a></strong></td>
            <td><a href="tournament/tourneyAdmin.php"><strong>Replica of Tourney Admin Screen <br>
              (without Owner Filter)</strong></a></td>
            </tr>
          <tr>
            <td colspan="2"><strong>Game Stores (Venue)</strong></td>
          </tr>
          <tr>
            <td><a href="venue/venue_insert.php"><strong>Create/Add New Store</strong></a></td>
            <td><a href="venue/venue_results.php"><strong>List All Stores</strong></a></td>
          </tr>
          <tr>
            <td><a href="venue/venue_search.php"><strong>Search Stores</strong></a></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><strong>Achievements</strong></td>
          </tr>
          <tr>
            <td><a href="Achievements/index.php"><strong>Insert/Add Achievement</strong></a></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><strong>Adjust RP Points</strong></td>
          </tr>
          <tr>
            <td><a href="playerRP.php"><strong>Adjust RP by Player</strong></a></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><strong>Game Systems</strong></td>
            </tr>
          <tr>
            <td><strong><a href="GameSystems/game_system_insert.php">Insert/Add Game System (Admin)</a></strong></td>
            <td><strong><a href="GameSystems/game_system_results.php">List All Game Systems</a></strong></td>
            </tr>
          <tr>
            <td><strong><a href="GameSystems/game_system_search.php">Search Game Systems</a></strong></td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td colspan="2"><strong>Missions/Tiebreakers</strong></td>
            </tr>
          <tr>
            <td><strong><a href="missions/tournament_tiebreaker_insert.php">Insert/Add Mission</a></strong></td>
            <td><strong><a href="missions/tournament_tiebreaker_results.php">List All Missions</a></strong></td>
            </tr>
          <tr>
            <td colspan="2"><strong>Game Categories</strong></td>
            </tr>
          <tr>
            <td><strong><a href="gameCategories/game_categories_insert.php">Insert/Add New Game Category</a></strong></td>
            <td><strong><a href="gameCategories/game_categories_results.php">List All Game Categories</a></strong></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td colspan="2"><strong>News</strong></td>
            </tr>
          <tr>
            <td><a href="news/bc_news_insert.php">Insert/Add News Article</a></td>
            <td><a href="news/bc_news_results.php">List All News Articles</a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><strong>RSS Feed</strong></td>
            </tr>
          <tr>
            <td><a href="../feed/insert.php" target="new"><strong>Add Feed Items</strong></a>(open in new window)</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table></p>
            <p>&nbsp;</p>
	<?php include '../Templates/parts/container-bottom.php'; ?>
<?php include '../Templates/parts/footer.php'; ?>