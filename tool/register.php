<?php require_once('Connections/local_local.php'); ?>
<?php require_once("webassist/database_management/wa_appbuilder_php.php"); ?>
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

mysql_select_db($database_local_local, $local_local);
$query_players = "SELECT * FROM players ORDER BY playerHandle ASC";
$players = mysql_query($query_players, $local_local) or die(mysql_error());
$row_players = mysql_fetch_assoc($players);
$totalRows_players = mysql_num_rows($players);

mysql_select_db($database_local_local, $local_local);
$query_Tournament = "SELECT tournament_id, tournament_name, tournament_startDate, Tournament_endDate, tournament_store_location, tournament_email, tournament_URL FROM tournament";
$Tournament = mysql_query($query_Tournament, $local_local) or die(mysql_error());
$row_Tournament = mysql_fetch_assoc($Tournament);
$totalRows_Tournament = mysql_num_rows($Tournament);?>
<?php 
// WA DataAssist Insert
if ($_SERVER["REQUEST_METHOD"] == "POST") // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "tournament_players";
  $WA_sessionName = "regPlayer";
  $WA_redirectURL = "";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "tournament_id|user_login_id|dateRegistered";
  $WA_fieldValuesStr = "".((isset($_POST["tournament"]))?$_POST["tournament"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["Player_handle"]))?$_POST["Player_handle"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["updateDate"]))?$_POST["updateDate"]:"")  ."";
  $WA_columnTypesStr = "none,none,NULL|none,none,NULL|',none,NULL";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tournament Registration</title>
<script src="webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<link href="webassist/forms/fd_newfromblank_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="webassist/jq_validation/Serene.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
</head>

<body>
<h2>Tournament Registration</h2>
<p>&nbsp;</p>
<p>&nbsp;
<div id="BattleCommTestRegistration_NewFromBlank_Default_ProgressWrapper">
  <form class="NewFromBlank_Default" id="BattleCommTestRegistration_NewFromBlank_Default" name="BattleCommTestRegistration_NewFromBlank_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
    <!--
WebAssist CSS Form Builder - Form v1
CC: Registration
CP: BattleComm:TestRegistration
TC: <New From Blank>
TP: Default
-->
    <ul class="NewFromBlank_Default">
      <li>
        <fieldset class="NewFromBlank_Default" id="fieldset">
          <legend class="groupHeader"></legend>
          <ul class="formList">
            <li class="formItem">
              <div class="formGroup">
                <div class="lineGroup">
                  <div class="fullColumnGroup">
                    <label for="Player_handle" class="sublabel" > Username:</label>
                    <select class="formMenufield_Medium" name="Player_handle" id="Player_handle" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("register","Player_handle"):"")); ?>" tabindex="1" title="Please enter your email address.">
                      <?php
do {  
?>
                      <option value="<?php echo $row_players['playerId']?>"><?php echo $row_players['playerHandle']?></option>
                      <?php
} while ($row_players = mysql_fetch_assoc($players));
  $rows = mysql_num_rows($players);
  if($rows > 0) {
      mysql_data_seek($players, 0);
	  $row_players = mysql_fetch_assoc($players);
  }
?>
                    </select>
                  </div>
                </div>
                <div class="lineGroup">
                  <div class="fullColumnGroup">
                    <label for="tournament" class="sublabel" > Tournament:</label>
                    <select class="formMenufield_Medium" name="tournament" id="tournament" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("register","tournament"):"")); ?>" tabindex="2" title="Please enter a value">
                      <?php
do {  
?>
                      <option value="<?php echo $row_Tournament['tournament_id']?>"><?php echo $row_Tournament['tournament_name']?></option>
                      <?php
} while ($row_Tournament = mysql_fetch_assoc($Tournament));
  $rows = mysql_num_rows($Tournament);
  if($rows > 0) {
      mysql_data_seek($Tournament, 0);
	  $row_Tournament = mysql_fetch_assoc($Tournament);
  }
?>
                    </select>
                    <input name="updateDate" type="hidden" id="updateDate" form="BattleCommTestRegistration_NewFromBlank_Default" value="<?php echo(date("Y-m-d")); ?>">
                  </div>
                </div>
              </div>
            </li>
            <li class="formItem"> <span class="buttonFieldGroup" >
              <input class="formButton" name="BattleCommTestRegistration_submit" type="submit" id="BattleCommTestRegistration_submit" value="Submit"   tabindex="3">
            </span> </li>
          </ul>
        </fieldset>
      </li>
    </ul>
  </form>
</div>
<div id="BattleCommTestRegistration_NewFromBlank_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
  <script type="text/javascript">
WADFP_SetProgressToForm('BattleCommTestRegistration_NewFromBlank_Default', 'BattleCommTestRegistration_NewFromBlank_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
  </script>
<div id="BattleCommTestRegistration_NewFromBlank_Default_ProgressMessage" >
  <p style="margin:10px; padding:5px;" ><img src="webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>
</p>
<script src="webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var BattleCommTestRegistration_NewFromBlank_Default_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Serene",
    pointedAt: "middle",
    fieldOffset: 0,
    fieldMargin: 0,
    position: "middle",
    direction: "middle",
    border: 0,
    offset: 0,
    closeText: "✖",
    percentWidth: 100,
    orientation: "left"
  };
function BattleCommTestRegistration_NewFromBlank_Default_Validate() {
    $("#BattleCommTestRegistration_NewFromBlank_Default").h5Validate(BattleCommTestRegistration_NewFromBlank_Default_Opts);
  }
$(document).ready(function () {
  BattleCommTestRegistration_NewFromBlank_Default_Validate()
  ConvertServerErrors(BattleCommTestRegistration_NewFromBlank_Default_Opts);
});
</script>
<script src="webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script>
var BattleCommTestRegistration_NewFromBlank_Default_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Serene",
    pointedAt: "middle",
    fieldOffset: 0,
    fieldMargin: 0,
    position: "middle",
    direction: "middle",
    border: 0,
    offset: 0,
    closeText: "✖",
    percentWidth: 100,
    orientation: "left"
  };
function BattleCommTestRegistration_NewFromBlank_Default_Validate() {
    $("#BattleCommTestRegistration_NewFromBlank_Default").h5Validate(BattleCommTestRegistration_NewFromBlank_Default_Opts);
  }
$(document).ready(function () {
  BattleCommTestRegistration_NewFromBlank_Default_Validate()
  ConvertServerErrors(BattleCommTestRegistration_NewFromBlank_Default_Opts);
});
</script>
</body>
</html>
<?php
mysql_free_result($players);

mysql_free_result($Tournament);
?>
