<?php require_once('../Connections/local.php'); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php 
//*** Pure PHP File Upload 3.1.0
// Process form dmxUniform1
$ppu = new pureFileUpload();
$ppu->nameConflict = "over";
$ppu->storeType = "path";
$ppu->progressBar = "html5.htm";
$ppu->progressWidth = 350;
$ppu->progressHeight = 150;
$ppu->path = "../uploads/player/". $_SESSION['SecurityAssist_id'];
$ppu->redirectUrl = "";
$ppu->checkVersion("3.1.0");
$ppu->doUpload();
if ($ppu->done) {
  $_POST["undefined"] = undefined;
  $_POST["undefined"] = undefined;
}
?>
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

$colname_User = "-1";
if (isset($_SESSION['SecurityAssist_id'])) {
  $colname_User = $_SESSION['SecurityAssist_id'];
}
mysql_select_db($database_local, $local);
$query_User = sprintf("SELECT id, user_icon FROM user_login WHERE id = %s", GetSQLValueString($colname_User, "int"));
$User = mysql_query($query_User, $local) or die(mysql_error());
$row_User = mysql_fetch_assoc($User);
$totalRows_User = mysql_num_rows($User);?>
<?php 
// WA DataAssist Update
if ($_SERVER["REQUEST_METHOD"] == "POST") // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_redirectURL = "";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "user_icon";
  $WA_fieldValuesStr = "".((isset($_FILES["uploadIcon"]))?$_FILES["uploadIcon"]["name"]:"")  ."";
  $WA_columnTypesStr = "',none,''";
  $WA_comparisonStr = "=";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  
  $WA_where_fieldValuesStr = "".$row_User['id']  ."";
  $WA_where_columnTypesStr = "none,none,NULL";
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
<?php $toplevel = $_SERVER['DOCUMENT_ROOT']. "/Templates/parts/";
		include ($toplevel. "head.php"); ?>
<script type="text/javascript"><?php echo $ppu->generateScriptCode() ?></script>
<script src="../ScriptLibrary/incPU3.js" type="text/javascript"></script>
<?php include ($toplevel. "header.php"); ?>
        <?php include ($toplevel. "container-top.php"); ?>
        <link rel="stylesheet" type="text/css" href="../Styles/dmxAjaxForm.css" />
<script type="text/javascript" src="../ScriptLibrary/dmxAjaxForm.js"></script>
        
			<h2>Upload/Change Icon</h2>
            <p>Instructions, etc etc.</p>
            <div class="dmxAjaxFormContainer" id="dmxUniform1_container">
  <form id="dmxUniform1" class="dmxAjaxForm" name="dmxUniform1" action="<?php echo $DMX_uploadAction ?>" method="post" enctype="multipart/form-data" onSubmit="<?php echo $ppu->getSubmitCode() ?>;return document.MM_returnValue">
    <?php echo $ppu->getProgressField() ?>
    <input name="uploadIcon" type="file" id="uploadIcon" form="dmxUniform1" onChange="<?php echo $ppu->getValidateCode() ?>;return document.MM_returnValue">
    <input name="primaryID" type="hidden" id="primaryID" value="<?php echo $row_User['id']; ?>">
    <br>
    <input type="submit" name="submit" id="submit" value="Submit">
  </form>
  <script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxUniform1").dmxAjaxForm(
         {}
       );
     }
 );
  // ]]>
</script>
  <div class="dmxAjaxFormError"></div>
  <div class="dmxAjaxFormSuccess">
    <h1>Your Image Has Been Uploaded</h1>
  </div>
            </div>
            <script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxUniform1").dmxUniform(
         {}
       );
     }
 );
  // ]]>
            </script>
<p><img src="<?php echo $ppu->files("uploadIcon")->path ?>/<?php echo $row_User['user_icon']; ?>" alt="" width="200"/></p>

       
        
        <? 
		include ($toplevel. "container-bottom.php");
		?>
        
<?php 
include ($toplevel. "footer.php"); ?>
<?php
mysql_free_result($User);
?>
