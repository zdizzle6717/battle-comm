<?php
$MailAttachments = "";
$MailBCC         = "";
$MailCC          = "";
$MailTo          = "";
$MailBodyFormat  = "";
$MailBody        = "";
$MailImportance  = "";
$MailFrom        = "do_not_reply@battlecomm.com";
$MailSubject     = "".$row_PendingPlayerRegistrations['userHandle']  ."'s Registration is Approved";
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
  $WA_MailObject = WAUE_AddBCC($WA_MailObject,"bhaarer@battle-comm.com");

//CC Entries

//Body Format
  $WA_MailObject = WAUE_BodyFormat($WA_MailObject,0);

//Set Importance
  $WA_MailObject = WAUE_SetImportance($WA_MailObject,"3");

//Start Mail Body
$MailBody = $MailBody . "";
$MailBody = $MailBody .  $row_PendingPlayerRegistrations['firstName'];
$MailBody = $MailBody . " ";
$MailBody = $MailBody .  $row_PendingPlayerRegistrations['lastName'];
$MailBody = $MailBody . " <br/>\r\n";
$MailBody = $MailBody . "\r\n";
$MailBody = $MailBody . "\r\n";
$MailBody = $MailBody . "Your tournament registration has been approved.\r\n";
$MailBody = $MailBody . "\r\n";
$MailBody = $MailBody . "Thank You.";
//End Mail Body

$WA_MailObject = WAUE_SendMail($WA_MailObject,$MailAttachments,$MailBCC,$MailCC,$MailTo,$MailImportance,$MailFrom,$MailSubject,$MailBody,"waue_updateRegistrations_1");

if (isset($GLOBALS["waue_updateRegistrations_1_Status"])) {
  $MailLogBindings = new WAUE_Log_Bindings();
  //Start Log Bindings
  //End Log Bindings
  $MailLogBindings->SuccessOrFailure->MailRef = "waue_updateRegistrations_1";
  $MailLogBindings->Success->MailRef = "waue_updateRegistrations_1";
  $MailLogBindings->Failure->MailRef = "waue_updateRegistrations_1";
  $MailLogBindings->processLog(($GLOBALS["waue_updateRegistrations_1_Status"] == "Failure"));
}
$WA_MailObject = null;
?>