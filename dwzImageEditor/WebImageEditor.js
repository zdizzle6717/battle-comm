// JavaScript Document
var dwzImageEditorDialog;

function dwzOpenImageEditor(Root, 
								ReloadPage,
								DialogWidth,
								DialogHeight,
								Bgcolor, 
								ImagePath, 
								ImageTempPath, 
								ResizeEnabled, 
								CropEnabled, 
								FlipEnabled, 
								RotateEnabled, 
								WatermarkEnabled, 
								WatermarkText, 
								WatermarkImage, 
								WatermarkImageBig, 
								WatermarkImageMedium, 
								WatermarkImageSmall, 
								FiltersEnabled, 
								LockBodyColor,
								LockBodyPercentage,
								
								ImageMaxWidth,
								ImageMaxHeight,
								ImageMinWidth,
								ImageMinHeight,
								ImageKeepAspectRatio,
								ImageJpegQuality,
								
								ResizeThumbMedium,
								ResizeThumbMediumWidth,
								ResizeThumbMediumHeight,
								ResizeThumbMediumSuffix,
								ResizeThumbMediumSuffixPosition,
								
								ResizeThumbSmall,
								ResizeThumbSmallWidth,
								ResizeThumbSmallHeight,
								ResizeThumbSmallSuffix,
								ResizeThumbSmallSuffixPosition,
								FontsList, 
								CreateIcone, 
								theme) {
		
        var page = Root + "dwzImageEditor/Container.html"
        var params = "bgcolor=" + escape(Bgcolor)
		params += "&ImagePath=" + escape(ImagePath)
        params += "&ImageTempPath=" + escape(ImageTempPath)
        params += "&ResizeEnabled=" + ResizeEnabled
        params += "&CropEnabled=" + CropEnabled
        params += "&FlipEnabled=" + FlipEnabled
        params += "&RotateEnabled=" + RotateEnabled
        params += "&WatermarkEnabled=" + WatermarkEnabled
		params += "&WatermarkText=" + WatermarkText
		params += "&WatermarkImage=" + WatermarkImage
        params += "&WatermarkImageBig=" + escape(WatermarkImageBig)
        params += "&WatermarkImageMedium=" + escape(WatermarkImageMedium)
        params += "&WatermarkImageSmall=" + escape(WatermarkImageSmall)
        params += "&FiltersEnabled=" + FiltersEnabled
        params += "&CreateIcone=" + CreateIcone
		
		//params += "&LockBodyColor=" + escape(LockBodyColor)
        //params += "&LockBodyPercentage=" + LockBodyPercentage
        
		params += "&theme=" + theme
		params += "&ImageMaxWidth=" + ImageMaxWidth
        params += "&ImageMaxHeight=" + ImageMaxHeight
        params += "&ImageMinWidth=" + ImageMinWidth
        params += "&ImageMinHeight=" + ImageMinHeight
        params += "&ImageKeepAspectRatio=" + ImageKeepAspectRatio
        params += "&ImageJpegQuality=" + ImageJpegQuality
		
        params += "&resize_thumb_m=" + ResizeThumbMedium
        params += "&resize_thumb_m_width=" + ResizeThumbMediumWidth
        params += "&resize_thumb_m_height=" + ResizeThumbMediumHeight
        params += "&resize_thumb_m_suffix=" + ResizeThumbMediumSuffix
        params += "&resize_thumb_m_suffix_pos=" + ResizeThumbMediumSuffixPosition
		
        params += "&resize_thumb_s=" + ResizeThumbSmall
        params += "&resize_thumb_s_width=" + ResizeThumbSmallWidth
        params += "&resize_thumb_s_height=" + ResizeThumbSmallHeight
        params += "&resize_thumb_s_suffix=" + ResizeThumbSmallSuffix
        params += "&resize_thumb_s_suffix_pos=" + ResizeThumbSmallSuffixPosition
		params += "&FontsList=" + FontsList
		
		var url = page + "?" + params
		//url = "about:_blank"
		var html = '<iframe frameborder="0" scrolling="no" style="width:99%;height:99%;" src="' + url + '"></iframe>'
		var w = DialogWidth
		var h = DialogHeight
		
		dwzImageEditorDialog = $('<div></div>')
			.html(html)
			.dialog({
			modal: true,
			title : "Image editor",
			width: w,
			height: h,
			close: function () {
					if(ReloadPage == "true"){
						window.location.reload();
					}	
			},
			buttons: {
				'Close': function() {
					$( this ).dialog( "close" );
				}
			}
		});	
    }
function CloseImageEditor(){
	if(dwzImageEditorDialog){
		$(dwzImageEditorDialog).dialog("close")
	}
}
