/*
 DMXzone Lightbox
 Version: 2.0.0
 (c) 2014 DMXzone.com
 @build 04-12-2014 15:22:07
*/
DMX.Lightbox.plugins.flash={canHandleContent:function(){var a=DMX.Lightbox.instance.getCurrentConfig();return/\.swf(\?.*)?$/i.test(a.src)?50:0},invoke:function(){DMX.include("/dmx/lib/flashembed.js");var a=DMX.Lightbox.instance,b=a.getCurrentConfig(),c=a.Viewer.jQuery;c("body, html").css({overflow:"hidden"});var d=c('<div class="dmxLightboxFrameContent flash"/>').css({width:"100%",height:"100%"}).prependTo("body");a.setMetaData({keepAspect:!1,width:b.width||760,height:b.height||600,canBeOverlaped:!1});
a.addEventListener("loaderFinished.flashPlugin",function(){$(".rounded",a.wrapper);a.isRunning&&a.runCommand("stopSlideshow");flashembed(d[0],{src:b.src,wmode:"window",allowScriptAccess:"sameDomain"})},!0);a.errorMessage='The content at "'+b.src+'" could not be loaded for '+b.contentLoadTimeout+" seconds.";a.Viewer.showContent(d,!0,!0)}};
