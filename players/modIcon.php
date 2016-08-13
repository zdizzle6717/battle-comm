<?php require_once('../Connections/local.php'); ?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
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

$colname_rsPlayerIcon = "-1";
if (isset($_GET['id'])) {
  $colname_rsPlayerIcon = $_GET['id'];
}
mysql_select_db($database_local, $local);
$query_rsPlayerIcon = sprintf("SELECT id, user_icon FROM user_login WHERE id = %s", GetSQLValueString($colname_rsPlayerIcon, "int"));
$rsPlayerIcon = mysql_query($query_rsPlayerIcon, $local) or die(mysql_error());
$row_rsPlayerIcon = mysql_fetch_assoc($rsPlayerIcon);
$totalRows_rsPlayerIcon = mysql_num_rows($rsPlayerIcon);?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../uploads/player/".$_SESSION['SecurityAssist_id']  ."/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "100",
	'ResizeHeight' => "120",
	'ResizeFillColor' => "#FFFFFF" );
// WA_UploadResult1_1 End
// WA_UploadResult1_2 Start
$WA_UploadResult1_Params["WA_UploadResult1_2"] = array(
	'UploadFolder' => "../uploads/player/".$_SESSION['SecurityAssist_id']  ."/",
	'FileName' => "[FileName]_thumb",
	'DefaultFileName' => "",
	'ResizeType' => "2",
	'ResizeWidth' => "100",
	'ResizeHeight' => "120",
	'ResizeFillColor' => "#FFFFFF" );
// WA_UploadResult1_2 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST)){
	WA_DFP_UploadFiles("WA_UploadResult1", "iconupload", "2", "[NewFileName]_[Increment]", "true", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Update
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST)) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_redirectURL = "modIcon.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "user_icon";
  $WA_fieldValuesStr = "/uploads/player/".$_SESSION['SecurityAssist_id']  ."/".((isset($_FILES["iconupload"]))?$_FILES["iconupload"]["name"]:"")  ."";
  $WA_columnTypesStr = "',none,''";
  $WA_comparisonStr = "=";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  
  $WA_where_fieldValuesStr = "".$_GET['id']  ."";
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
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BattleComm: Shop</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../pixie/assets/css/integrate.css">
    
    <link rel="stylesheet" type="text/css" media="screen" href="../pixie/integrate/highlight/prism.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
	<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
    <script type="text/javascript" src="../Scripts/backtotop.js"></script>
</head>

    <body>
    	<!-- HEADER -->
        <div class="nav placeholder center" id="returnhome">
        </div>
        <div class="nav row center">
        	<?php include '../includes/account-nav.php'; ?>
            <div class="mobilenav">
                <?php include '../includes/top-navigation.php'; ?>
            </div>
            <div class="uppernav">
                <?php include '../includes/top-navigation.php'; ?>
            </div>
           	<script type="text/javascript">
				$('.scrollDown').click(function(){
					$('html, body').animate({
						scrollTop: $( $(this).attr('href') ).offset().top
					}, 800);
					return false;
				});
			</script>
		</div>
        <div class="site_bg"></div>
        <div class="header row center">
            <div class="logo"><a href="../index.php"><img src="../images/BC_Web_Logo.png" alt="BattleComm"></a></div>
            <div class="mobile-logo"><a href="../index.php"><img src="../images/BC_Web_Logo_mobile.png" alt="BattleComm"></a>
                <div class="mobile-buttons">
                    <div class="my-profile-button"><a href="../admin/user/profile-edit.php"><img src="../images/BC_App_MyProfile.png" alt="BattleComm"></a></div><div class="create-match-button"><a href="../match.php"><img src="../images/BC_App_CreateMatch.png" alt="BattleComm"></a></div>
                </div>
            </div>
        </div>
        
  
        <!-- Middle -->
        <div class="mids">
        	<div class="container_full_width_table no_shadow no_background no_padding">
        		<div class="full_content col" >
                    <div class="frame_u row">
                        <div class="frame_u_bar_full col">
                        	<div class="title_large"><h1>Upload/Modify Icon</h1></div>
                        </div>
                        <div class="frame_ul_corner col"></div>
                        <div class="frame_ur_corner col"></div>
                    </div>
                    <div class="frame_content row">
                        <div class="frame_l_bar col"></div>
                        <div class="frame_r_bar col"></div>
                        <div class="frame_center_panel col">
                        	<div class="full_width">
                            <p><form action="#" method="post" enctype="multipart/form-data" name="icon" id="icon">
                            <input name="playerID" type="hidden" id="playerID" value="<?php echo $_SESSION['SecurityAssist_id']; ?>">
                            <input name="iconupload" type="file" id="iconupload">
                            <input type="submit"></form></p>								<p><img src="..<?php echo $row_rsPlayerIcon['user_icon']; ?>" alt=" " id="edit-me" class="img-responsive">
                            		</p>
            				</div>
                   		</div>
					</div>
                    <div class="frame_b row">
                        <div class="frame_b_bar_full col"></div>
                        <div class="frame_bl_corner col"></div>
                        <div class="frame_br_corner col"></div>
                    </div>
                </div>
            </div>
        </div>
              
        
        <!-- FOOTER -->
        <div class="footer">
            <div class="sub-footer center" id="contact">
                <div class="three_column_1 subfooter_filler">
                </div>
                <div class="three_column_1 subfooter no_margin">
                    <img src="../images/Titles/Contact_Us.png" alt=""/>
    <h4 class="left">By Phone: (909) 343-5454</h4>
                    <h4 class="left">By E-mail: Contact@Battle-Comm.com</h4>
                    <h4 class="left">Address: 555 Boutel Dr.</h4>
                    <h4 class="indent left">Someplace, CA</h4>
                </div>
                <div class="three_column_1 subfooter">
                    <img src="../images/Titles/Follow_Us.png" alt=""/>
                    <?php include '../includes/social-links.php'; ?>
                </div>
    
            </div>
            <?php include '../includes/footer.php'; ?>
            <a href="#" id="backtotop" style="display: block;">
                <span class="fa fa-angle-up"></span>
                <span class="back-to-top">Top</span>
            </a>
        </div>
        <script data-preload="true" data-path="../pixie" src="../pixie/pixie-integrate.js"></script>
        <script src="../pixie/integrate/highlight/prism.js"></script>
        
        
 <script>
        var myPixie = Pixie.setOptions({
            replaceOriginal: true
        });
        myPixie.enableInteractiveMode();

        $('#edit-me').on('click', function(e) {
            myPixie.open({
                url: e.target.src,
                image: e.target
            });
        });
    </script>
    </body>
</html>
<?php
mysql_free_result($rsPlayerIcon);
?>
