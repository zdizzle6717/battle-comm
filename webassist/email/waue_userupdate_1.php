<?php
$MailAttachments = "";
$MailBCC         = "";
$MailCC          = "";
$MailTo          = "";
$MailBodyFormat  = "";
$MailBody        = "";
$MailImportance  = "";
$MailFrom        = "do_not_reply@battle-comm.com";
$MailSubject     = "Verify Your Email";
$_SERVER["QUERY_STRING"] = "";

//Global Variables

  $WA_MailObject = WAUE_Definition("","","","","","");

if ($RecipientEmail)     {
  $WA_MailObject = WAUE_AddRecipient($WA_MailObject,$RecipientEmail);
}
else      {
  //To Entries
}

//Additional Headers

//Attachment Entries

//BCC Entries

//CC Entries

//Body Format
  $WA_MailObject = WAUE_BodyFormat($WA_MailObject,0);

//Set Importance
  $WA_MailObject = WAUE_SetImportance($WA_MailObject,"3");

//Start Mail Body
$MailBody = $MailBody . "";
$MailBody = $MailBody . (GetFromPage("templates/Blank_2.php"));
$MailBody = $MailBody . "";
//End Mail Body

$WA_MailObject = WAUE_SendMail($WA_MailObject,$MailAttachments,$MailBCC,$MailCC,$MailTo,$MailImportance,$MailFrom,$MailSubject,$MailBody,"waue_userupdate_1");

if (isset($GLOBALS["waue_userupdate_1_Status"])) {
  $MailLogBindings = new WAUE_Log_Bindings();
  //Start Log Bindings
  //End Log Bindings
  $MailLogBindings->SuccessOrFailure->MailRef = "waue_userupdate_1";
  $MailLogBindings->Success->MailRef = "waue_userupdate_1";
  $MailLogBindings->Failure->MailRef = "waue_userupdate_1";
  $MailLogBindings->processLog(($GLOBALS["waue_userupdate_1_Status"] == "Failure"));
}
$WA_MailObject = null;
?>