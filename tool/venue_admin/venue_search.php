<?php require_once('../Connections/local_local.php'); ?>
<?php
mysql_select_db($database_local_local, $local_local);
$query_WADAMenuvenue_state = "SELECT state_abbr FROM tbl_state ORDER BY state_abbr ASC";
$WADAMenuvenue_state = mysql_query($query_WADAMenuvenue_state, $local_local) or die(mysql_error());
$row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state);
$totalRows_WADAMenuvenue_state = mysql_num_rows($WADAMenuvenue_state);
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
<form class="Basic_Default" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="venue_results.php">
        <fieldset class="Basic_Default" id="Search">
          <legend class="groupHeader">Search</legend>
    <div class="lineGroup"> <label for="venue_Name" class="sublabel" > Name:</label>
  <input id="venue_Name" name="venue_Name" type="text" value="<?php echo((isset($_GET["venue_Name"])?$_GET["venue_Name"]:"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_city" class="sublabel" > City:</label>
  <input id="venue_city" name="venue_city" type="text" value="<?php echo((isset($_GET["venue_city"])?$_GET["venue_city"]:"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="venue_state" class="sublabel" > State:</label>
      <select class="formMenufield_Small" name="venue_state" id="venue_state" rel="<?php echo((isset($_GET["venue_state"])?$_GET["venue_state"]:"")); ?>" tabindex="3" title="Please enter a value.">
<option value="">Choose State...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuvenue_state['state_abbr']?>"<?php if (!(strcmp($row_WADAMenuvenue_state['state_abbr'], (isset($_GET["venue_state"])?$_GET["venue_state"]:"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuvenue_state['state_abbr']?></option>
        <?php
} while ($row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state));
  $rows = mysql_num_rows($WADAMenuvenue_state);
  if($rows > 0) {
      mysql_data_seek($WADAMenuvenue_state, 0);
	  $row_WADAMenuvenue_state = mysql_fetch_assoc($WADAMenuvenue_state);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="venue_player_capacity" class="sublabel" > Max Number of Players:</label>
  <input id="venue_player_capacity" name="venue_player_capacity" type="text" value="<?php echo((isset($_GET["venue_player_capacity"])?$_GET["venue_player_capacity"]:"")); ?>" class="formTextfield_Small" tabindex="4" title="Please enter a value.">
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
mysql_free_result($WADAMenuvenue_state);
?>
