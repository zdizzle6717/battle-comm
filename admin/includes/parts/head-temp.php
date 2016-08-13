<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BattleComm: Home</title>

    <script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../css/magnificent-popup/magnificent-popup.css">
    <link href="../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
	<link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
	<script src="../includes/new_post.js"></script>
    <script type="text/javascript" src="../../js/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="../../webassist/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="../../js/mobile-toggle.js"></script>
    <script type="text/javascript" src="../../js/backtotop.js"></script>
    
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
  color: #ffffff;
  background-color: #287697;
}
.WADAResultsTableWrapper {
  clear: left;
  border: 1px solid #287697;
}
.WADAResultsRowDark {
  color:table;
  background-color: #CCF0FF;
}

form.Basic_Default input.formButton.Modular.DetailButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/view_details_white.png);
}
form.Basic_Default input.formButton.Modular.DetailButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/view_details_white.png);
}
form.Basic_Default input.formButton.Modular.UpdateButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/edit_white.png);
}
form.Basic_Default input.formButton.Modular.UpdateButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/edit_white.png);
}
form.Basic_Default input.formButton.Modular.DeleteButton {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/delete_white.png);
}
form.Basic_Default input.formButton.Modular.DeleteButton:hover {
	background-repeat: no-repeat;
	background-position: center center;
	cursor:pointer;
	width:29px;
	height:29px;
	background-image:url(../../images/Icons/delete_white.png);
}
</style>
</head>
