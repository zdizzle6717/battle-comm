<?php require_once('../Connections/local_local.php'); ?>
<?php
mysql_select_db($database_local_local, $local_local);
$query_WADAMenugames_category = "SELECT game_category FROM game_categories ORDER BY game_category ASC";
$WADAMenugames_category = mysql_query($query_WADAMenugames_category, $local_local) or die(mysql_error());
$row_WADAMenugames_category = mysql_fetch_assoc($WADAMenugames_category);
$totalRows_WADAMenugames_category = mysql_num_rows($WADAMenugames_category);
?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Search_Basic_Default_ProgressWrapper">
<form class="Basic_Default" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="game_system_results.php">
        <fieldset class="Basic_Default" id="Search">
          <legend class="groupHeader">Search</legend>
    <div class="lineGroup"> <label for="game_system_Title" class="sublabel" > Title:</label>
  <input id="game_system_Title" name="game_system_Title" type="text" value="<?php echo((isset($_GET["game_system_Title"])?$_GET["game_system_Title"]:"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system_publisher" class="sublabel" > Publisher:</label>
  <input id="game_system_publisher" name="game_system_publisher" type="text" value="<?php echo((isset($_GET["game_system_publisher"])?$_GET["game_system_publisher"]:"")); ?>" class="formTextfield_Large" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="games_category" class="sublabel" > Category:</label>
      <select class="formMenufield_Medium" name="games_category" id="games_category" rel="<?php echo((isset($_GET["games_category"])?$_GET["games_category"]:"")); ?>" tabindex="3" title="Please enter a value.">
<option value="">Choose Category...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenugames_category['game_category']?>"<?php if (!(strcmp($row_WADAMenugames_category['game_category'], (isset($_GET["games_category"])?$_GET["games_category"]:"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugames_category['game_category']?></option>
        <?php
} while ($row_WADAMenugames_category = mysql_fetch_assoc($WADAMenugames_category));
  $rows = mysql_num_rows($WADAMenugames_category);
  if($rows > 0) {
      mysql_data_seek($WADAMenugames_category, 0);
	  $row_WADAMenugames_category = mysql_fetch_assoc($WADAMenugames_category);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="games_time" class="sublabel" > Time:</label>
  <input id="games_time" name="games_time" type="text" value="<?php echo((isset($_GET["games_time"])?$_GET["games_time"]:"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Search" class="" id="Search" name="Search" />
        </span>
        </fieldset>
</form></div><div id="Search_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Search_Basic_Default', 'Search_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Search_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
</body>
</html>
<?php
mysql_free_result($WADAMenugames_category);
?>
