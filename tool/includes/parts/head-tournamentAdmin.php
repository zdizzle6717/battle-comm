<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/magnificent-popup/magnificent-popup.css">
<link href="../admin_temp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../webassist/jq_validation/Modular.css">
<link type="text/css" href="../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../js/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../../js/mobile-toggle.js"></script>
<script type="text/javascript" src="../../js/backtotop.js"></script>
<script type="text/javascript">
$(function(){
	$('#tournament_startDate').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_tournament_startDate
	});
});
function closeDatePicker_tournament_startDate() {
	var tElm = $('#tournament_startDate');
	if (typeof tournament_startDate_Spry != null && typeof tournament_startDate_Spry != "undefined" && tournament_startDate_Spry.validate) {
		tournament_startDate_Spry.validate();
	}
	tElm.blur();
}
</script><link type="text/css" href="../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
$(function(){
	$('#Tournament_endDate').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_Tournament_endDate
	});
});
function closeDatePicker_Tournament_endDate() {
	var tElm = $('#Tournament_endDate');
	if (typeof Tournament_endDate_Spry != null && typeof Tournament_endDate_Spry != "undefined" && Tournament_endDate_Spry.validate) {
		Tournament_endDate_Spry.validate();
	}
	tElm.blur();
}
</script>
<style>

form.DetailsPage {
    width: auto;	
}
.WADAResults, .WADANoResults {
  border-top-width: 1px;
  border-top-style: solid;
  border-top-color: #BABDC2;
}
.WADAResultsNavigation {
  padding-top: 5px;
  padding-bottom: 10px;
}
.WADAResultsCount {
  font-size: 11px;
}
.WADAResultsNavTop, .WADAResultsInsertButton {
  clear :none;
}
.WADAResultsNavTop, WADAResultsNavBottom {
  width: 60%;
  float: left;
}
div.WADAResultsInsertButton {
  width: 30%;
  float: right;
  text-align: right;
}
.WADAResultsNavButtonCell, .WADAResultsInsertButton {
  padding-top: 2px;
  padding-right: 2px;
  padding-bottom: 2px;
  padding-left: 2px;
}
.WADAResultsTable {
  font-size: 11px;
  clear: both;
  padding-top: 1px;
  padding-bottom: 1px;
}
.WADAResultsTableHeader {
  text-align: left;
  padding-left: 13px;
  padding-right: 13px;
}
.WADAResultsTableCell {
  text-align: left;
  padding-left: 14px;
  padding-right: 14px;
}
.WADAResultsEditButtons {
  text-align: right;
  border-right-width: 1px;
  border-right-style: solid;
  border-right-color: #BABDC2;
  border-left-width: 1px;
  border-left-style: solid;
  border-left-color: #BABDC2;
}

form .WADAResultsContainer input.formButton.ResultsNavButton {
  margin: 2px 0;
  padding: 2px;
  -moz-border-radius: 6px;
  -webkit-border-radius: 6px;
  -khtml-border-radius: 6px;
  border-radius: 6px;
  outline: 0;
}

form .WADAResultsContainer input.formButton.ResultsPageButton {
  margin: 2px;
  padding: 0;
  -moz-border-radius: 6px;
  -webkit-border-radius: 6px;
  -khtml-border-radius: 6px;
  border-radius: 6px;
  outline:0;
}

.WADAResultThumbArea {
	float:left;
}
.WADAResultInfoArea {
	margin-left: 170px;
}
.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}
.messageContainer {
	display: none;
	position: absolute;
	top:0;
	width: 100%;
	z-index:1002;
	text-align:center;
	height:100%;
	#position: relative;
	overflow: hidden;
}
.messageWrapper {
	#position: absolute; 
	#top: 50%;
	display: table-cell; 
	vertical-align: middle;	
}
.messageContent {
	background-color:white;
    display: inline-block;
	padding: 16px;
	border: 16px solid grey;
	z-index:1002;
	overflow: auto;
	margin: auto;
	#position: relative; 
	#top: -50%;
}
.WADAResultsTable th{
  color: #FFFFFF;
  background-color: #262626;
}
.WADAResultsTableWrapper {
  clear: left;
  border: 1px solid #262626;
}
.WADAResultsRowDark {
  color:table;
  background-color: #E5E5E5;
}

