<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "tournament_tiebreaker";
  $WA_sessionName = "WADA_Insert_tournament_tiebreaker";
  $WA_redirectURL = "tournament_tiebreaker_detail.php?tourney_tiebreaker_id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "tiebreaker_name|tiebreaker_conditions|point_value";
  $WA_fieldValuesStr = "".((isset($_POST["tiebreaker_name"]))?$_POST["tiebreaker_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tiebreaker_conditions"]))?$_POST["tiebreaker_conditions"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["point_value"]))?$_POST["point_value"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local;
  mysql_select_db($WA_connectionDB, $WA_connection);
  @session_start();
  $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj->WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues . ")";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  $_SESSION[$WA_sessionName] = mysql_insert_id($WA_connection);
  if ($WA_redirectURL != "")  {
    $WA_redirectURL = str_replace("[Insert_ID]",$_SESSION[$WA_sessionName],$WA_redirectURL);
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Battle-Comm: Insert Mission Tiebreaker</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/form_clean.css">
    <link href="../../webassist/forms/fd_basic_defaultmod.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../webassist/jq_validation/Inspiration.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../../js/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="../../../ScriptLibrary/dmxDataBindings.js"></script>
	<script type="text/javascript" src="../../../ScriptLibrary/dmxDataSet.js"></script>
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
	  /* dmxDataSet name "PlayerProfile" */
		   jQuery.dmxDataSet(
			 {"id": "PlayerProfile", "url": "../../dmxDatabaseSources/PlayerProfileEdit.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
		   );
	  /* END dmxDataSet name "PlayerProfile" */
	  /* dmxDataSet name "RoundAssignment" */
		   jQuery.dmxDataSet(
			 {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
		   );
	  /* END dmxDataSet name "RoundAssignment" */
	</script>
</head>
<?php include '../../Templates/parts/header.php'; ?>
		<?php include '../../Templates/parts/container-top.php'; ?>
        <div class="full_width">
<div id="Insert_Basic_Defaultmod_ProgressWrapper">
<form class="clean" id="Insert_Basic_Defaultmod" name="Insert_Basic_Defaultmod" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
<fieldset>
	<legend>Insert Tiebreaker</legend>
<ol>       
    <li> <label for="tiebreaker_name" class="sublabel" > Name:</label>
  <input id="tiebreaker_name" name="tiebreaker_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerinsert","tiebreaker_name"):"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value.">
    </li> 
    <li> <label for="tiebreaker_conditions" class="sublabel" > Conditions/Requirements:</label>
  <textarea name="tiebreaker_conditions" id="tiebreaker_conditions" class="formTextarea_Large" rows="1" cols="1" tabindex="2" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerinsert","tiebreaker_conditions"):"")); ?></textarea>
    </li> 
    <li> <label for="point_value" class="sublabel" > Point Value:</label>
  <input id="point_value" name="point_value" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerinsert","point_value"):"")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </li> 
    </ol>
    
    <br/>
	<div class="full_width" >
		<div class="center">
        <span class="buttonFieldGroup" >
          <input type="submit" value="Insert" class="formButton Spacious" id="Insert" name="Insert" />
        </span>
        </div>
    </div>
        </fieldset>
</form>
</div>
<div id="Insert_Basic_Defaultmod_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Defaultmod', 'Insert_Basic_Defaultmod_ProgressMessageWrapper', WADFP_Theme_Options['Bar:Nautica']);
</script>
    <div id="Insert_Basic_Defaultmod_ProgressMessage" >
        <p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/nautica-bar.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
            </div>
        </div>
    </div>


  		<?php include '../../Templates/parts/container-bottom.php'; ?>   
<?php include '../../Templates/parts/footer.php'; ?>

<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Insert_Basic_Defaultmod_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Inspiration",
    pointedAt: "right",
    fieldOffset: -2,
    fieldMargin: 0,
    position: "left",
    direction: "center",
    border: 1,
    offset: 5,
    closeText: "✖",
    percentWidth: 100,
    orientation: "bottom"
  };
function Insert_Basic_Defaultmod_Validate() {
    $("#Insert_Basic_Defaultmod").h5Validate(Insert_Basic_Defaultmod_Opts);
  }
$(document).ready(function () {
  Insert_Basic_Defaultmod_Validate()
  ConvertServerErrors(Insert_Basic_Defaultmod_Opts);
});
</script>

</body>
</html>
