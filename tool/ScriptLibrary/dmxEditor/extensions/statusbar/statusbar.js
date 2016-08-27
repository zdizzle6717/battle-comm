/*
 Advanced HTML Editor 3
 Version: 3.5.5
 (c) 2012 DMXzone.com
 @build 07-03-2012 12:29:40
*/
define(function(){return{id:"statusbar",element:null,init:function(a){var b=$("<div/>").attr({unselectable:"on","class":"statusbar"}).css({MozUserFocus:"ignore",position:"relative",margin:"-2px 2px 0",padding:"2px",lineHeight:"1.2em",minHeight:"1.2em"}).appendTo(a.wrapper);a.resizeUI();this.element=b[0]}}});
