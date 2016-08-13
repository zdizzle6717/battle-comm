<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxServerAction.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
/* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */

  /* dmxDataSet name "ClubDetails" */
       jQuery.dmxDataSet(
         {"id": "ClubDetails", "url": "../dmxDatabaseSources/ClubDetails.php", "data": {"cl": "{{$URL.cl}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "ClubDetails" */
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function dmxDatabaseActionControl(action, id) { // v1.0
  if (jQuery.dmxDatabaseAction) {
    var da = jQuery.dmxDatabaseAction.get(id),
        args = Array.prototype.slice.call(arguments, 2);
    if (da) {
      da[action].apply(da, args);
    }
  }
}
</script>
</head>
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>Join {{ClubDetails.data[0].club_name}}</h2>
            <p>Join club as: {{LoggedInUser.data[0].firstName}} {{LoggedInUser.data[0].lastName}} </p>
            <p>Handle: {{LoggedInUser.data[0].user_handle}} 
              <input name="clubID" type="hidden" id="clubID" value="{{ClubDetails.data[0].club_key}}">
              <input name="userID" type="hidden" id="userID" value="{{LoggedInUser.data[0].id}}">
              <input name="userType" type="hidden" id="userType" value="unapproved">
            </p>
            <p>
              <input name="button" type="submit" id="button" onClick="dmxDatabaseActionControl('run','JoinClub',{},this)" value="Join">
              <br>
            </p>
		<?php include '../Templates/parts/container-bottom.php'; ?>
<?php include '../Templates/parts/footer.php'; ?>
    <script type="text/javascript">
  /* dmxDatabaseAction name "JoinClub" */
       jQuery.dmxDatabaseAction(
         {"id": "JoinClub", "url": "../dmxDatabaseActions/joinClub.php", "data": {"user_club": "{{$FORM.clubID}}"}, "success": "MM_goToURL('parent','clubSuccess.php?cl={{ClubDetails.data[0].club_key}}');"}
       );
  /* END dmxDatabaseAction name "JoinClub" */
        </script>