form.Basic_Default input.formButton.Dark.DetailButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../images/Icons/view_details_white.png), url(../webassist/forms/gradient.php?from=262626&to=3E3E3E);
	background-image:url(../images/Icons/view_details_white.png),  -moz-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/view_details_white.png),  -o-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/view_details_white.png),  -webkit-linear-gradient(#262626, #3E3E3E);
	
	background-image:url(../images/Icons/view_details_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #262626), color-stop(1, #3E3E3E));
	
	background-image:url(../images/Icons/view_details_white.png),  linear-gradient(top, #262626, #3E3E3E);
	filter:none;
}
form.Basic_Default input.formButton.Dark.DetailButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}


form.Basic_Default input.formButton.Dark.UpdateButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../images/Icons/edit_white.png), url(../webassist/forms/gradient.php?from=262626&to=3E3E3E);
	background-image:url(../images/Icons/edit_white.png),  -moz-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/edit_white.png),  -o-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/edit_white.png),  -webkit-linear-gradient(#262626, #3E3E3E);
	
	background-image:url(../images/Icons/edit_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #262626), color-stop(1, #3E3E3E));
	
	background-image:url(../images/Icons/edit_white.png),  linear-gradient(top, #262626, #3E3E3E);
	filter:none;
}
form.Basic_Default input.formButton.Dark.UpdateButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}


form.Basic_Default input.formButton.Dark.DeleteButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../images/Icons/delete_white.png), url(../webassist/forms/gradient.php?from=262626&to=3E3E3E);
	background-image:url(../images/Icons/delete_white.png),  -moz-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/delete_white.png),  -o-linear-gradient(top, #262626, #3E3E3E);
	
	background-image:url(../images/Icons/delete_white.png),  -webkit-linear-gradient(#262626, #3E3E3E);
	
	background-image:url(../images/Icons/delete_white.png),  -webkit-gradient(linear,left top, left bottom, color-stop(0, #262626), color-stop(1, #3E3E3E));
	
	background-image:url(../images/Icons/delete_white.png),  linear-gradient(top, #262626, #3E3E3E);
	filter:none;
}
form.Basic_Default input.formButton.Dark.DeleteButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	}

/* Details page CSS */
form.DetailsPage {
    width: auto;	
}

.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}
.messageContainer {
	display: none;
	position: absolute;
	top:0;
	width: 100%;
	z-index:1002;
	text-align:center;
	height:100%;
	#position: relative;
	overflow: hidden;
}
.messageWrapper {
	#position: absolute; 
	#top: 50%;
	display: table-cell; 
	vertical-align: middle;	
}
.messageContent {
	background-color:white;
    display: inline-block;
	padding: 16px;
	border: 16px solid grey;
	z-index:1002;
	overflow: auto;
	margin: auto;
	#position: relative; 
	#top: -50%;
}
</style>
<!--[if lte ie 8]>
<style>

form.Basic_Default input.formButton.Dark.DetailButton {
	background-image:url(../images/Icons/view_details_white.png);
	background-color:#262626
}
form.Basic_Default input.formButton.Dark:hover.DetailButton {
	}

form.Basic_Default input.formButton.Dark.UpdateButton {
	background-image:url(../images/Icons/edit_white.png);
	background-color:#262626
}
form.Basic_Default input.formButton.Dark:hover.UpdateButton {
	}

form.Basic_Default input.formButton.Dark.DeleteButton {
	background-image:url(../images/Icons/delete_white.png);
	background-color:#262626
}
form.Basic_Default input.formButton.Dark:hover.DeleteButton {
	}
</style>
<![endif]-->
<link type="text/css" href="../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#tournament_startDate').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_tournament_startDate
	});
});
function closeDatePicker_tournament_startDate() {
	var tElm = $('#tournament_startDate');
	if (typeof tournament_startDate_Spry != null && typeof tournament_startDate_Spry != "undefined" && tournament_startDate_Spry.validate) {
		tournament_startDate_Spry.validate();
	}
	tElm.blur();
}
</script>
<link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>