<?php
//'***********************
// Web Image Editor
//***********************
require_once("../dwzImageEditor/WebImageEditor.php");?>
<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php
$playerImage = new WA_MySQLi_RS("playerImage",$battlecomm_sqli,1);
$playerImage->setQuery("SELECT CONCAT (user_login.imagePath, user_login.id,'/', user_login.user_icon) AS ImageSource FROM user_login WHERE user_login.id = ?");
$playerImage->bindParam("i", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param1
$playerImage->execute();
?>
<!doctype html>
<html>
<head>
<?php
//'***********************
// Web Image Editor
//***********************
WebImageEditorIncludes("../;black-tie");
//'***********************
// Web Image Editor
//***********************
?>
<meta charset="utf-8">
<title>Untitled Document</title>
<!--<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */ 
</script>-->
</head>

<body>
<p>
<img onclick="<?php
//***********************
// http://www.DwZone-it.com
// Web Image Editor - IMAGE
// Version 1.0.9
//***********************
// editme
$dwzImageEditor = new WebImageEditor();
$dwzImageEditor->Init();
$dwzImageEditor->SetParams("../@_@false@_@500@_@500@_@#FFFFFF@_@\@_''_@@_start_@ @_ec_ho_@(@_dollar_@playerImage->getColumnVal(@_''_@ImageSource@_''_@))@_dot_comma_@ @_end_@\@_''_@@_@/uploads/editTemp@_@@_@@_@false@_@true@_@true@_@true@_@true@_@false@_@false@_@false@_@@_@@_@@_@0@_@0@_@0@_@0@_@true@_@80@_@false@_@@_@@_@_small@_@2@_@false@_@@_@@_@_small@_@2@_@false@_@black-tie");
$dwzImageEditor->InsertCode();
//***********************
// Web Image Editor
//***********************
?>" id="editme" src="<?php echo($playerImage->getColumnVal("ImageSource")); ?>"  width="500" alt="" />
</p>
            <p>
              <input name="editImage" type="button" id="editImage" title="EditImage" value="Edit Image">
            </p>
            <p><?php echo($playerImage->getColumnVal("ImageSource")); ?></p>
</body>
</html>