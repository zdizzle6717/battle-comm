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
<form class="Basic_Default" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="tournament_tiebreaker_results.php">
        <fieldset class="Basic_Default" id="Search">
          <legend class="groupHeader">Search</legend>
    <div class="lineGroup"> <label for="tiebreaker_name" class="sublabel" > Tiebreaker/Mission Name:</label>
  <input id="tiebreaker_name" name="tiebreaker_name" type="text" value="<?php echo((isset($_GET["tiebreaker_name"])?$_GET["tiebreaker_name"]:"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="match_id" class="sublabel" > Round ID:</label>
  <input id="match_id" name="match_id" type="text" value="<?php echo((isset($_GET["match_id"])?$_GET["match_id"]:"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="Game Title" class="sublabel" > Game Title:</label>
      <select class="formMenufield_Medium" name="Game Title" id="Game Title" rel="<?php echo((isset($_GET["Game Title"])?$_GET["Game Title"]:"")); ?>" tabindex="3" title="Please enter a value.">
      </select>
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
