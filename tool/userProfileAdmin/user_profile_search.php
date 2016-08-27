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
<form class="Basic_Default" id="Search_Basic_Default" name="Search_Basic_Default" method="get" action="user_profile_results.php">
        <fieldset class="Basic_Default" id="Search">
          <legend class="groupHeader">Search</legend>
    <div class="lineGroup"> <label for="username" class="sublabel" > Username:</label>
  <input id="username" name="username" type="text" value="<?php echo((isset($_GET["username"])?$_GET["username"]:"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_firstName" class="sublabel" > First Name:</label>
  <input id="user_firstName" name="user_firstName" type="text" value="<?php echo((isset($_GET["user_firstName"])?$_GET["user_firstName"]:"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_lastName" class="sublabel" > Last Name:</label>
  <input id="user_lastName" name="user_lastName" type="text" value="<?php echo((isset($_GET["user_lastName"])?$_GET["user_lastName"]:"")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_email" class="sublabel" > Email:</label>
  <input id="user_email" name="user_email" type="text" value="<?php echo((isset($_GET["user_email"])?$_GET["user_email"]:"")); ?>" class="formTextfield_Large" tabindex="4" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofilesearch','userprofilesearch'))  {
  if ((strpos((",".ValidatedField("userprofilesearch","userprofilesearch").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_email_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_search.php userprofilesearch(1:)
    }
  }
}?>
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
