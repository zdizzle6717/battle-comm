<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: {{logged_in_player_full.data[0].user_handle}} Profile</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../../js/mobile-toggle.js"></script>
<script type="text/javascript" src="../../js/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/magnificent-popup/magnificent-popup.css">
<link href="css/customPlayer.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "../dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
</script>
<link rel="stylesheet" type="text/css" href="../Styles/dmxAccordion.css" />
<link rel="stylesheet" type="text/css" href="../Styles/jqueryui/smoothness/jquery-ui.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery-ui-effects.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxAccordion.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
</head>
    <?php include '../Templates/parts/header.php'; ?>
        <?php include '../Templates/parts/container-top.php'; ?>
			<h2>{{logged_in_player_full.data[0].firstName}} {{logged_in_player_full.data[0].lastName}} ({{logged_in_player_full.data[0].user_handle}}) Profile</h2>
			<div class="dmxAccordion" id="dmxAccordion1" style="width:100%">
			  <h3>Personal/Contact</h3>
              <div>
                <p>              
                <table width="90%" border="0">
                  <tbody>
                    <tr>
                      <td>Address</td>
                      <td>{{logged_in_player_full.data[0].user_street_address}}-{{logged_in_player_full.data[0].user_apt_suite}}<br>
                        {{logged_in_player_full.data[0].user_city}} {{logged_in_player_full.data[0].user_state}}, {{logged_in_player_full.data[0].user_zip}}</td>
                      <td>Phone</td>
                      <td>{{logged_in_player_full.data[0].user_main_phone}}</td>
                    </tr>
                    <tr>
                      <td>Birthday</td>
                      <td>{{logged_in_player_full.data[0].user_Date_of_Birth.formatDate( "M d" )}}{{logged_in_player_full.data[0].user_Date_of_Birth}}</td>
                      <td>Mobile</td>
                      <td>{{logged_in_player_full.data[0].user_mobile_phone}}</td>
                    </tr>
                    <tr>
                      <td>Handle</td>
                      <td>{{logged_in_player_full.data[0].user_handle}}</td>
                      <td>Email</td>
                      <td>{{logged_in_player_full.data[0].email}}</td>
                    </tr>
                    <tr>
                      <td>FLGS</td>
                      <td>[Prefered Local Game Store] *coming soon*</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Icon</td>
                      <td><img src="../images/profile_image_default.png" width="222" height="218" alt=""/></td>
                      <td>[Upload/Change Icon] | [Edit Icon]</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Edit Personal Information *coming soon*</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
                <p></p>
              </div>
              <h3>About/Bio</h3>
              <div>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
              </div>
              <h3>Memberships/Roles (*coming soon)</h3>
              <div>
                <p>Tournament Admin<br>
                  Venue Admin<br>
                  Club Admin<br>
                News Editor</p>
              </div>
              <h3>My Active Tournaments</h3>
              <div>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
              </div>
              <h3>Photo Galleries (Coming Soon)</h3>
              <div>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
              </div>
			</div>
            <script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxAccordion1").dmxAccordion(
         {}
       );
     }
 );
  // ]]>
            </script>
<?php include '../Templates/parts/container-bottom.php'; ?>
<?php include '../Templates/parts/footer.php'; ?>