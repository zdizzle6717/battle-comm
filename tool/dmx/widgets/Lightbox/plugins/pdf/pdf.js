/*
 DMXzone Lightbox
 Version: 2.0.0
 (c) 2014 DMXzone.com
 @build 04-12-2014 15:23:12
*/
DMX.Lightbox.plugins.pdf={canHandleContent:function(){var a=DMX.Lightbox.instance.getCurrentConfig();return/\.pdf(\?.*)?$/i.test(a.src)?50:0},invoke:function(){var a=DMX.Lightbox.instance,b=a.getCurrentConfig(),c=a.Viewer.jQuery;c("body, html").css({overflow:"hidden"});var d=c('<iframe marginwidth="0" marginheight="0" src="javascript:void(0);" frameborder="0" hspace="0" vspace="0" scrolling="Auto" name="dmxLightbox" class="dmxLightboxFrameContent pdf" align="absmiddle" width="100%" height="100%" allowTransparency="false"></iframe>').css({display:"block",
backgroundColor:"#FFF"}).prependTo("body");a.setMetaData({keepAspect:!1,width:b.width||3E3,height:b.height||2E3,canBeOverlaped:!1});a.addEventListener("loaderFinished.pdfPlugin",function(){a.dragable&&(a.runCommand("makeUndragable"),a.addEventListener("contentRemoved.pdfPlugin",function(){a.runCommand("makeDragable")},!0));a.isRunning&&a.runCommand("stopSlideshow");d.attr("src",b.src)},!0);a.errorMessage='The content at "'+b.src+'" could not be loaded for '+b.contentLoadTimeout+" seconds.";a.Viewer.showContent(d,
!0,!0,a.metaData.width||1200,a.metaData.height||800,a.metaData.title||b.src,a.metaData.status||null)}};
