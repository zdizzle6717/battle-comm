<?php require_once('../ScriptLibrary/incPureUpload.php'); ?>
<?php 
//*** Pure PHP File Upload 3.1.0
// Process form newTournament
$ppu = new pureFileUpload();
$ppu->nameConflict = "over";
$ppu->storeType = "path";
$ppu->progressBar = "speedometer.htm";
$ppu->progressWidth = 400;
$ppu->progressHeight = 200;
$ppu->path = "../uploads/tournament";
$ppu->allowedExtensions = "GIF,JPG,JPEG,BMP,PNG"; // "images"
$ppu->redirectUrl = "";
$ppu->checkVersion("3.1.0");
$ppu->doUpload();
if ($ppu->done) {
  $_POST["undefined"] = undefined;
  $_POST["undefined"] = undefined;
}
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Create New Tournament</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link href="../css/style_form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../Styles/dmxCalendar2.css" />
<link rel="stylesheet" type="text/css" href="../../Styles/jqueryui/black-tie/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="../../Styles/dmxTimepicker.css" />
<link rel="stylesheet" type="text/css" href="../Styles/jqueryui/black-tie/black-tie.css" />
<link rel="stylesheet" type="text/css" href="../../Styles/dmxEditor.css" />
<script type="text/javascript" src="../../ScriptLibrary/require.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxBootstrap3Navigation.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/jquery-ui-effects.min.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxCalendar2.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/jquery.ui.slider.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxTimepicker.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "Locations" */
       jQuery.dmxDataSet(
         {"id": "Locations", "url": "../dmxDatabaseSources/venue.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Locations" */

  /* dmxDataSet name "states" */
       jQuery.dmxDataSet(
         {"id": "states", "url": "../dmxDatabaseSources/state.php", "data": {"limit": "50"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "states" */
</script>
<script type="text/javascript"><?php echo $ppu->generateScriptCode() ?></script>
<script src="../ScriptLibrary/incPU3.js" type="text/javascript"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxEditor.min.js"></script>
</head>

<body data-spy="scroll" data-target=".nav-container">
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="nav-container container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs3-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#">Battle-Comm.com</a></div>
    <div class="collapse navbar-collapse" id="bs3-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Messages</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--/Static navbar --> 

<!-- Container -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="TTWForm-container">
      
      
     <div id="form-title" class="form-title field">
          <h2>
               Create New Tournament
          </h2>
     </div>
      
      
     <form action="<?php echo $DMX_uploadAction ?>"
     method="post" enctype="multipart/form-data" name="newTournament" class="TTWForm ui-sortable-disabled" novalidate onSubmit="<?php echo $ppu->getSubmitCode() ?>;return document.MM_returnValue">
       <?php echo $ppu->getProgressField() ?>
       <div id="field1-container" class="field f_100">
         <label for="field1"> Tournament Name or Title </label>
         <input name="tournament_name" id="field1" type="text">
       </div>
       <div id="field2-container" class="field f_100 ">
         <label for="field2"> Upload Logo or Icon </label>
         <input name="tournament_logo_icon" type="file" id="field2" onChange="<?php echo $ppu->getValidateCode() ?>;return document.MM_returnValue">
       </div>
       <div id="field3-container" class="field f_50 ">
         <label for="field3"> Start Date </label>
         <input class="dmxCalendar2" name="dmxCalendar21" id="dmxCalendar21" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxCalendar21").dmxCalendar2(
         {"altFormat": "yy-mm-dd", "condDates": [], "firstDay": 1, "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "yearRange": "c-10:c+10", "extensions": ["DMXzoneTimepicker"]}
       );
     }
 );
  // ]]>
</script>
       </div>
       <div id="field4-container" class="field f_50 ">
         <label for="field4"> Start Time </label>
         <input class="dmxTimepicker" name="dmxTimepicker1" id="dmxTimepicker1" />
         <script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxTimepicker1").dmxTimepicker(
         {"ampm": true, "timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "showTime": false}
       );
     }
 );
  // ]]>
       </script>
       </div>
       <div id="field5-container" class="field f_50 ">
         <label for="field5"> End Date </label>
         <input class="dmxCalendar2" name="dmxCalendar22" id="dmxCalendar22" />
         <script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxCalendar22").dmxCalendar2(
         {"altFormat": "yy-mm-dd", "condDates": [], "firstDay": 1, "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "yearRange": "c-10:c+10", "extensions": ["DMXzoneTimepicker"]}
       );
     }
 );
  // ]]>
       </script>
       </div>
       <div id="field7-container" class="field f_50 ">
         <label for="field7"> End Time </label>
         <input class="dmxTimepicker" name="dmxTimepicker2" id="dmxTimepicker2" />
         <script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxTimepicker2").dmxTimepicker(
         {"ampm": true, "timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "showTime": false}
       );
     }
 );
  // ]]>
       </script>
       </div>
       <!--<div id="field8-container" class="field f_100 ">
         <label for="field8"> Tournament Location (if already in the system) </label>
         <select name="field8" id="field8" data-binding-repeat-children="{{Locations.data}}" data-binding-id="field8">
           <option value="{{venue_Name}}"></option>
         </select>
       </div>-->
       <div id="field27-container" class="field f_100 ">
         <label for="field27"> Location Name </label>
         <input name="tournament_location_name" id="field27" required
               type="text">
       </div>
       <div id="field22-container" class="field f_100 ">
         <label for="field22"> Street Address </label>
         <input name="tournament_street" id="field22" type="text">
       </div>
       <div id="field23-container" class="field f_100 ">
         <label for="field23"> City </label>
         <input name="tournament_city" id="field23" type="text">
       </div>
       <div id="field24-container" class="field f_25 ">
         <label for="field24"> State </label>
         <select name="tournament_state" id="field24" data-binding-repeat-children="{{states.data}}" data-binding-id="field24">
           <option value="{{state_abbr}}">{{state_abbr}}</option>
         </select>
       </div>
       <div id="field25-container" class="field f_25 ">
         <label for="field25"> Zip Code </label>
         <input name="tournament_zip" id="field25" type="text">
       </div>
       <div id="field26-container" class="field f_25 ">
         <label for="field26"> Main Phone Number </label>
         <input name="tournament_phone" id="field26" type="text">
       </div>
       <div id="field11-container" class="field f_50 ">
         <label for="field11"> Primary Email Address </label>
         <input name="tournament_email" id="field11" type="email">
       </div>
       <div id="field12-container" class="field f_50 ">
         <label for="field12"> Tournament Website </label>
         <input name="tournament_URL" id="field12" type="url">
       </div>
       <div id="field13-container" class="field f_100 ">
         <label for="field13"> Tournament Information </label>
         <textarea id="tournament_info" name="tournament_info" class="dmxEditor" style="width:800px;height:500px"></textarea>
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#tournament_info").dmxEditor(
         {"width": 800, "height": 500, "bgColor": "#D0CFCF", "allowUpload": true, "uploadPath": "../uploads/tournament", "subFolder": "<?php echo((isset($_POST["tournament_name"]))?$_POST["tournament_name"]:"") ?>", "uploadProcessor": "php", "extensions": ["resizer"]}
       );
     }
 );
  // ]]>
</script>
       </div>
       <div id="field21-container" class="field f_25 ">
         <label for="field21"> Number of Rounds </label>
         <input name="tournament_rounds" type="number" id="field21" max="100" min="1" step="1">
       </div>
       <div id="form-submit" class="field f_100 clearfix submit">
         <input value="Submit" type="submit">
       </div>
     </form>
</div>
    </div>
  </div>
</div>
<!-- /.container -->
</body>
</html>
