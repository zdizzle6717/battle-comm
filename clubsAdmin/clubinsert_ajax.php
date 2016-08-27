<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?><br>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}
?>
<?php
if (!function_exists("WADFP_getImageHeight")){
function WADFP_getImageHeight($fileField){
	$WA_ImageContentTypes = array("image/gif" => true , "image/jpeg" => true, "image/pjpeg" => true, "image/x-png" => true, "image/png" => true);
	$height = -1;
	
	if(isset($fileField) && isset($fileField["tmp_name"]) &&  isset($fileField["type"]) && isset($WA_ImageContentTypes[$fileField["type"]]) ){
		$dimensions = getimagesize($fileField["tmp_name"]);
		$height = $dimensions[1];
	}
	return $height;
}
}
?>
<?php
if (!function_exists("WADFP_getImageWidth")){
function WADFP_getImageWidth($fileField){
	$WA_ImageContentTypes = array("image/gif" => true , "image/jpeg" => true, "image/pjpeg" => true, "image/x-png" => true, "image/png" => true);
	$width = -1;
	
	if(isset($fileField) && isset($fileField["tmp_name"]) &&  isset($fileField["type"]) && isset($WA_ImageContentTypes[$fileField["type"]]) ){
		$dimensions = getimagesize($fileField["tmp_name"]);
		$width = $dimensions[0];
	}
	return $width;
}
}
?>

