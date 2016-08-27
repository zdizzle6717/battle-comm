<?php
global $row_SecurityAssistusers;
$remove = array();
$remove[]  = "";
$remove[]  = "x";
$remove[]  = "y";

$removeBegins = array();
$removeBegins[] = "Security";

$removeEnds = array();
$removeEnds[] = "_x";
$removeEnds[] = "_y";

$removeIncludes = array();
$removeIncludes[] = "Security";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blank Template</title>
</head>
<body style="padding: 20px; text-align: center;">
  <div id="background" style="padding: 20px; text-align: center; font-size: 12px; width:97%">
	<div id="page" style="padding: 5px; margin: 0 auto; width: 660px; text-align: left;">
		<div id="header" style="padding: 10px;">
        	<h1 style="padding: 0px; margin: 0px 0px 2px 0px; font-size: 18px; text-decoration: none; font-weight: bold;">Verify your Email for Battle-Comm.com</h1>
            <p style="padding: 0px; margin: 0px 0px 2px 0px;">You must verify your email address in order to log in to Battle-Comm.</p>
        </div>
        <div id="contentWrapper" style="padding: 0px 0px 40px 0px;">
        	<div id="contentHeader">
            	<table cellpadding="0" cellspacing="0" border="0">
					<tr valign="top">
                    	<th style="font-size: 12px; width: 134px; text-align: right; padding: 3px 10px 3px 3px; font-weight: bold;">Form Submitted:</th>
						<td style="font-size: 12px; padding: 3px;"><?php $now = time(); ?><?php echo date("n-j-Y", $now); ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<?php echo date("g:i A T", $now); ?></td>
					</tr>
				</table>
            </div>
            <div id="content" style="padding: 10px 10px 10px 0px;">
            
            	<table cellpadding="0" cellspacing="0" border="0">
<?php
foreach( $_POST as $pkey => $pval ){
  if (!RemoveValue($pkey,$remove,$removeBegins,$removeEnds,$removeIncludes))  {
	  if (get_magic_quotes_gpc()) $pval = stripslashes((is_array($pval)?implode(", ",$pval):$pval));
?>
					<tr valign="top">
                    	<th style="font-size: 12px; width: 134px; text-align: right; padding: 3px 10px 3px 3px; font-weight: bold;"><?php echo(str_replace("_"," ",$pkey)); ?>:</th>
						<td style="font-size: 12px; padding: 3px;"><?php echo(str_replace("\n","<BR />",(is_array($pval)?implode(", ",$pval):$pval))); ?></td>
					</tr>
<?php
  }
}
?>
					<tr valign="top">
                    	<th style="font-size: 12px; width: 134px; text-align: right; padding: 3px 10px 3px 3px; font-weight: bold;">Verify Email</th>
						<td style="font-size: 12px; padding: 3px;"><p style="margin: 0px; padding: 0px 0px 3px 0px;">Click on the URL to verify your email address:<br/><a href="http://www.testbattlecomm.com/userConfirm.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>&regkey=<?php echo $_SESSION['rpw']; ?>&email=<?php echo((isset($_POST["Registration_group_Email_Address"]))?$_POST["Registration_group_Email_Address"]:"") ?>" title="Verify Your Email Address">http://www.testbattlecomm.com/userConfirm.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>&regkey=<?php echo $_SESSION['rpw']; ?>&email=<?php echo $row_SecurityAssistusers['email']; ?></a></p>
					    <p style="margin: 0px; padding: 0px 0px 3px 0px;">&nbsp;</p>
					    <p style="margin: 0px; padding: 0px 0px 3px 0px;">If you can't click on the above link just copy the URL below and paste it into the browser address bar.<br />
					     http://www.testbattlecomm.com/userConfirm.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>&regkey=<?php echo $_SESSION['rpw']; ?>&email=<?php echo((isset($_POST["Registration_group_Email_Address"]))?$_POST["Registration_group_Email_Address"]:"") ?> </p>
					    <p style="margin: 0px; padding: 0px 0px 3px 0px;">&nbsp;</p>
					    <p style="margin: 0px; padding: 0px 0px 3px 0px;">If you have any problems verifying your email address, please send an email to support@battle-comm.com or go to help.battle-comm.com<br />
					      <br />
					      Thank you</p>
					    <p style="margin: 0px; padding: 0px 0px 3px 0px;">&nbsp;</p>
					    <p style="margin: 0px; padding: 0px 0px 3px 0px;">Battle-Comm.com <br />
				        </p></td>
					</tr>
				</table>
            </div>
        </div>
    </div>
  </div>
</body>
</html>