<?php require_once('../../../Connections/local.php'); ?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenutourneyAdmin = "SELECT choiceTitle FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenutourneyAdmin = mysql_query($query_WADAMenutourneyAdmin, $local) or die(mysql_error());
$row_WADAMenutourneyAdmin = mysql_fetch_assoc($WADAMenutourneyAdmin);
$totalRows_WADAMenutourneyAdmin = mysql_num_rows($WADAMenutourneyAdmin);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenuEventAdmin = "SELECT choiceValue FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenuEventAdmin = mysql_query($query_WADAMenuEventAdmin, $local) or die(mysql_error());
$row_WADAMenuEventAdmin = mysql_fetch_assoc($WADAMenuEventAdmin);
$totalRows_WADAMenuEventAdmin = mysql_num_rows($WADAMenuEventAdmin);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenuNewsContributor = "SELECT choiceTitle FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenuNewsContributor = mysql_query($query_WADAMenuNewsContributor, $local) or die(mysql_error());
$row_WADAMenuNewsContributor = mysql_fetch_assoc($WADAMenuNewsContributor);
$totalRows_WADAMenuNewsContributor = mysql_num_rows($WADAMenuNewsContributor);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenuvenueAdmin = "SELECT choiceTitle FROM BinaryMenuChoice ORDER BY choiceTitle DESC";
$WADAMenuvenueAdmin = mysql_query($query_WADAMenuvenueAdmin, $local) or die(mysql_error());
$row_WADAMenuvenueAdmin = mysql_fetch_assoc($WADAMenuvenueAdmin);
$totalRows_WADAMenuvenueAdmin = mysql_num_rows($WADAMenuvenueAdmin);
?>
<?php require_once("../../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Battle-Comm: User Search</title>
	<link href="../../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/form_clean.css">
    <script src="../../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../../../Scripts/jquery.magnificant-popup.js"></script>
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
<?php include '../../../Templates/parts/header.php'; ?>
		<?php include '../../../Templates/parts/container-top.php'; ?>
        <div class="full_width">
<div id="Search_Basic_Default_ProgressWrapper">
<form class="clean" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="user_login_results.php">
    <fieldset class="Basic_Default" id="Search">
  <legend class="groupHeader">Search</legend>
  <ol>
    <li> <label for="email" class="sublabel" > Email:</label>
  <input id="email" name="email" type="text" value="<?php echo((isset($_GET["email"])?$_GET["email"]:"")); ?>" class="formTextfield_Medium" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value.">
	   <?php
if (ValidatedField('userloginsearch','userloginsearch'))  {
  if ((strpos((",".ValidatedField("userloginsearch","userloginsearch").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="email_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_search.php userloginsearch(1:)
    }
  }
}?>
    </li> 
    <li> <label for="activation_state" class="sublabel" > activation_state:</label>
      <select class="formMenufield_Large" name="activation_state" id="activation_state" rel="<?php echo((isset($_GET["activation_state"])?$_GET["activation_state"]:"")); ?>" tabindex="2" title="Please enter a value.">
      </select>
    </li> 
    <li> <label for="lastName" class="sublabel" > Last Name:</label>
  <input id="lastName" name="lastName" type="text" value="<?php echo((isset($_GET["lastName"])?$_GET["lastName"]:"")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </li> 
    <li> <label for="tourneyAdmin" class="sublabel" > Tournament Admin:</label>
      <select class="formMenufield_Medium" name="tourneyAdmin" id="tourneyAdmin" rel="<?php echo((isset($_GET["tourneyAdmin"])?$_GET["tourneyAdmin"]:"")); ?>" tabindex="4" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenutourneyAdmin['choiceTitle']?>"<?php if (!(strcmp($row_WADAMenutourneyAdmin['choiceTitle'], (isset($_GET["tourneyAdmin"])?$_GET["tourneyAdmin"]:"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenutourneyAdmin['choiceTitle']?></option>
        <?php
} while ($row_WADAMenutourneyAdmin = mysql_fetch_assoc($WADAMenutourneyAdmin));
  $rows = mysql_num_rows($WADAMenutourneyAdmin);
  if($rows > 0) {
      mysql_data_seek($WADAMenutourneyAdmin, 0);
	  $row_WADAMenutourneyAdmin = mysql_fetch_assoc($WADAMenutourneyAdmin);
  }
?>
</select>
    </li> 
    <li> <label for="EventAdmin" class="sublabel" > Event Admin:</label>
      <select class="formMenufield_Medium" name="EventAdmin" id="EventAdmin" rel="<?php echo((isset($_GET["EventAdmin"])?$_GET["EventAdmin"]:"")); ?>" tabindex="5" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuEventAdmin['choiceValue']?>"<?php if (!(strcmp($row_WADAMenuEventAdmin['choiceValue'], (isset($_GET["EventAdmin"])?$_GET["EventAdmin"]:"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuEventAdmin['choiceValue']?></option>
        <?php
} while ($row_WADAMenuEventAdmin = mysql_fetch_assoc($WADAMenuEventAdmin));
  $rows = mysql_num_rows($WADAMenuEventAdmin);
  if($rows > 0) {
      mysql_data_seek($WADAMenuEventAdmin, 0);
	  $row_WADAMenuEventAdmin = mysql_fetch_assoc($WADAMenuEventAdmin);
  }
?>
</select>
    </li> 
    <li> <label for="NewsContributor" class="sublabel" > News Contributor:</label>
      <select class="formMenufield_Medium" name="NewsContributor" id="NewsContributor" rel="<?php echo((isset($_GET["NewsContributor"])?$_GET["NewsContributor"]:"")); ?>" tabindex="6" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuNewsContributor['choiceTitle']?>"<?php if (!(strcmp($row_WADAMenuNewsContributor['choiceTitle'], (isset($_GET["NewsContributor"])?$_GET["NewsContributor"]:"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuNewsContributor['choiceTitle']?></option>
        <?php
} while ($row_WADAMenuNewsContributor = mysql_fetch_assoc($WADAMenuNewsContributor));
  $rows = mysql_num_rows($WADAMenuNewsContributor);
  if($rows > 0) {
      mysql_data_seek($WADAMenuNewsContributor, 0);
	  $row_WADAMenuNewsContributor = mysql_fetch_assoc($WADAMenuNewsContributor);
  }
