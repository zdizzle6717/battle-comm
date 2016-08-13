<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("ClubAdmin")){
	WA_Auth_RestrictAccess("../accessdenied.php");
}
?>
<?php 
//*** Pure PHP File Upload 3.1.0
// Process form newClub
$ppu = new pureFileUpload();
$ppu->nameConflict = "over";
$ppu->storeType = "path";
$ppu->progressBar = "html5.htm";
$ppu->progressWidth = 350;
$ppu->progressHeight = 150;
$ppu->path = "../uploads/club";
$ppu->allowedExtensions = "GIF,JPG,JPEG,BMP,PNG"; // ""
$uploadlogo = $ppu->files("logo");
$uploadlogo->path = "../uploads/club";
$uploadlogo->allowedExtensions = "GIF,JPG,JPEG,BMP,PNG"; // ""
$ppu->redirectUrl = "index.php";
$ppu->checkVersion("3.1.0");
$ppu->doUpload();
if ($ppu->done) {
  $_POST["logoWidth"] = $ppu->files("logoWidth")->Value;
  $_POST["logoHeight"] = $ppu->files("logoHeight")->Value;
}
?>
<?php
if (isset($_POST["InsertClub"]) || isset($_POST["InsertClub_x"])) {
  $InsertQuery = new WA_MySQLi_Query($battlecomm_sqli);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "club";
  $InsertQuery->bindColumn("club_name", "s", "".((isset($_POST["ClubName"]))?$_POST["ClubName"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("FLGS_affiliation", "s", "".((isset($_POST["FLGS"]))?$_POST["FLGS"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_email", "s", "".((isset($_POST["primaryContactEmail"]))?$_POST["primaryContactEmail"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_contact_name", "s", "".((isset($_POST["primaryContactName"]))?$_POST["primaryContactName"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_admin_name", "s", "".((isset($_POST["adminTitle"]))?$_POST["adminTitle"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_editor_name", "s", "".((isset($_POST["editorTitle"]))?$_POST["editorTitle"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_moderator_name", "s", "".((isset($_POST["modTitle"]))?$_POST["modTitle"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_Member_name", "s", "".((isset($_POST["pledgeTitle"]))?$_POST["pledgeTitle"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_facebook", "s", "".((isset($_POST["facebook"]))?$_POST["facebook"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_twitter", "s", "".((isset($_POST["twitter"]))?$_POST["twitter"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_website", "s", "".((isset($_POST["website"]))?$_POST["website"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("game_system", "i", "".((isset($_POST["GameChoice"]))?$_POST["GameChoice"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_display_Members", "s", "".((isset($_POST["showMembersonPages"]))?$_POST["showMembersonPages"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_logo", "s", "".((isset($_FILES["logo"]))?$_FILES["logo"]["name"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("logo_w", "s", "".((isset($_POST["logoWidth"]))?$_POST["logoWidth"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("logo_h", "s", "".((isset($_POST["logoHeight"]))?$_POST["logoHeight"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("clubOwner", "i", "".((isset($_POST["clubOwner"]))?$_POST["clubOwner"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->saveInSession("club_id");
  $InsertQuery->execute();
  $InsertGoTo = "";
  if (function_exists("rel2abs")) $InsertGoTo = $InsertGoTo?rel2abs($InsertGoTo,dirname(__FILE__)):"";
  $InsertQuery->redirect($InsertGoTo);
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Create Club</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<link href="../Styles/form_clean.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxNotify.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script src="../ScriptLibrary/incPU3.js" type="text/javascript"></script>
<script type="text/javascript"><?php echo $ppu->generateScriptCode() ?>
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "GameStore" */
       jQuery.dmxDataSet(
         {"id": "GameStore", "url": "../dmxDatabaseSources/GameStoreList.php", "data": {"limit": "1000"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "GameStore" */
  /* dmxDataSet name "FLGS" */
       jQuery.dmxDataSet(
         {"id": "FLGS", "url": "../dmxDatabaseSources/FLGSList.php", "data": {"limit": "1000"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "FLGS" */
</script>
<script type="text/javascript">
function dmxDataBindingsAction(action, target) { // v1.72
 var inst, evt = jQuery.event.fix(window.event || arguments.callee.caller.arguments[0]),
  args = Array.prototype.slice.call(arguments, 2);

 switch (action) {
  case 'refresh': inst = 'ds'; action = 'load'; break;
  case 'setPage': inst = 'ds'; break;
  case 'selectCurrent': inst = 'rp'; action = 'select'; break;
 }

 inst = (inst == 'ds')
  ? jQuery.dmxDataSet.dataSets[target]
  : jQuery(evt.target).closest('[data-binding-id="' + target + '"]').data('repeater')
  || jQuery.dmxDataBindings.regions[target];

 if (inst) inst[action].apply(inst, args);

 evt.preventDefault();
}
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
  /* dmxDataSet name "GameAffiliation" */
       jQuery.dmxDataSet(
         {"id": "GameAffiliation", "url": "../dmxDatabaseSources/GamesUnfiltered.php", "data": {"limit": "1000"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "GameAffiliation" */
</script>
</head>
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
        	<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>Create/Update Club</h2>
            <br/>
            <form action="<?php echo $DMX_uploadAction ?>" method="post" enctype="multipart/form-data" name="newClub" class="clean" id="newClub" onSubmit="<?php echo $ppu->getSubmitCode() ?>;return document.MM_returnValue">
        <?php echo $ppu->getProgressField() ?>
        <ol>
          <li>
            <fieldset>
              <legend>Basic Info</legend>
              <ol>
                <li>
                  <label for="ClubName">Club Name</label>
                  <input type="text" id="ClubName" name="ClubName" value="" />
                </li>
                <li>
                  <label for="primaryContactName">Primary Contact</label>
                  <input type="text" id="primaryContactName" name="primaryContactName" value="" />
                </li>
                <li>
                  <label for="primaryContactEmail">Primary Contact Email
                    <input type="text" id="primaryContactEmail" name="primaryContactEmail" value="" />
                  </label>
                </li>
                <li style="">
                  <label for="GameStore">Game Store Affiliation                   
                  
                  <select name="FLGS" id="FLGS" data-binding-repeat-children="{{FLGS.data}}" data-binding-id="repeat2">
                   
                    <option value="{{venue_id}}">{{venue_Name}}</option>
                  </select>
                   </label>
</li>
                 <li style="">
                  <label for="Game Affiliation">Game  System
                  <select name="Game Affiliation" data-binding-repeat-children="{{GameAffiliation.data}}" data-binding-id="repeat1">
                    <option value="{{game_system_id}}">{{game_system_Title}} </option>
                  </select>
                  </label>
</li>
                <li style="">
                  <label for="logo">Logo</label>
                  <input name="logo" type="file" id="logo" onChange="<?php echo $uploadlogo->getValidateCode() ?>;return document.MM_returnValue">
                  <input name="logoWidth" type="hidden" id="logoWidth" value="<?php echo $ppu->files("logoWidth")->Value ?>">
                  <input name="logoHeight" type="hidden" id="logoHeight" value="<?php echo $ppu->files("logoHeight")->Value ?>">
                </li>
              </ol>
            </fieldset>
          </li>
          <li>
            <fieldset>
              <legend>Club Role Titles</legend>
              <ol>
                <li>
                  <label for="adminTitle">Administrator Title</label>
                  <input type="text" id="adminTitle" name="adminTitle" value="" />
                </li>
                <li style="">
                  <label for="editorTitle">Editor Title</label>
                  <input type="text" id="editorTitle" name="editorTitle" value="" />
                </li>
                <li>
                  <label for="modTitle">Moderator Title</label>
                  <input type="text" id="modTitle" name="modTitle" value="" />
                </li>
                <li>
                  <label for="pledgeTitle">Member Title</label>
                  <input type="text" id="pledgeTitle" name="pledgeTitle" value="" />
                </li>
                <li>
                  <label for="pledgeTitle">Pledge Title</label>
                  <input type="text" id="pledgeTitle" name="pledgeTitle" value="" />
                </li>
              </ol>
            </fieldset>
          </li>
          <li>
            <fieldset>
              <legend>Social Connections</legend>
              <ol>
                <li>
                  <label for="facebook">Facebook</label>
                  <input type="text" id="facebook" name="facebook" value="" />
                </li>
                <li>
                  <label for="twitter">Twitter</label>
                  <input type="text" id="twitter" name="twitter" value="" />
                </li>
                <li>
                  <label for="website">Official Website</label>
                  <input type="text" id="website" name="website" value="" />
                </li>
              </ol>
            </fieldset>
          </li>
          <li style="">
            <fieldset>
              <legend>Settings</legend>
              <ol>
                <li>
                  <label for="showMembersonPages">Show Member Lists on Public Pages</label>
                  <div>
                    <label>
                      <input type="radio" name="showMembersonPages" value="Yes" />
                      Yes</label>
                    <label>
                      <input name="showMembersonPages" type="radio" value="No" checked />
                      No</label>
                      <input name="clubOwner" type="hidden" id="clubOwner" value="{{LoggedInUser.data[0].id}}" data-binding-value="{{LoggedInUser.data[0].id}}">
                  </div>
                </li>
              </ol>
            </fieldset>
          </li>
        </ol>
        <p style="text-align:right;" onClick="dmxDatabaseActionControl('run','InsertClub',{},this)">
          <input name="InsertClub" type="submit" id="InsertClub" formenctype="multipart/form-data" value="INSERT CLUB">
        </p>
      </form>
            <p>&nbsp;</p>
 <script type="text/javascript">
  /* dmxDatabaseAction name "InsertClub" */
       jQuery.dmxDatabaseAction(
         {"id": "InsertClub", "url": "../dmxDatabaseActions/InsertClub.php", "data": {"club_name": "{{$FORM.ClubName}}", "clubDescription": "", "FLGS_affiliation": "{{$FORM.FLGS}}", "club_email": "{{$FORM.primaryContactEmail}}", "club_contact_name": "{{$FORM.primaryContactName}}", "club_admin_name": "{{$FORM.adminTitle}}", "club_editor_name": "{{$FORM.editorTitle}}", "club_moderator_name": "{{$FORM.modTitle}}", "club_Member_name": "{{$FORM.pledgeTitle}}", "club_facebook": "{{$FORM.facebook}}", "club_twitter": "{{$FORM.twitter}}", "club_website": "{{$FORM.website}}", "club_display_Members": "{{$FORM.showMembersonPages}}", "club_logo": "{{$FORM.logo}}", "clubOwner": "{{$FORM.clubOwner}}"}, "success": "dmxNotifyAction({\"positionClass\": \"toast-top-full-width\", \"title\": \"Club has been created.\", \"msg\": \" You will now be taken back to the Club Admin Home page.\\n(Click anywhere in this message to close it)\", \"extendedTimeOut\": 2000, \"tapToDismiss\": false});"}
       );
  /* END dmxDatabaseAction name "InsertClub" */
 </script>           
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 