<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php require_once( "../../webassist/security_assist/helper_php.php" ); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Battle-comm: Club Search</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/form_clean.css">
    <link href="../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
    <link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../../js/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
	<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
 <script type="text/javascript">
	/* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
</script>
</head>

<?php include '../../Templates/parts/header.php'; ?>
		<?php include '../../Templates/parts/container-top.php'; ?>
<div id="Search_Basic_Default_ProgressWrapper">
<form class="clean" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="club_results.php">
        <fieldset class="Basic_Default" id="Search">
          <legend class="groupHeader">Search</legend>
  <ol>
  	<li> <label for="club_name" class="sublabel" > Club Name:</label>
  <input id="club_name" name="club_name" type="text" value="<?php echo((isset($_GET["club_name"])?$_GET["club_name"]:"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </li> 
    <li> <label for="club_city" class="sublabel" > club_city:</label>
  <input id="club_city" name="club_city" type="text" value="<?php echo((isset($_GET["club_city"])?$_GET["club_city"]:"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </li> 
    <li> <label for="game_system" class="sublabel" > Game System:</label>
      <select class="formMenufield_Medium" name="game_system" id="game_system" rel="<?php echo((isset($_GET["game_system"])?$_GET["game_system"]:"")); ?>" tabindex="3" title="Please enter a value.">
      </select>
    </li> 
  </ol>
	<div class="full_width" >
		<div class="center">
        <span class="buttonFieldGroup" >
          <input type="submit" value="Search" class="formButton Modular" id="Search" name="Search" />
        </span>
    	</div>
    </div>
        </fieldset>
</form></div><div id="Search_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Search_Basic_Default', 'Search_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Search_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>

  		<?php include '../../Templates/parts/container-bottom.php'; ?>   
<?php include '../../Templates/parts/footer.php'; ?>
<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>

