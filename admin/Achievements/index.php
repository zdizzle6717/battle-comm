<?php require_once( "../../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script><script type="text/javascript" src="../../ScriptLibrary/dmxServerAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */

  /* dmxDataSet name "achievements" */
       jQuery.dmxDataSet(
         {"id": "achievements", "url": "../../dmxDatabaseSources/achievements.php", "data": {"limit": ""}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "achievements" */
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
</script>
</head>
 <?php include '../../Templates/parts/header.php'; ?>
		<?php include '../../Templates/parts/container-top.php'; ?>
				<?php include '../../Templates/includes/user-navigation.php'; ?>
			<h2>Title Here</h2>
            <p><!-- Start Formoid form-->
<link rel="stylesheet" href="../../css/form-blue.css" type="text/css" />
<form method="post" enctype="multipart/form-data" class="formoid-default-skyblue" id="achieve" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:600px;min-width:150px"><div class="title"><h2>Add New Achievement</h2></div>
	<div class="element-input"><label class="title">Achievement Name</label><input class="large" type="text" name="input" /></div>
	<div class="element-textarea"><label class="title">Achievement Description</label><textarea class="medium" name="textarea" cols="20" rows="5" ></textarea></div>
	<div class="element-file"><label class="title">Achievement Icon</label><label class="large" ><div class="button">Choose File</div><input type="file" class="file_input" name="file" /><div class="file_text">No file selected</div></label></div>
<div class="submit"><input name="Achievement" type="submit" id="Achievement" form="achieve" formmethod="POST" value="Insert"/></div></form></p>
            
           <p> Sed orci purus, tempor nec commodo ut, tincidunt a sem. In nec imperdiet leo. Sed aliquet ut purus a commodo. Nunc facilisis quam sagittis ex cursus, consequat sodales quam accumsan. Maecenas pulvinar neque facilisis consequat maximus. Pellentesque tempor venenatis vehicula. Fusce est elit, consectetur id magna at, viverra ullamcorper nisl. Proin posuere ut ligula id aliquam. Vivamus ac tristique justo, non imperdiet neque. In vitae nisl nec lorem cursus tempus.</p>
            <p>
            Vivamus sed egestas urna. Nunc odio purus, laoreet quis sagittis vitae, imperdiet ut urna. Cras tortor ligula, ultrices non vehicula id, finibus at lacus. Etiam venenatis, felis ut elementum tincidunt, nulla lorem vulputate ante, sed volutpat quam odio quis metus. Donec mollis blandit risus vitae tincidunt. Duis sit amet congue mauris. Phasellus egestas ligula at lacus suscipit tristique.</p>
            <table width="95%" border="1">
              <tbody>
                <tr>
                  <th scope="col">Achievement Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Icon</th>
                  <th scope="col">&nbsp;</th>
                </tr>
                <tr data-binding-repeat="{{achievements.data}}" data-binding-id="repeat1">
                  <td>{{achievementName}}</td>
                  <td>{{achievementDescription}}</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
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
            
           <p> Integer at nisl sollicitudin, iaculis quam non, iaculis dui. Cras quis erat vel elit tempor faucibus. Quisque malesuada aliquam dui in cursus. Praesent eu egestas est, a pretium lorem. Proin sem diam, dapibus eu fermentum vitae, tincidunt a felis. Donec sollicitudin et augue id luctus. Etiam maximus vitae orci a efficitur. Suspendisse nec imperdiet lacus. Pellentesque vulputate erat ac ornare mattis. Aenean ligula ex, congue non ligula id, molestie mollis felis. Aliquam sem eros, mollis quis enim id, pretium lacinia leo. Etiam hendrerit eros eget sapien gravida, et molestie erat maximus. Vivamus malesuada a magna non vehicula. Maecenas maximus justo leo, in vulputate arcu volutpat ut. Maecenas et tempor dui. Cras id suscipit arcu, sed gravida enim.</p>
            
           <p> Sed quis dolor et dolor sodales placerat. Pellentesque ut consectetur neque. Etiam interdum massa nec nisl semper, et commodo quam placerat. Sed eu magna massa. Nullam dignissim pulvinar purus sed sodales. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse lobortis nec erat id varius. Aenean et dictum nulla, ac fringilla quam. Donec gravida metus orci, semper suscipit lacus fringilla fringilla. Nulla et congue dolor. Duis nec mi ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi rhoncus mauris sit amet velit semper, ut vestibulum ligula sollicitudin.</p>
 		<?php include '../../Templates/parts/container-bottom.php'; ?>   
<!-- FOOTER -->
        <div class="footer">
            <div class="sub-footer center" id="contact">
                <div class="three_column_1 subfooter_filler">
                </div>
                <div class="three_column_1 subfooter no_margin">
                    <img src="/images/Titles/Contact_Us.png" alt=""/>
    <h4 class="left">By Phone: (909) 343-5454</h4>
                    <h4 class="left">By E-mail: Contact@Battle-Comm.com</h4>
                    <h4 class="left">Address: 555 Boutel Dr.</h4>
                    <h4 class="indent left">Someplace, CA</h4>
                </div>
                <div class="three_column_1 subfooter">
                    <img src="/images/Titles/Follow_Us.png" alt=""/>
                    <?php $pathToFile = $_SERVER['DOCUMENT_ROOT'];
					include ($pathToFile. "/Templates/includes/social-links.php"); ?>
                </div>
            </div>
            <?php include ($pathToFile. "/Templates/includes/footer.php"); ?>
            <a href="#" id="backtotop" style="display: block;">
                <span class="fa fa-angle-up"></span>
                <span class="back-to-top">Top</span>
            </a>
        </div>
    <script type="text/javascript">
/* dmxServerAction name "Achievements" */
       jQuery.dmxServerAction(
         {"id": "Achievements", "url": "../../dmxConnect/api/achievements.php", "form": "#achieve", "data": {}, "onSuccess": "dmxDataBindingsAction('refresh','achievements',{});"}
       );
  /* END dmxServerAction name "Achievements" */
        </script>
</body>
	<script><?php include ($pathToFile. "/Scripts/prefixfree.min.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/mobile-toggle.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/backtotop.js"); ?></script>
</html>