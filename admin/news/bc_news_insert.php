<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../../webassist/form_validations/wavt_scripts_php.php"); ?>

<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_bcnewsinsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateDT((isset($_POST["news_date_published"])?$_POST["news_date_published"]:"") . "",true,"","","",false,"","","",false,1);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"bcnewsinsert");
   }
 }
 ?>
<?php require_once("../../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenugame_system = "SELECT game_system_Title, game_system_id FROM game_system ORDER BY game_system_Title ASC";
$WADAMenugame_system = mysql_query($query_WADAMenugame_system, $local) or die(mysql_error());
$row_WADAMenugame_system = mysql_fetch_assoc($WADAMenugame_system);
$totalRows_WADAMenugame_system = mysql_num_rows($WADAMenugame_system);
?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../../uploads/news",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(isset($_POST["Insert"]) || isset($_POST["Insert_x"])){
	WA_DFP_UploadFiles("WA_UploadResult1", "featured_image", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "bc_news";
  $WA_sessionName = "WADA_Insert_bc_news";
  $WA_redirectURL = "bc_news_detail.php?news_id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "news_title|featured_image|news_callout|news_body|news_author|news_date_submitted|publish|news_date_published|news_featured|tags|parent|game_system|news_submitted_IP_number";
  $WA_fieldValuesStr = "".((isset($_POST["news_title"]))?$_POST["news_title"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["news_callout"]))?$_POST["news_callout"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["news_body"]))?$_POST["news_body"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["news_author"]))?$_POST["news_author"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["news_date_submitted"]) && $_POST["news_date_submitted"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["news_date_submitted"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["publish"]))?$_POST["publish"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["news_date_published"]) && $_POST["news_date_published"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["news_date_published"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["news_featured"]))?$_POST["news_featured"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tags"]))?$_POST["tags"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["parent"]))?$_POST["parent"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system"]))?$_POST["game_system"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["news_submitted_IP_number"]))?$_POST["news_submitted_IP_number"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local;
  mysql_select_db($WA_connectionDB, $WA_connection);
  @session_start();
  $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj->WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues . ")";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  $_SESSION[$WA_sessionName] = mysql_insert_id($WA_connection);
  if ($WA_redirectURL != "")  {
    $WA_redirectURL = str_replace("[Insert_ID]",$_SESSION[$WA_sessionName],$WA_redirectURL);
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Battle-Comm: News Post Insert</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/form_clean.css">
    <link href="../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../webassist/jq_validation/Bloom.css">
    <link type="text/css" href="../../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('#news_date_published').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_news_date_published
	});
});
function closeDatePicker_news_date_published() {
	var tElm = $('#news_date_published');
	if (typeof news_date_published_Spry != null && typeof news_date_published_Spry != "undefined" && news_date_published_Spry.validate) {
		news_date_published_Spry.validate();
	}
	tElm.blur();
}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../css/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../css/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/form_clean.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../../../js/jquery.magnificant-popup.js"></script>
	<script type="text/javascript" src="../../../js/mobile-toggle.js"></script>
    <script type="text/javascript" src="../../../js/backtotop.js"></script>
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
<?php include '../../Templates/parts/header.php'; ?>
		<?php include '../../Templates/parts/container-top.php'; ?>
        <div class="full_width">
<div id="Insert_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data"  class="clean" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">

<fieldset>
	<legend>News Post</legend>
<ol>
    <li> <label for="news_title" class="sublabel" > Title:</label>
  <input id="news_title" name="news_title" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","news_title"):"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </li> 
    <li> <label for="featured_image" class="sublabel" > Featured Image:</label>
  <input name="featured_image" type="file" id="featured_image" size="30" tabindex="2" title="Please enter a value.">
    </li> 
    <li> <label for="news_callout" class="sublabel" > Callout:</label>
  <textarea name="news_callout" id="news_callout" class="formTextarea_Medium" rows="1" cols="1" tabindex="3" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","news_callout"):"")); ?></textarea>
    </li> 
    <li> <label for="news_body" class="sublabel" > Article Body:</label><div style="display:inline-block;width:100%;"><?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","news_body",false):""))  ."";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "Full";
