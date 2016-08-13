/*
 Advanced HTML Editor 3
 Version: 3.5.6
 (c) 2012 DMXzone.com
 @build 07-03-2012 13:29:40
*/
define(["statusbar/statusbar"],function(){return{id:"resizer",dep:["statusbar"],init:function(a,g){var f=$.extend({heightOnly:!1},a.options.resizer||{}),d=$('<span class="resizer" unselectable="on">&nbsp;</span>').css({height:15,width:15,position:"absolute",bottom:2,right:0,cursor:"se-resize",background:"url('"+$.dmxEditor.basePath+"dmxEditor/extensions/resizer/resize.png') right 3px no-repeat"}).appendTo(this.statusbar.element),b=$(".resize-helper-overlay",a.wrapper);0===b.length&&(b=$('<div class="resize-helper-overlay"/>').css({position:"absolute",
top:0,left:0,width:"100%",height:"100%",zIndex:1E4,cursor:"se-resize"}).hide().appendTo(a.wrapper),$.support.opacity||b.css({backgroundColor:"#888",opacity:.01}));b.bind("mouseup.resizeeditor",function(a){$(this).unbind("mousemove.resizeeditor").hide()});d.bind("mousedown.resizeeditor",function(e){if(!a.wrapper.hasClass("fullscreen")){var c=$(a.wrapper).offset();c.left-=$(a.wrapper).outerWidth()+c.left-e.clientX;c.top-=$(a.wrapper).outerHeight()+c.top-e.clientY;$(a.wrapper).css({height:"auto"});b.bind("mousemove.resizeeditor",
function(b){a.resizeTo(f.heightOnly?null:b.clientX-c.left,b.clientY-c.top)}).show()}return!1});$(a.frame).bind("editor:enterfullscreen",function(a){d.hide()}).bind("editor:leavefullscreen",function(a){d.show()});a.resizeUI()}}});