?>
</select>
    </li> 
    <li> <label for="venueAdmin" class="sublabel" > Venue/Store Admin:</label>
      <select class="formMenufield_Medium" name="venueAdmin" id="venueAdmin" rel="<?php echo((isset($_GET["venueAdmin"])?$_GET["venueAdmin"]:"")); ?>" tabindex="7" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuvenueAdmin['choiceTitle']?>"<?php if (!(strcmp($row_WADAMenuvenueAdmin['choiceTitle'], (isset($_GET["venueAdmin"])?$_GET["venueAdmin"]:"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuvenueAdmin['choiceTitle']?></option>
        <?php
} while ($row_WADAMenuvenueAdmin = mysql_fetch_assoc($WADAMenuvenueAdmin));
  $rows = mysql_num_rows($WADAMenuvenueAdmin);
  if($rows > 0) {
      mysql_data_seek($WADAMenuvenueAdmin, 0);
	  $row_WADAMenuvenueAdmin = mysql_fetch_assoc($WADAMenuvenueAdmin);
  }
?>
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
    </div> 
  </fieldset>
</form>
</div>
<div id="Search_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Search_Basic_Default', 'Search_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Search_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../../webassist/progress_bar/images/nautica-bar.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>
</div>

  		<?php include '../../../Templates/parts/container-bottom.php'; ?>   
<?php include '../../../Templates/parts/footer.php'; ?>
<script src="../../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<?php
mysql_free_result($WADAMenutourneyAdmin);
?>
<?php
mysql_free_result($WADAMenuEventAdmin);
?>
<?php
mysql_free_result($WADAMenuNewsContributor);
?>
<?php
mysql_free_result($WADAMenuvenueAdmin);
?>