$CKEditor_config["wa_preset_file"] = "Full.xml";
$CKEditor_config["width"] = "100%";
$CKEditor_config["height"] = "350px";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 4;
$CKEditor_config["toolbar"] = array(
array( 'Cut','Copy','Paste','SpellCheck'),
array( 'Undo','Redo'),
array( 'Bold','Italic','Underline','Subscript','Superscript'),
array( 'NumberedList','BulletedList','-','Outdent','Indent'),
array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'Link','Unlink','Anchor'),
array( 'Table','Rule','SpecialChar'),
array( 'FontName','FontSize'),
array( 'TextColor','BGColor'));
$CKEditor_config["contentsLangDirection"] = "ltr";
$CKEditor_config["entities"] = false;
$CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
$CKEditor_config["pasteFromWordRemoveStyles"] = false;
$CKEditor->editor("news_body", $CKEditor_initialValue, $CKEditor_config);
?></div>
    </li> 
    <li> <label for="news_author" class="sublabel" > Author:</label>
  <input id="news_author" name="news_author" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","news_author"):"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </li> 
    <li> <label for="publish" class="sublabel" > Publish:</label>
      <select name="publish" class="formMenufield_Medium" id="publish" form="Insert_Basic_Default" tabindex="5" title="Please enter a value." rel="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","publish"):"")); ?>">
        <option value="yes">Yes</option>
        <option value="no" selected="selected">No</option>
        <option value="pending">Pending</option>
      </select>
    </li> 
    <li> <label for="news_date_published" class="sublabel" > Date Published:</label>
  <input id="news_date_published" name="news_date_published" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","news_date_published"):"")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value.">
	   <?php
if (ValidatedField('bcnewsinsert','bcnewsinsert'))  {
  if ((strpos((",".ValidatedField("bcnewsinsert","bcnewsinsert").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="news_date_published_ServerError">Please enter a value.</span><?php //WAFV_Conditional bc_news_insert.php bcnewsinsert(1:)
    }
  }
}?>
    </li> 
    <li> <label for="news_featured__1" class="sublabel" > Make Featured:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="news_featured__1">
          yes&nbsp;<input type="radio" name="news_featured" id="news_featured__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","news_featured"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="7" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="news_featured__2">
          no&nbsp;<input type="radio" name="news_featured" id="news_featured__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","news_featured"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="8"></label>
		</span>
</span>
    </li> 
    <li> <label for="tags" class="sublabel" > Tags:</label>
  <textarea name="tags" id="tags" class="formTextarea_Medium" rows="1" cols="1" tabindex="9" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","tags"):"")); ?></textarea>
    </li> 
    <li> <label for="parent" class="sublabel" > Parent:</label>
  <input id="parent" name="parent" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","parent"):"")); ?>" class="formTextfield_Medium" tabindex="10" title="Please enter a value.">
    </li> 
    <li> <label for="game_system" class="sublabel" > Game System:</label>
      <select class="formMenufield_Medium" name="game_system" id="game_system" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","game_system"):"")); ?>" tabindex="11" title="Please enter a value.">
<option value="">Choose Game System...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenugame_system['game_system_id']?>"<?php if (!(strcmp($row_WADAMenugame_system['game_system_id'], (isset($_GET["invalid"])?ValidatedField("bcnewsinsert","game_system"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugame_system['game_system_Title']?></option>
        <?php
} while ($row_WADAMenugame_system = mysql_fetch_assoc($WADAMenugame_system));
  $rows = mysql_num_rows($WADAMenugame_system);
  if($rows > 0) {
      mysql_data_seek($WADAMenugame_system, 0);
	  $row_WADAMenugame_system = mysql_fetch_assoc($WADAMenugame_system);
  }
?>
</select>
    </li> 
    
    </ol>
</fieldset>
</div>

	<div class="full_width" >
		<div class="center">
            <span class="buttonFieldGroup" >
      <input id="news_date_submitted" name="news_date_submitted" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsinsert","news_date_submitted"):"")); ?>">
    <input type="submit" value="Insert" class="formButton Modular" id="Insert" name="Insert" />
            </span>
     	</div>
	</div>
    
        </fieldset>
</form></div><div id="Insert_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Default', 'Insert_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Insert_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>
</div>


  		<?php include '../../Templates/parts/container-bottom.php'; ?>   
<?php include '../../Templates/parts/footer.php'; ?>

<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Insert_Basic_Default_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Bloom",
    pointedAt: "left",
    fieldOffset: 10,
    fieldMargin: 2,
    position: "left",
    direction: "left",
    border: 1,
    offset: 25,
    closeText: "✖",
    percentWidth: 100,
    orientation: "bottom"
  };
function Insert_Basic_Default_Validate() {
    $("#Insert_Basic_Default").h5Validate(Insert_Basic_Default_Opts);
  }
$(document).ready(function () {
  Insert_Basic_Default_Validate()
  ConvertServerErrors(Insert_Basic_Default_Opts);
});
</script>

</body>
</html>
<?php
mysql_free_result($WADAMenugame_system);
?>
