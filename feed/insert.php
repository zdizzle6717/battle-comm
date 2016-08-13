<?php require_once('../Connections/local.php'); ?>
<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php
$FeedList = new WA_MySQLi_RS("FeedList",$battlecomm_sqli,0);
$FeedList->setQuery("SELECT * FROM tableUpdates ORDER BY tableUpdates.`when` DESC");
$FeedList->execute();
?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "tableUpdates";
  $WA_sessionName = "WADA_Insert_tableUpdates";
  $WA_redirectURL = "insert.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "title|description|when";
  $WA_fieldValuesStr = "".((isset($_POST["title"]))?$_POST["title"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["description"]))?$_POST["description"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["when"]) && $_POST["when"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["when"])):"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,NULL";
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
<title>Battle-Comm: RSS Insert</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/form_clean.css">
    <link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../webassist/jq_validation/Bloom.css">
    <link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
    <script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
</head>

<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
<div id="Insert_Basic_Default_ProgressWrapper">
<form class="clean" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
          <legend class="groupHeader">Insert Item Into Feed</legend>
<ol>
    <li> <label for="title" class="sublabel" > Title:</label>
  <input id="title" name="title" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("insert","title"):"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
  </li> 
    <li> <label for="description" class="sublabel" > Description:</label>
  <textarea name="description" id="description" class="formTextarea_Medium" rows="1" cols="1" tabindex="2" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("insert","description"):"")); ?></textarea>
    </li> 
</ol> 
	<div class="full_width" >
		<div class="center">
        <span class="buttonFieldGroup" >
  <input id="when" name="when" type="hidden" value="<?php echo date("Y-m-d h:m:s"); ?>">
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
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../webassist/jq_validation/jquery.h5validate.js"></script>
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
<p>
<div id="feedList" style="padding-top:24px;">
  <ul>
    <?php
while(!$FeedList->atEnd()) {
?>
    <li><strong><?php echo($FeedList->getColumnVal("title")); ?></strong>
      <ul>
        <li><?php echo($FeedList->getColumnVal("description")); ?><br>
        <?php echo($FeedList->getColumnVal("when")); ?>        </li>
      </ul>
    </li>
    <?php
  $FeedList->moveNext();
}
$FeedList->moveFirst(); //return RS to first record
?>
  </ul>
</div>
</p>

  		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?>
