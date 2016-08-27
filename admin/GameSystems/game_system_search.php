<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Battle-Comm: Game System Search</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/form_clean.css">
	<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="../../Scripts/jquery.magnificant-popup.js"></script>
	<script type="text/javascript" src="../../Scripts/mobile-toggle.js"></script>
	<script type="text/javascript" src="../../Scripts/backtotop.js"></script>
    <link href="../../webassist/forms/fd_basic_defaultmod.css" rel="stylesheet" type="text/css">
    <link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<?php include '../../Templates/parts/header.php'; ?>
		<?php include '../../Templates/parts/container-top.php'; ?>
<div id="Search_Basic_Defaultmod_ProgressWrapper">
<form class="clean" id="Search_Basic_Defaultmod" name="Search_Basic_Defaultmod" method="get" action="game_system_results.php">
        <fieldset class="Basic_Defaultmod" id="Search">
          <legend class="groupHeader">Search</legend>
  <ol>
  	<li> <label for="game_system_Title" class="sublabel" > Title:</label>
  <input id="game_system_Title" name="game_system_Title" type="text" value="<?php echo((isset($_GET["game_system_Title"])?$_GET["game_system_Title"]:"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value.">
    </li> 
    <li> <label for="game_system_publisher" class="sublabel" > Publisher:</label>
  <input id="game_system_publisher" name="game_system_publisher" type="text" value="<?php echo((isset($_GET["game_system_publisher"])?$_GET["game_system_publisher"]:"")); ?>" class="formTextfield_Large" tabindex="2" title="Please enter a value.">
    </li> 
    <li> <label for="games_category" class="sublabel" > Category:</label>
      <select class="formMenufield_Medium" name="games_category" id="games_category" rel="<?php echo((isset($_GET["games_category"])?$_GET["games_category"]:"")); ?>" tabindex="3" title="Please enter a value.">
      </select>
    </li> 
 </ol>
	<div class="full_width" >
		<div class="center">
        <span class="buttonFieldGroup" >
          <input type="submit" value="Search" class="formButton Spacious" id="Search" name="Search" />
        </span>
       </div>
    </div>
        </fieldset>
</form></div><div id="Search_Basic_Defaultmod_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Search_Basic_Defaultmod', 'Search_Basic_Defaultmod_ProgressMessageWrapper', WADFP_Theme_Options['Bar:Nautica']);
</script>
<div id="Search_Basic_Defaultmod_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/nautica-bar.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
  		<?php include '../../Templates/parts/container-bottom.php'; ?>   
<?php include '../../Templates/parts/footer.php'; ?>
