<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../webassist/forms/fd_basic_defaultmod.css" rel="stylesheet" type="text/css">
<link type="text/css" href="../../webassist/forms/fd_basic_defaultmod/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
$(function(){
	$('#tournament_startDate').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_tournament_startDate
	});
});
function closeDatePicker_tournament_startDate() {
	var tElm = $('#tournament_startDate');
	if (typeof tournament_startDate_Spry != null && typeof tournament_startDate_Spry != "undefined" && tournament_startDate_Spry.validate) {
		tournament_startDate_Spry.validate();
	}
	tElm.blur();
}
</script><link type="text/css" href="../../webassist/forms/fd_basic_defaultmod/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
$(function(){
	$('#Tournament_endDate').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_Tournament_endDate
	});
});
function closeDatePicker_Tournament_endDate() {
	var tElm = $('#Tournament_endDate');
	if (typeof Tournament_endDate_Spry != null && typeof Tournament_endDate_Spry != "undefined" && Tournament_endDate_Spry.validate) {
		Tournament_endDate_Spry.validate();
	}
	tElm.blur();
}
</script>
<link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Search_Basic_Defaultmod_ProgressWrapper">
<form class="Basic_Defaultmod" id="Search_Basic_Defaultmod" name="Search_Basic_Defaultmod" method="get" action="tournament_results.php">
        <fieldset class="Basic_Defaultmod" id="Search">
          <legend class="groupHeader">Search</legend>
    <div class="lineGroup"> <label for="tournament_name" class="sublabel" > Name:</label>
  <input id="tournament_name" name="tournament_name" type="text" value="<?php echo((isset($_GET["tournament_name"])?$_GET["tournament_name"]:"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="tournament_city" class="sublabel" > City:</label>
  <input id="tournament_city" name="tournament_city" type="text" value="<?php echo((isset($_GET["tournament_city"])?$_GET["tournament_city"]:"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="tournament_startDate" class="sublabel" > Start Date:</label>
  <input id="tournament_startDate" name="tournament_startDate" type="text" value="<?php echo((isset($_GET["tournament_startDate"])?$_GET["tournament_startDate"]:"")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
	   <?php
if (ValidatedField('tournamentsearch','tournamentsearch'))  {
  if ((strpos((",".ValidatedField("tournamentsearch","tournamentsearch").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="tournament_startDate_ServerError">Please enter a value.</span><?php //WAFV_Conditional tournament_search.php tournamentsearch(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="Tournament_endDate" class="sublabel" > End Date:</label>
  <input id="Tournament_endDate" name="Tournament_endDate" type="text" value="<?php echo((isset($_GET["Tournament_endDate"])?$_GET["Tournament_endDate"]:"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
	   <?php
if (ValidatedField('tournamentsearch','tournamentsearch'))  {
  if ((strpos((",".ValidatedField("tournamentsearch","tournamentsearch").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="Tournament_endDate_ServerError">Please enter a value.</span><?php //WAFV_Conditional tournament_search.php tournamentsearch(2:)
    }
  }
}?>
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Search" class="formButton Spacious" id="Search" name="Search" />
        </span>
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
</body>
</html>