<?php 
//*** Pure PHP File Upload 3.1.0
// Process form newClub
$ppu = new pureFileUpload();
$ppu->nameConflict = "over";
$ppu->storeType = "file";
$ppu->progressBar = "html5.htm";
$ppu->progressWidth = 350;
$ppu->progressHeight = 150;
$ppu->path = "../uploads/club";
$ppu->allowedExtensions = "GIF,JPG,JPEG,BMP,PNG"; // ""
$ppu->redirectUrl = "";
$ppu->checkVersion("3.1.0");
$ppu->doUpload();
if ($ppu->done) {
  $_POST["logoWidth"] = $ppu->files("logo")->width;
  $_POST["logoHeight"] = $ppu->files("logo")->height;
}
?>
<?php
if (isset($_POST["submit"]) || isset($_POST["submit_x"])) {
  $InsertQuery = new WA_MySQLi_Query($battlecomm_sqli);
  $InsertQuery->Action = "insert";
  $InsertQuery->Table = "club";
  $InsertQuery->bindColumn("club_name", "s", "".((isset($_POST["ClubName"]))?$_POST["ClubName"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("clubDescription", "s", "".((isset($_POST["ClubDescription"]))?$_POST["ClubDescription"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("FLGS_affiliation", "s", "".((isset($_POST["FLGS"]))?$_POST["FLGS"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_email", "s", "".((isset($_POST["primaryContactEmail"]))?$_POST["primaryContactEmail"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_contact_name", "s", "".((isset($_POST["primaryContactName"]))?$_POST["primaryContactName"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_admin_name", "s", "".((isset($_POST["adminTitle"]))?$_POST["adminTitle"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_editor_name", "s", "".((isset($_POST["editorTitle"]))?$_POST["editorTitle"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_moderator_name", "s", "".((isset($_POST["modTitle"]))?$_POST["modTitle"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_Member_name", "s", "".((isset($_POST["memberTitle"]))?$_POST["memberTitle"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_facebook", "s", "".((isset($_POST["facebook"]))?$_POST["facebook"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_twitter", "s", "".((isset($_POST["twitter"]))?$_POST["twitter"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_website", "s", "".((isset($_POST["twitter"]))?$_POST["twitter"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_display_Members", "s", "".((isset($_POST["showMembersonPages"]))?$_POST["showMembersonPages"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("club_logo", "s", "".((isset($_FILES["logo"]))?$_FILES["logo"]["name"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("logo_w", "s", "".((isset($_POST["logoWidth"]))?$_POST["logoWidth"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("logo_h", "s", "".((isset($_POST["logoHeight"]))?$_POST["logoHeight"]:"")  ."", "WA_DEFAULT");
  $InsertQuery->bindColumn("clubOwner", "i", "".((isset($_POST["userID"]))?$_POST["userID"]:"")  ."", "WA_DEFAULT");
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Create New Club</title>
<link rel="stylesheet" type="text/css" href="../tool/bootstrap/3/css/bootstrap-theme.css" />
<link href="../tool/admin_temp.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../Styles/dmxNotify.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<link href="../Styles/form_clean.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.row1 {  margin-left: -2%;
  margin-right: -2%;
}
</style>
<script type="text/javascript" src="../ScriptLibrary/dmxNotify.js"></script>
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

  /* dmxDataSet name "news" */
       jQuery.dmxDataSet(
         {"id": "news", "url": "../../dmxDatabaseSources/news.php", "data": {"sort": "news_date_published", "limit": "3"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "news" */
function dmxNotifyAction() {   //ver 1.00
  if (arguments && arguments.length > 0) {
    if(typeof arguments[0] == 'object'){
      jQuery.dmxNotify(arguments[0]);
    }else if(arguments[0] === 'closeAll'){
       jQuery.dmxNotify.closeAll();
    }
  }
}

/* dmxDataSet name "FLGS" */
       jQuery.dmxDataSet(
         {"id": "FLGS", "url": "../dmxDatabaseSources/FLGSList.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "FLGS" */
</script>
<script type="text/javascript"><?php echo $ppu->generateScriptCode() ?></script>
<script src="../ScriptLibrary/incPU3.js" type="text/javascript"></script>
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="Header">
      <h2>BattleComm.com Club Administration</h2></h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"></div>
  </div>
  <div class="row">
  <div id="PlayerNav">
                <a href="/players/index.php">Player Home</a> | <a href="/players/mydashboard.php">My Dashboard</a> |
                <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
                <a href="index.php">Tournament Admin</a> |
                <?php } // End Show Region ?>
                <a href="../players/user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Edit Account</a> |
                <a href="../players/editProfileA.php">Edit Profile (A)</a>
                <?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
                | <a href="../admin/index.php"> System Administrator</a> |
                <?php } // End Show Region ?>
                <a href="../clubsAdmin/index.php">
                <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
Club Admin
<?php } // End Show Region ?>
                </a></div>
    <div class="col-lg-12">
      <h2>Add New Club</h2>
      <p>Instructions and WhatNot </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <form action="<?php echo $DMX_uploadAction ?>" method="post" enctype="multipart/form-data" name="newClub" class="clean" id="newClub" onSubmit="<?php echo $ppu->getSubmitCode() ?>;return document.MM_returnValue">
        <?php echo $ppu->getProgressField() ?>
        <ol>
          <li>
            <fieldset>
              <ol>
                <li>
                  <label for="ClubName">Club Name</label>
                  <input type="text" id="ClubName" name="ClubName" value="" />
                </li>
                <li>
                  <label for="ClubDescription">Club Description
                    <textarea name="ClubDescription" id="ClubDescription" rows="6"></textarea>
                  </label>
                </li>
                <li>
                  <label for="primaryContactName">Primary Contact</label>
                  <input type="text" id="primaryContactName" name="primaryContactName" value="" />
                </li>
                <li>
                  <label for="primaryContactEmail">Primary Contact Email</label>
                  <input type="text" id="primaryContactEmail" name="primaryContactEmail" value="" />
                </li>
                <li style="">
                  <label for="FLGS">Game Store Affiliation</label>
                  <select name="FLGS" id="FLGS" data-binding-repeat-children="{{FLGS.data}}" data-binding-id="repeat2">
                    <option value="{{venue_id}}">{{venue_Name}}</option>
                  </select>
                </li><li>
                  <label for="pledgeTitle">Pledge Title</label>
                  <input type="text" id="pledgeTitle" name="pledgeTitle" value="" />
                </li>
                <li style="">
                  <label for="logo">Logo</label>
                  <input name="logo" type="file" id="logo" onChange="<?php echo $ppu->getValidateCode() ?>;return document.MM_returnValue">
                  <input name="logoWidth" type="hidden" id="logoWidth" form="newClub" value="<?php echo $ppu->files("logo")->width ?>">
                  <input name="logoHeight" type="hidden" id="logoHeight" value="<?php echo $ppu->files("logo")->height ?>">
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
                  <label for="memberTitle">MemberTitle</label>
                  <input type="text" id="memberTitle" name="memberTitle" value="" />
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
          uid:<?php echo $_SESSION['SecurityAssist_id']; ?>
  <input name="userID" type="hidden" id="userID" value="<?php echo $_SESSION['SecurityAssist_id']; ?>">
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
          </div>
        </li>
      </ol>
    </fieldset>
  </li>
        </ol>
       
          <input name="submit" type="submit" id="submit" form="newClub" formenctype="multipart/form-data" formmethod="POST" value="Insert Club">
        </p>
      </form>
      
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>News</h2>
      <div id="newsWrapper" data-binding-id="repeat1" data-binding-repeat="{{news.data}}"><img src="" width="120" data-binding-src="{{featured_image}}" align="texttop" /><strong>{{news_title}} </strong> -{{news_date_published}} - {{news_callout.trunc( 50, true, "…" )}}<a href="#">[Read More...]</a></div>
    </div>
    <div class="col-lg-6">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>

</body>
</html>