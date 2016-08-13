<?php require_once('../../Connections/local.php'); ?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenugame_system = "SELECT game_system_Title, game_system_id FROM game_system ORDER BY game_system_Title ASC";
$WADAMenugame_system = mysql_query($query_WADAMenugame_system, $local) or die(mysql_error());
$row_WADAMenugame_system = mysql_fetch_assoc($WADAMenugame_system);
$totalRows_WADAMenugame_system = mysql_num_rows($WADAMenugame_system);
?>
<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Search_Basic_Default_ProgressWrapper">
<form class="Basic_Default" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="bc_news_results.php">
        <fieldset class="Basic_Default" id="Search">
          <legend class="groupHeader">Search</legend>
    <div class="lineGroup"> <label for="news_title" class="sublabel" > Title:</label>
  <input id="news_title" name="news_title" type="text" value="<?php echo((isset($_GET["news_title"])?$_GET["news_title"]:"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="news_author" class="sublabel" > Author:</label>
  <input id="news_author" name="news_author" type="text" value="<?php echo((isset($_GET["news_author"])?$_GET["news_author"]:"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="tags" class="sublabel" > Tags:</label>
  <input id="tags" name="tags" type="text" value="<?php echo((isset($_GET["tags"])?$_GET["tags"]:"")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system" class="sublabel" > Game System:</label>
      <select class="formMenufield_Medium" name="game_system" id="game_system" rel="<?php echo((isset($_GET["game_system"])?$_GET["game_system"]:"")); ?>" tabindex="4" title="Please enter a value.">
<option value="">Choose Game System...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenugame_system['game_system_id']?>"<?php if (!(strcmp($row_WADAMenugame_system['game_system_id'], (isset($_GET["game_system"])?$_GET["game_system"]:"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugame_system['game_system_Title']?></option>
        <?php
} while ($row_WADAMenugame_system = mysql_fetch_assoc($WADAMenugame_system));
  $rows = mysql_num_rows($WADAMenugame_system);
  if($rows > 0) {
      mysql_data_seek($WADAMenugame_system, 0);
	  $row_WADAMenugame_system = mysql_fetch_assoc($WADAMenugame_system);
  }
?>
</select>
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Search" class="formButton Modular" id="Search" name="Search" />
        </span>
        </fieldset>
</form></div><div id="Search_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Search_Basic_Default', 'Search_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Search_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
</body>
</html>
<?php
mysql_free_result($WADAMenugame_system);
?>
