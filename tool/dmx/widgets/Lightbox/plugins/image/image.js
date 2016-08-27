/*
 DMXzone Lightbox
 Version: 2.0.0
 (c) 2014 DMXzone.com
 @build 04-12-2014 14:20:04
*/
DMX.Lightbox.plugins.image={canHandleContent:function(){var b=/\.(a?png|gif|jpe?g)(\?.*)?$/i;DMX.Lightbox.instance.getCurrentState();var a=DMX.Lightbox.instance.getCurrentConfig();return(a=String(a.src||""))&&b.test(a)?50:0},invoke:function(b){var a=DMX.Lightbox.instance,c=b.src,f=b.bgColor,g=b.fixPNG,d=new Image,e=a.Viewer.jQuery,h=7>DMX.IE&&g&&/\.png(\?.*)?$/i.test(c)?'<div class="dmxLightboxFrameContent" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''+c+"', sizingMethod='image');zoom:1;\"></div>":
'<img src="'+c+'" align="absmiddle" class="dmxLightboxFrameContent" />';a.errorMessage='The image at "'+c+'" could not be loaded for '+b.contentLoadTimeout+" seconds.";d.onload=function(){e("body, html").css({overflow:"hidden"});var b=e(h).css({width:this.width,height:this.height,cursor:"default","image-rendering":"optimizeSpeed","-ms-interpolation-mode":"nearest-neighbor",backgroundColor:f}).prependTo("body");a.setMetaData({width:this.width,height:this.height,keepAspect:!0});a.Viewer.showContent(b,
!0,!0,this.width,this.height,a.metaData.title||this.src,a.metaData.status||null);b.css({width:"100%",height:"100%"})};d.src=c}};
