<?php require_once("../../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_bcnewsupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateDT((isset($_POST["news_date_published"])?$_POST["news_date_published"]:"") . "",true,"","","",false,"","","",false,1);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"bcnewsupdate");
   }
 }
 ?>
<?php require_once("../../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
$Paramnews_id_WADAbc_news = "-1";
if (isset($_GET['news_id'])) {
  $Paramnews_id_WADAbc_news = $_GET['news_id'];
}
mysql_select_db($database_local, $local);
$query_WADAbc_news = sprintf("SELECT news_id, news_title, featured_image, news_callout, news_body, news_author, publish, news_date_published, news_featured, tags, parent, game_system, news_submitted_IP_number FROM bc_news WHERE news_id = %s", GetSQLValueString($Paramnews_id_WADAbc_news, "int"));
$WADAbc_news = mysql_query($query_WADAbc_news, $local) or die(mysql_error());
$row_WADAbc_news = mysql_fetch_assoc($WADAbc_news);
$totalRows_WADAbc_news = mysql_num_rows($WADAbc_news);
?>
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
	'DefaultFileName' => "".($row_WADAbc_news["featured_image"])  ."",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(isset($_POST["Update"]) || isset($_POST["Update_x"])){
	WA_DFP_UploadFiles("WA_UploadResult1", "featured_image", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "bc_news";
  $WA_redirectURL = "bc_news_detail.php?news_id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAbc_news"])?"&pageNum_WADAbc_news=".intval($_GET["pageNum_WADAbc_news"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "news_id";
  $WA_fieldNamesStr = "news_title|featured_image|news_callout|news_body|news_author|publish|news_date_published|news_featured|tags|parent|game_system|news_submitted_IP_number";
  $WA_fieldValuesStr = "".((isset($_POST["news_title"]))?$_POST["news_title"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["news_callout"]))?$_POST["news_callout"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["news_body"]))?$_POST["news_body"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["news_author"]))?$_POST["news_author"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["publish"]))?$_POST["publish"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["news_date_published"]) && $_POST["news_date_published"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["news_date_published"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["news_featured"]))?$_POST["news_featured"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tags"]))?$_POST["tags"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["parent"]))?$_POST["parent"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system"]))?$_POST["game_system"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["news_submitted_IP_number"]))?$_POST["news_submitted_IP_number"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | = | LIKE | LIKE | LIKE | LIKE | LIKE ";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  
  $WA_where_fieldValuesStr = "".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."";
  $WA_where_columnTypesStr = "',none,''";
  $WA_where_comparisonStr = "=";
  $WA_where_fieldNames = explode("|", $WA_indexField);
  $WA_where_fieldValues = explode($WA_AB_Split, $WA_where_fieldValuesStr);
  $WA_where_columns = explode("|", $WA_where_columnTypesStr);
  $WA_where_comparisons = explode("|", $WA_where_comparisonStr);
  
  $WA_connectionDB = $database_local;
  mysql_select_db($WA_connectionDB, $WA_connection);
  @session_start();
  $updateParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WhereObj = WA_AB_generateWhereClause($WA_where_fieldNames, $WA_where_columns, $WA_where_fieldValues,  $WA_where_comparisons );
  $WA_Sql = "UPDATE `" . $WA_table . "` SET " . $updateParamsObj->WA_setValues . " WHERE " . $WhereObj->sqlWhereClause . "";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  if ($WA_redirectURL != "")  {
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../webassist/jq_validation/Bloom.css">
<link type="text/css" href="../../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
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
<link href="file:///C|/xampp/htdocs/testBC/webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Update_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data"  class="Basic_Default" id="Update_Basic_Default" name="Update_Basic_Default" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Default" id="Update">
          <legend class="groupHeader">Update</legend>
    <div class="lineGroup"> <label for="news_title" class="sublabel" > Title:</label>
  <input id="news_title" name="news_title" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","news_title"):"".$row_WADAbc_news["news_title"]."")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="featured_image" class="sublabel" > Featured Image:</label>
  <input name="featured_image" type="file" id="featured_image" size="30" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="news_callout" class="sublabel" > Callout:</label>
  <textarea name="news_callout" id="news_callout" class="formTextarea_Medium" rows="1" cols="1" tabindex="3" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","news_callout"):"".$row_WADAbc_news["news_callout"]."")); ?></textarea>
    </div> 
    <div class="lineGroup"> <label for="news_body" class="sublabel" > Article Body:</label><div style="display:inline-block"><?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","news_body",false):"".$row_WADAbc_news["news_body"].""))  ."";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "Full";
$CKEditor_config["wa_preset_file"] = "Full.xml";
$CKEditor_config["width"] = "514px";
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
    </div> 
    <div class="lineGroup"> <label for="news_author" class="sublabel" > Author:</label>
  <input id="news_author" name="news_author" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","news_author"):"".$row_WADAbc_news["news_author"]."")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="publish" class="sublabel" > Publish:</label>
      <select class="formMenufield_Medium" name="publish" id="publish" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","publish"):"".$row_WADAbc_news["publish"]."")); ?>" tabindex="5" title="Please enter a value.">
        <option value="yes" <?php if (!(strcmp("yes", $row_WADAbc_news['publish']))) {echo "selected=\"selected\"";} ?>>Yes</option>
        <option value="no" <?php if (!(strcmp("no", $row_WADAbc_news['publish']))) {echo "selected=\"selected\"";} ?>>No</option>
        <option value="pending" <?php if (!(strcmp("pending", $row_WADAbc_news['publish']))) {echo "selected=\"selected\"";} ?>>Pending</option>
      </select>
    </div> 
    <div class="lineGroup"> <label for="news_date_published" class="sublabel" > Date Published:</label>
  <input id="news_date_published" name="news_date_published" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","news_date_published"):"".(($row_WADAbc_news["news_date_published"])?date("n/d/Y",strtotime($row_WADAbc_news["news_date_published"])):"")."")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value.">
	   <?php
if (ValidatedField('bcnewsupdate','bcnewsupdate'))  {
  if ((strpos((",".ValidatedField("bcnewsupdate","bcnewsupdate").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="news_date_published_ServerError">Please enter a value.</span><?php //WAFV_Conditional bc_news_update.php bcnewsupdate(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="news_featured__1" class="sublabel" > Make Featured:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="news_featured__1">
          yes&nbsp;<input type="radio" name="news_featured" id="news_featured__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","news_featured"):"".$row_WADAbc_news["news_featured"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="7" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="news_featured__2">
          no&nbsp;<input type="radio" name="news_featured" id="news_featured__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","news_featured"):"".$row_WADAbc_news["news_featured"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="8"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="tags" class="sublabel" > Tags:</label>
  <textarea name="tags" id="tags" class="formTextarea_Medium" rows="1" cols="1" tabindex="9" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","tags"):"".$row_WADAbc_news["tags"]."")); ?></textarea>
    </div> 
    <div class="lineGroup"> <label for="parent" class="sublabel" > Parent:</label>
  <input id="parent" name="parent" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","parent"):"".$row_WADAbc_news["parent"]."")); ?>" class="formTextfield_Medium" tabindex="10" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system" class="sublabel" > Game System:</label>
      <select class="formMenufield_Medium" name="game_system" id="game_system" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","game_system"):"".$row_WADAbc_news["game_system"]."")); ?>" tabindex="11" title="Please enter a value.">
<option value="">Choose Game System...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenugame_system['game_system_id']?>"<?php if (!(strcmp($row_WADAMenugame_system['game_system_id'], (isset($_GET["invalid"])?ValidatedField("bcnewsupdate","game_system"):"".$row_WADAbc_news["game_system"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugame_system['game_system_Title']?></option>
        <?php
} while ($row_WADAMenugame_system = mysql_fetch_assoc($WADAMenugame_system));
  $rows = mysql_num_rows($WADAMenugame_system);
  if($rows > 0) {
      mysql_data_seek($WADAMenugame_system, 0);
	  $row_WADAMenugame_system = mysql_fetch_assoc($WADAMenugame_system);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="news_submitted_IP_number" class="sublabel" > IP Number:</label>
<span class="TextOnly">
{RecordsetFieldValue}
</span>
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Update" class="formButton Modular" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("bcnewsupdate","WADAUpdateRecordID"):$_GET["news_id"])); ?>" />
</form></div><div id="Update_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Default', 'Update_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Update_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Update_Basic_Default_Opts = {
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
function Update_Basic_Default_Validate() {
    $("#Update_Basic_Default").h5Validate(Update_Basic_Default_Opts);
  }
$(document).ready(function () {
  Update_Basic_Default_Validate()
  ConvertServerErrors(Update_Basic_Default_Opts);
});
</script>

</body>
</html>
<?php
mysql_free_result($WADAbc_news);
?>
<?php
mysql_free_result($WADAMenugame_system);
?>
