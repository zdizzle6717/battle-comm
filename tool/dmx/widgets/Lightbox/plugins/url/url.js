/*
 DMXzone Lightbox
 Version: 2.0.0
 (c) 2014 DMXzone.com
 @build 04-12-2014 14:25:16
*/
DMX.Lightbox.plugins.url={canHandleContent:function(){return 1},invoke:function(b){var a=DMX.Lightbox.instance,c=a.Viewer.jQuery,e=a.Viewer,d=c('<iframe marginwidth="0" marginheight="0" src="javascript:void(0);" frameborder="0" hspace="0" vspace="0" scrolling="Auto" name="dmxLightbox"  onload="frameLoaded(this)" align="absmiddle" width="100%" height="100%"  class="dmxLightboxFrameContent" allowTransparency="false"></iframe>').prependTo("body");d.css({backgroundColor:b.bgColor||"#FFF"});c("body, html").css({overflow:"hidden"});
d.css({display:"block",height:"100%",width:"100%",top:-3E3,left:-3E3});void 0===b.scrollbars||b.scrollbars&&"no"!=b.scrollbars?d.attr("scrolling","auto").css("overflow","auto"):(delete a.options.scrollbars,d.attr("scrolling","no").css("overflow","hidden"));a.setMetaData({keepAspect:!1,width:a.metaData.width||1200,height:a.metaData.height||800,canBeOverlaped:!1});e.FrameObserver.add(d,"load",function(){e.showContent(d,void 0===DMX.IE,!0,a.metaData.width||1200,a.metaData.height||800,a.metaData.title||
b.src,a.metaData.status||null)},!0);c=b.src;-1!=c.indexOf("youtube.com/watch")&&(c="http://www.youtube.com/embed/"+c.replace(/^[^v]+v.(.{11})&(.*)/,"$1?$2"));d.attr("src",c);a.errorMessage='The content at "'+b.src+'" could not be loaded for '+b.contentLoadTimeout+" seconds.";a.runCommand("showProgress")}};
