// JavaScript Document

var NONE = 0;
var op_Undo = 1;
var op_Resize = 2;
var op_Crop = 3;
var op_Rotate = 4;
var op_FlipH = 5;
var op_FlipV = 6;
var op_WatermarkText = 7;
var op_Invert = 8;
var op_Greyscale = 9;
var op_Brightness = 10;
var op_Contrast = 11;
var op_Gamma = 12;
var op_Color = 13;
var op_Smooth = 14;
var op_GaussianBlur = 15;
var op_MeanRemoval = 16;
var op_Sharpen = 17;
var op_EmbossLaplacian = 18;
var op_EdgeDetectQuick = 19;
var op_Confirm = 20;
var op_DeleteTempImages = 21;
var op_WatermarkImage = 22;
var op_SelectiveBlur = 23;
var op_Icone = 24;

var postData = ""
var current_operation = NONE
var image_index = 0;
var max_image_index = 0;
var must_close = false;
var temp_file_deleted = false;
var async_request = true;
var icones = new Array();
var dialog;

var sliderEnabled = true;
var sliderDivName = ["divParameterSlider_1"];
var txtSliderTextBox = ["txtParam"];
var sliderMinValue = 0.0;
var sliderMaxValue = 255.0;
var sliderStep = 5.0;
var sliderValue = 0.0;

function Init() {
    $("BODY").css("background-color", bgcolor);
    LoadImage()
}

$(window).unload(function () {
    if (!temp_file_deleted && image_index > 0) {
        postData = "AjaxRequest=y"
        postData += "&Operation=" + op_DeleteTempImages
        async_request = false
        SendRequest()
    }
});



function SendRequest() {
    if (image_index == 0) {
        postData += "&ImageSource=" + image_path;
    } else {
        postData += "&ImageSource=" + image_path_temp + image_name_temp.replace(/#image_index#/, image_index);
    }
	
    image_index++
    max_image_index = image_index
    if (current_operation == op_Confirm) {
        postData += "&image_path=" + image_path
    }
	var image_destination = image_path_temp + image_name_temp.replace(/#image_index#/, image_index);
    postData += "&ImageDestination=" + image_destination;
	var icone_path = image_destination + ".ico"
	
    postData += "&image_path_temp=" + image_path_temp
    postData += "&max_image_index=" + max_image_index

    postData += "&resize_thumb_m=" + resize_thumb_m
    postData += "&resize_thumb_m_width=" + resize_thumb_m_width
    postData += "&resize_thumb_m_height=" + resize_thumb_m_height
    postData += "&resize_thumb_m_suffix=" + resize_thumb_m_suffix
    postData += "&resize_thumb_m_suffix_pos=" + resize_thumb_m_suffix_pos

    postData += "&resize_thumb_s=" + resize_thumb_s
    postData += "&resize_thumb_s_width=" + resize_thumb_s_width
    postData += "&resize_thumb_s_height=" + resize_thumb_s_height
    postData += "&resize_thumb_s_suffix=" + resize_thumb_s_suffix
    postData += "&resize_thumb_s_suffix_pos=" + resize_thumb_s_suffix_pos

    postData += "&ImageKeepAspectRatio=" + image_keep_aspect_ratio
	postData += "&ImageJpegQuality=" + image_jpeg_quality

    postData += "&watermark_image_big=" + watermark_image_big
    postData += "&watermark_image_medium=" + watermark_image_medium
    postData += "&watermark_image_small=" + watermark_image_small
    
	icones[image_index] = "";
	
	/*
	http://localhost/dwzImageEditor/FrmImageEditor.php?AjaxRequest=y&Operation=20&ImageSource=/public/temp/dwz_a1ejf6l7279unmsfo2he7mojk1_1_dwz_Aquila.jpg&image_path=/public/Aquila.jpg&ImageDestination=/public/temp/dwz_a1ejf6l7279unmsfo2he7mojk1_2_dwz_Aquila.jpg&image_path_temp=/public/temp/&max_image_index=2&resize_thumb_m=true&resize_thumb_m_width=150&resize_thumb_m_height=150&resize_thumb_m_suffix=_m&resize_thumb_m_suffix_pos=2&resize_thumb_s=true&resize_thumb_s_width=75&resize_thumb_s_height=75&resize_thumb_s_suffix=_s&resize_thumb_s_suffix_pos=2&ImageKeepAspectRatio=true&ImageJpegQuality=80&watermark_image_big=/public/watermarkBIG.png&watermark_image_medium=/public/watermarkMedium.png&watermark_image_small=/public/watermarkSmall.png
	http://localhost/dwzImageEditor/FrmImageEditor.php?AjaxRequest=y&Operation=24&ImageSource=/public/Aquila.jpg&ImageDestination=/public/temp/dwz_nms28m6lq4deflika3sts86jq3_1_dwz_Aquila.jpg&image_path_temp=/public/temp/&max_image_index=1&resize_thumb_m=true&resize_thumb_m_width=150&resize_thumb_m_height=150&resize_thumb_m_suffix=_m&resize_thumb_m_suffix_pos=2&resize_thumb_s=true&resize_thumb_s_width=75&resize_thumb_s_height=75&resize_thumb_s_suffix=_s&resize_thumb_s_suffix_pos=2&ImageKeepAspectRatio=true&ImageJpegQuality=80&watermark_image_big=/public/watermarkBIG.png&watermark_image_medium=/public/watermarkMedium.png&watermark_image_small=/public/watermarkSmall.png&Ico_16=true&Ico_24=true&Ico_32=true&Ico_48=true&Ico_96=true&Ico_128=true&IconeName=myname
	*/
	
	//prompt("", "http://localhost/dwzImageEditor/FrmImageEditor.php?" + postData)

    var urlPage = "FrmImageEditor.php"
    $.ajax({
        url: urlPage,
        dataType: "text",
        data: postData,
        type: "POST",
        cache: false,
        complete: function (XMLHttpRequest, textStatus) {
			if (XMLHttpRequest.status.toString() != "200" && textStatus.toLowerCase().indexOf('error') != -1) {
                win = window.open("")
                if (win) {
                    win.document.open()
                    win.document.write(XMLHttpRequest.responseText)
                    win.document.close()
                } else {
                    alert(XMLHttpRequest.responseText)
                }
            }else{
				if(postData.indexOf("Operation=24") != -1){
					icones[image_index] = icone_path;
				}
			}			
			/*
			var tmp = XMLHttpRequest.responseText.split(";")
			image_width = parseInt(tmp[0])
			image_height = parseInt(tmp[1])
			*/
            setTimeout("UnLockBody()", 250)
        },
        async: async_request
    });
}

function Close() {
    if (image_index == 0) {
		parent.CloseParent()
        //top.close()
    } else {
        must_close = true;
        postData = "AjaxRequest=y"
        postData += "&Operation=" + op_DeleteTempImages
        temp_file_deleted = true
        LockBody()
    }
}

function Save() {
    if (image_index == 0) {
        alert("Nothing to save")
        return
    }
    must_close = true;
    postData = "AjaxRequest=y"
    postData += "&Operation=" + op_Confirm
    current_operation = op_Confirm
    LockBody()
}



function ApplyFilter(combo) {
    var filter = combo.options[combo.selectedIndex].value
    if (filter.length == 0) {
        return
    }
    var form = ""

	sliderDivName = ["divParameterSlider_1"];
	txtSliderTextBox = ["txtParam"];
	sliderMinValue = 0.0;
	sliderMaxValue = 255.0;
	sliderStep = 5.0;
	sliderValue = 0.0;

    /*
    10 Brightness(int nBrightness)
    11 Contrast(sbyte nContrast)
	
    12 Gamma(double red, double green, double blue)
	
    13 Color( int red, int green, int blue)
	
    14 Smooth(int nWeight  default to 1 )
    15 GaussianBlur(int nWeight  default to 4)
    16 MeanRemoval(int nWeight  default to 9 )	
    17 Sharpen( int nWeight default to 11 )
    */
    var dialogWidth = 0;
    var dialogHeight = 0
	var minValue = 0.0;
    var maxValue = 0.0;
	var defaultValue = "";
	var dialogTitle = "Parameter"
    //var dialogArgs = new Object()
    //dialogArgs.Default = ""
    current_operation = filter
    switch (filter) {
        case "8":
        case "9":
        case "18":
        case "19":
		case "15":
		case "16":
		case "23":
            break;
        case "10":
        case "11":
        case "14":
			dialogTitle = "Parameter"
            if (filter == 11) {
                minValue = "-100"
                maxValue = "100"
				sliderMinValue = parseFloat(minValue);
				sliderMaxValue = parseFloat(maxValue);
            }
            if (filter == 10) {
                minValue = "-255"
                maxValue = "255"
				sliderMinValue = parseFloat(minValue);
				sliderMaxValue = parseFloat(maxValue);
            }
            defaultValue = 1
			div = "divParameter"
            form = "Parameter.html"
            dialogWidth = 250;
            dialogHeight = 140;
            break;                   
                   
        case "17":
			dialogTitle = "Parameter"
            defaultValue = 11
            form = "Parameter.html"
			div = "divParameter"
            dialogWidth = 250;
            dialogHeight = 140;
            break;
        case "12":
			dialogTitle = "Gamma"
            form = "Gamma.html"
			div = "divGamma"
            dialogWidth = 250;
            dialogHeight = 180;
			sliderDivName = ["divGammaSlider_1","divGammaSlider_2","divGammaSlider_3"];
			txtSliderTextBox = ["txtGammaRed","txtGammaGreen","txtGammaBlue"];
			sliderMinValue = 0.2;
			sliderMaxValue = 5.1;
			sliderStep = 0.1;
			sliderValue = 1.0;
            break;
        case "13":
			dialogTitle = "Color"
            form = "Color.html"
			div = "divColor"
            dialogWidth = 250;
            dialogHeight = 200;
			sliderDivName = ["divColorSlider_1","divColorSlider_2","divColorSlider_3"];
			txtSliderTextBox = ["txtColorRed","txtColorGreen","txtColorBlue"];
			sliderMinValue = -255;
			sliderMaxValue = 255;
			sliderStep = 5;
			sliderValue = 0;
            break;
    }

    if (form != "") {
		
		$( "#" + div ).dialog({
			title: dialogTitle,
			autoOpen: true,
			resizable:false,
			height: dialogHeight,
			width: dialogWidth,
			modal: true,
			buttons: {
				"Confirm": function(event){
					event.preventDefault();
					var result = false
					var oReturn = {};
					
					switch (filter) {
						case "13":	//color
							var re = new RegExp(/^[-]*[\d]+$/)
			                    var red = $(this).dialog().find("#txtColorRed").val();
			                    var green = $(this).dialog().find("#txtColorGreen").val();
			                    var blue = $(this).dialog().find("#txtColorBlue").val();
														
							if(red.length == 0){
								alert("Insert the Red value")
								return;
							}	
							if(!re.test(red)){
								alert("The Red value is not valid")
								return
							}
							if(parseInt(red) > 255 || parseInt(red) < -255){
								alert("The Red value is not valid")
								return
							}
							
							if(green.length == 0){
								alert("Insert the Green value")
								return;
							}
							if(!re.test(green)){
								alert("The Green value is not valid")
								return
							}
							if(parseInt(green) > 255 || parseInt(green) < -255){
								alert("The Green value is not valid")
								return
							}
														
							if(blue.length == 0){
								alert("Insert the Blue value")
								return;
							}
							if(!re.test(blue)){
								alert("The Blue value is not valid")
								return
							}
							if(parseInt(blue) > 255 || parseInt(blue) < -255){
								alert("The Blue value is not valid")
								return
							}
							oReturn["Red"] = red
							oReturn["Green"] = green
							oReturn["Blue"] = blue
							result = true
						break;
						case "10":
						case "11":
						case "14":
						case "17":
						var param = $( this ).dialog().find( "#txtParam" ).val();
						if (param.length == 0) {
							alert("Insert the parameter value")
							return;
						}
			
						if (minValue != 0 && parseInt(param) < minValue) {
							alert("The parameter value must be min. " + minValue)
							return;
						}
			
						if (maxValue != 0 && parseInt(param) > maxValue) {
							alert("The parameter value must be max. " + maxValue)
							return;
						}
			
						
						oReturn["Valore"] = param
						result = true
						break;
						case "12":
			                    var red = $(this).dialog().find("#txtGammaRed").val();
			                    var green = $(this).dialog().find("#txtGammaGreen").val();
								var blue = $(this).dialog().find("#txtGammaBlue").val();
						
						var re = new RegExp(/^\d\.?\d*$/)
                        
						if (red.length == 0) {
							alert("Insert the input gamma value")
							return;
						}
						if (red.substring(0, 1) == ".") {
							red = "0" + red
						}
						if (!re.test(red)) {
							alert("The input gamma value is not valid")
							return
						}
			
						if (parseFloat(red) > 5.0 || parseFloat(red) < 1.0) {
							alert("The input gamma value is not valid (from 1 to 5)")
							return
						}
			
						if (green.length == 0) {
							alert("Insert the output gamma value")
							return;
						}
						if (green.substring(0, 1) == ".") {
							green = "0" + green
						}
						if (!re.test(green)) {
							alert("The output gamma value is not valid (from 1 to 5)")
							return
						}
						if (parseFloat(green) > 5.0 || parseFloat(green) < 1.0) {
							alert("The output gamma value is not valid (from 1 to 5)")
							return
						}
						oReturn['InputGamma'] = red
			            oReturn['OutputGamma'] = green
						result = true
						break;
					}
										
					if(result){
						postData = "AjaxRequest=y"
						postData += "&Operation=" + current_operation
						for (var a in oReturn) {
							postData += "&" + a + "=" + oReturn[a]
						}
						$( this ).dialog( "close" );
						LockBody()
						combo.selectedIndex = 0
					}
				},
				Cancel: function() {					
					$( this ).dialog().find( "form" )[0].reset();
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				combo.selectedIndex = 0
			}
		});
		
		if(sliderEnabled){
			for(var x=0; x<sliderDivName.length; x++){
				$("#" + sliderDivName[x]).slider({				
					step: sliderStep,
					min : sliderMinValue,
					max: sliderMaxValue,
					value: sliderValue,
					slider_index: x,
					slide: function( event, ui ) {
						var index = parseInt($(this).slider("option").slider_index)
						$("#" + txtSliderTextBox[index]).prop("value", ui.value);
					}
				});
				
				$("#" + txtSliderTextBox[x]).prop("value", sliderValue);
				$("#" + txtSliderTextBox[x]).attr("slider_index", x)
				
				$("#" + txtSliderTextBox[x]).bind( "keyup", function() {
					var index = parseInt($(this).attr("slider_index"))
					var objSlider = $("#" + sliderDivName[index]).slider()
					 
					if(objSlider){
						var val = $(this).prop("value");
						var re = new RegExp(/^[\-\.\d]+$/)
						if(!re.test(val)){
							val = 0
							$(this).prop("value", val)
						}
						val = parseFloat(val);
						var options = $(objSlider).slider("option")
						if(parseFloat(options.max) < val){
							val = options.max
							 $(this).prop("value", val)
						}
						if(parseFloat(options.min) > val){
							val = options.min
							$(this).prop("value", val)
						}					
						$(objSlider).slider("value", val)					
					}
				});
			}
		}
		
		/*
		
        var oReturn = window.showModalDialog(form, dialogArgs, "dialogWidth:" + dialogWidth + "px;dialogHeight:" + dialogHeight + "px;help:no;scroll:no;status:no;resizable:no");
        if (!oReturn) {
            return
        }

        postData = "AjaxRequest=y"
        postData += "&Operation=" + current_operation
        for (var a in oReturn) {
            postData += "&" + a + "=" + oReturn[a]
        }
		*/
    } else {
        /*
        if (!confirm("Confirm the selected operation?")) {
        return
        }
        */
        postData = "AjaxRequest=y"
        postData += "&Operation=" + current_operation
		LockBody()
		combo.selectedIndex = 0
    }
    //

    //
}


function Redo() {
    if (max_image_index == 0 || max_image_index <= image_index) {
        alert("Nothing to Redo")
        return;
    }
    image_index++
    LoadImage()
}

function Undo() {
    if (image_index < 1) {
        alert("Nothing to Undo")
        return;
    }

    image_index--
    LoadImage()
}

function Resize() {
    var dialogWidth = 270;
    var dialogHeight = 230;
	/*
    var dialogArgs = new Object()
    dialogArgs.CurrentWidth = image_width
    dialogArgs.CurrentHeight = image_height
    dialogArgs.MinWidth = image_min_width
    dialogArgs.MinHeight = image_min_height
    dialogArgs.MaxWidth = image_max_width
    dialogArgs.MaxHeight = image_max_height
    dialogArgs.KeepAspectRatio = image_keep_aspect_ratio
    dialogArgs.bgcolor = bgcolor
	*/
	
	dialog = $( "<div></div>" )
			.html($( "#divResize").html())
			.dialog({
			title: "Resize",
			autoOpen: true,
			resizable:false,
			height: dialogHeight,
			width: dialogWidth,
			modal: true,
			buttons: {
				"Confirm": function(event){
					event.preventDefault();
					var result = true
					var oReturn = {};
					
					var re = new RegExp(/^\d+$/)
					var width = $( this ).dialog().find( "#txtWidth" ).val()
					var height = $( this ).dialog().find( "#txtHeight" ).val()
					
					if (width.length == 0) {
						alert("Insert the Width value")
						return;
					}
					if (!re.test(width)) {
						alert("The Width value is not valid")
						return
					}
					if (image_min_width > 0 && parseInt(width) < image_min_width) {
						alert("The minimum Width is " + image_min_width)
						return;
					}
					if (image_max_width > 0 && parseInt(width) > image_max_width) {
						alert("The maximum Width is " + image_max_width)
						return;
					}
		
					if (height.length == 0) {
						alert("Insert the Height value")
						return;
					}
					if (!re.test(height)) {
						alert("The Green Height is not valid")
						return
					}
					if (image_min_height > 0 && parseInt(height) < image_min_height) {
						alert("The minimum Height is " + image_min_height)
						return;
					}
					if (image_max_height > 0 && parseInt(height) > image_max_height) {
						alert("The maximum Height is " + image_max_height)
						return;
					}
		
					oReturn['Width'] = width
					oReturn['Height'] = height
															
					if(result){
						postData = "AjaxRequest=y"
						postData += "&Operation=" + op_Resize
						for (var a in oReturn) {
							postData += "&" + a + "=" + oReturn[a]
						}
						$( this ).dialog( "close" );
						LockBody()						
					}
				},
				Cancel: function() {					
					$( this ).dialog().find( "form" )[0].reset();
					$( this ).dialog( "close" );
				}
			},
			open: function(){
				$( this ).dialog().find("#tdCurrentWidth").html(image_width)
				$( this ).dialog().find("#tdCurrentHeight").html(image_height)
				
				$( this ).dialog().find("#txtWidth")
					.val("")
					.on( "blur", function() {						
						ChangeSizes("W")
					});
				$( this ).dialog().find("#txtHeight")
					.val("")
					.on( "blur", function() {						
						ChangeSizes("H")
					});				
			},
			close: function() {
				dialog = null				
			}
		});
		
	/*
    var oReturn = window.showModalDialog("Resize.html", dialogArgs, "dialogWidth:" + dialogWidth + "px;dialogHeight:" + dialogHeight + "px;help:no;scroll:no;status:no;resizable:no");
    if (!oReturn) {
        return
    }

    postData = "AjaxRequest=y"
    postData += "&Operation=" + op_Resize
    for (var a in oReturn) {
        postData += "&" + a + "=" + oReturn[a]
    }
    LockBody()
	*/
}


function ChangeSizes(which) {
	if(!dialog){
		return
	}
	if (dialog.find("#txtWidth").val().length == 0) {
		dialog.find("#txtWidth").val(image_width)
	}
	if (dialog.find("#txtHeight").val().length == 0) {
		dialog.find("#txtHeight").val(image_height)
	}
	if (image_keep_aspect_ratio == "false") {
		return
	}

	var width = parseInt(dialog.find("#txtWidth").val())
	var height = parseInt(dialog.find("#txtHeight").val())

	if (which == "W") {
		var delta = width / image_width
		var newHeight = Math.round(image_height * delta, 0)
		dialog.find("#txtHeight").val(newHeight)
	} else {
		var delta = height / image_height
		var newWidth = Math.round(image_width * delta, 0)
		dialog.find("#txtWidth").val(newWidth)
	}
}


function Crop() {
    $("#CropInfo").css("display", "block")
    var load_X_1 = "25"
    var load_Y_1 = "25"
    var load_X_2 = "150"
    var load_Y_2 = "150"

    // setup the callback function
    $('#mainImage').Jcrop({
        onSelect: showCoords,
        onChange: showCoords,
        setSelect: [parseInt(load_X_1), parseInt(load_Y_1), parseInt(load_X_2), parseInt(load_Y_2)]
    });

}

function Rotate() {
    /*
    if (!confirm("Confirm the selected operation?")) {
    return
    }
    */
    current_operation = op_Rotate
    postData = "AjaxRequest=y"
    postData += "&Operation=" + current_operation

    LockBody()
}

function FlipH() {
    /*
    if (!confirm("Confirm the selected operation?")) {
    return
    }
    */
    current_operation = op_FlipH
    postData = "AjaxRequest=y"
    postData += "&Operation=" + current_operation

    LockBody()
}

function FlipV() {
    /*
    if (!confirm("Confirm the selected operation?")) {
    return
    }
    */
    current_operation = op_FlipV
    postData = "AjaxRequest=y"
    postData += "&Operation=" + current_operation

    LockBody()
}

function CreateIcone(){
	
	var dialogWidth = 250;
    var dialogHeight = 220;
    //var dialogArgs = new Object()
	//dialogArgs.bgcolor = bgcolor
		
	dialog = $( "<div></div>" )
			.html($( "#divIcone").html())
			.dialog({
			title: "Icone",
			autoOpen: true,
			resizable:false,
			height: dialogHeight,
			width: dialogWidth,
			modal: true,
			buttons: {
				"Confirm": function(event){
					event.preventDefault();
					var result = true
					var oReturn = {};
					var operation
						
					if (!$( this ).dialog().find("#ico_16").prop("checked") &&
							!$( this ).dialog().find("#ico_24").prop("checked") &&
							!$( this ).dialog().find("#ico_32").prop("checked") &&
							!$( this ).dialog().find("#ico_48").prop("checked") &&
							!$( this ).dialog().find("#ico_96").prop("checked") &&
							!$( this ).dialog().find("#ico_128").prop("checked") &&
							!$( this ).dialog().find("#ico_256").prop("checked") &&
							!$( this ).dialog().find("#ico_512").prop("checked") ) {
						alert("Choose minimum one size")
						return;
					}
										
					//retVal.Name = document.getElementById("txtName").value
					oReturn['Ico_16'] = ($( this ).dialog().find("#ico_16").prop("checked") ? "true" : "false")
					oReturn['Ico_24'] = ($( this ).dialog().find("#ico_24").prop("checked") ? "true" : "false")
					oReturn['Ico_32'] = ($( this ).dialog().find("#ico_32").prop("checked") ? "true" : "false")
					oReturn['Ico_48'] = ($( this ).dialog().find("#ico_48").prop("checked") ? "true" : "false")
					oReturn['Ico_96'] = ($( this ).dialog().find("#ico_96").prop("checked") ? "true" : "false")
					oReturn['Ico_128'] = ($( this ).dialog().find("#ico_128").prop("checked") ? "true" : "false")
					oReturn['Ico_256'] = ($( this ).dialog().find("#ico_256").prop("checked") ? "true" : "false")
					oReturn['Ico_512'] = ($( this ).dialog().find("#ico_512").prop("checked") ? "true" : "false")
					
					if(result){
						postData = "AjaxRequest=y"
						postData += "&Operation=" + op_Icone
						for (var a in oReturn) {
							postData += "&" + a + "=" + oReturn[a]
						}
						$( this ).dialog( "close" );
						LockBody()						
					}
				},
				Cancel: function() {					
					$( this ).dialog().find( "form" )[0].reset();
					$( this ).dialog( "close" );
				}
			},
			open: function(){
				
				$( this ).dialog().find("#ico_16").prop("checked", true);
				$( this ).dialog().find("#ico_24").prop("checked", true);
				$( this ).dialog().find("#ico_32").prop("checked", true);
				$( this ).dialog().find("#ico_48").prop("checked", true);
				$( this ).dialog().find("#ico_96").prop("checked", true);
				$( this ).dialog().find("#ico_128").prop("checked", true);
				$( this ).dialog().find("#ico_256").prop("checked", true);
				$( this ).dialog().find("#ico_512").prop("checked", true);
				
			},
			close: function() {
				dialog = null				
			}
		});
	
	
	/*
    var oReturn = window.showModalDialog("Icone.html", dialogArgs, "dialogWidth:" + dialogWidth + "px;dialogHeight:" + dialogHeight + "px;help:no;scroll:no;status:no;resizable:no");
    if (!oReturn) {
        return
    }
//Ico_16=true&Ico_24=true&Ico_32=true&Ico_48=true&Ico_96=true&Ico_128=true&IconeName=myname
	
    postData = "AjaxRequest=y"
    postData += "&Operation=" + op_Icone
    postData += "&IconeName=" + oReturn.Name
	postData += "&Ico_16=" + oReturn.Ico_16
	postData += "&Ico_24=" + oReturn.Ico_24 
	postData += "&Ico_32=" + oReturn.Ico_32 
    postData += "&Ico_48=" + oReturn.Ico_48 
	postData += "&Ico_96=" + oReturn.Ico_96 
	postData += "&Ico_128=" + oReturn.Ico_128 
	postData += "&Ico_256=" + oReturn.Ico_256
	postData += "&Ico_512=" + oReturn.Ico_512 
	
    //for (var a in oReturn) {
    //    postData += "&" + a + "=" + oReturn[a]
    //}
	
    LockBody()
	*/
}

function Watermark() {
    var dialogWidth = 350;
    var dialogHeight = 300;
	
	dialog = $( "<div></div>" )
			.html($( "#divWatermark").html())
			.dialog({
			title: "Watermark",
			autoOpen: true,
			resizable:false,
			height: dialogHeight,
			width: dialogWidth,
			modal: true,
			buttons: {
				"Confirm": function(event){
					event.preventDefault();
					var result = true
					var oReturn = {};
					var operation
										
					var re = new RegExp(/^\d+$/)
					if (dialog.find("#radio_text")[0].checked) {
						if (dialog.find("#txtWatermark").val().length == 0) {
							alert("Insert the Text value")
							return;
						}
		
						if (dialog.find("#txtFontSizeBig").val().length == 0) {
							alert("Insert the Font size for the image")
							return;
						}
		
						if (!re.test(dialog.find("#txtFontSizeBig").val())) {
							alert("The Font size for the image is not valid ")
							return;
						}
		
						if (dialog.find("#txtFontSizeMedium").val().length == 0) {
							alert("Insert the Font size for the first thumb")
							return;
						}
		
						if (!re.test(dialog.find("#txtFontSizeMedium").val())) {
							alert("The Font size for the first thumb is not valid")
							return;
						}
		
						if (dialog.find("#txtFontSizeSmall").val() == 0) {
							alert("Insert the Font size for the second thumb")
							return;
						}
		
						if (!re.test(dialog.find("#txtFontSizeSmall").val())) {
							alert("The Font size for the second thumb is not valid")
							return;
						}
						
						if (dialog.find("#txtFontColor").val().length == 0) {
							alert("Insert the Font color")
							return;
						}
						re = new RegExp(/^#?[0-9A-Fa-f]{6}$/)
						if (!re.test(dialog.find("#txtFontColor").val())) {
							alert("The Font color is not valid")
							return;
						}
					}
		
					oReturn['WatermarkType'] = (dialog.find("#radio_text")[0].checked ? "text" : "image")
					oReturn['WatermarkText'] = dialog.find("#txtWatermark").val()
					oReturn['WatermarkPosition'] = dialog.find("#cmbPosition").val()
					oReturn['WatermarkFontFace'] = dialog.find("#cmbFontFace").val()
					oReturn['WatermarkFontSizeBig'] = dialog.find("#txtFontSizeBig").val()
					oReturn['WatermarkFontSizeMedium'] = dialog.find("#txtFontSizeMedium").val()
					oReturn['WatermarkFontSizeSmall'] = dialog.find("#txtFontSizeSmall").val()
					oReturn['WatermarkFontColor'] = escape("#" + dialog.find("#txtFontColor").val())
										
					if (oReturn['WatermarkType'] == "text") {
						operation = op_WatermarkText
					} else {
						operation = op_WatermarkImage
					}													
					if(result){
						postData = "AjaxRequest=y"
						postData += "&Operation=" + operation
						for (var a in oReturn) {
							postData += "&" + a + "=" + oReturn[a]
						}
						$( this ).dialog( "close" );
						LockBody()						
					}
				},
				Cancel: function() {					
					$( this ).dialog().find( "form" )[0].reset();
					$( this ).dialog( "close" );
				}
			},
			open: function(){
				if (watermark_text_enabled == "false") {					
					$( this ).dialog().find("#radio_text").prop("disabled", true)
					$( this ).dialog().find("#radio_text").prop("checked", false)
					$( this ).dialog().find("#radio_image").prop("checked", true)
				}
				if (watermark_image_enabled == "false") {
					$( this ).dialog().find("#radio_image").prop("checked", true)
				}
				var fonts = fonts_list.split(";")
				var html = ""
				for(var x=0; x<fonts.length; x++){
					html += '<option value="' + fonts[x] + '" >' + fonts[x] + '</option>'
				}
				
				$( this ).dialog().find("#cmbFontFace").html(html)
												
				$( this ).dialog().find("#radio_text")
					.on( "click", function() {						
						ChangeType()
					});
				$( this ).dialog().find("#radio_image")
					.on( "click", function() {						
						ChangeType()
					});
					
				ChangeType($( this ).dialog())
			},
			close: function() {
				dialog = null				
			}
		});
			
	/*
    var dialogArgs = new Object()
    dialogArgs.bgcolor = bgcolor
    dialogArgs.WatermarkText = watermark_text_enabled
    dialogArgs.WatermarkImage = watermark_image_enabled
    dialogArgs.ThumbMedium = resize_thumb_m
    dialogArgs.ThumbSmall = resize_thumb_s
	dialogArgs.FontsList = fonts_list
	
    var oReturn = window.showModalDialog("Watermark.html", dialogArgs, "dialogWidth:" + dialogWidth + "px;dialogHeight:" + dialogHeight + "px;help:no;scroll:no;status:no;resizable:no");
    if (!oReturn) {
        return
    }

    postData = "AjaxRequest=y"
    if (oReturn.WatermarkType == "text") {
        postData += "&Operation=" + op_WatermarkText
    } else {
        postData += "&Operation=" + op_WatermarkImage
    }

    for (var a in oReturn) {
        postData += "&" + a + "=" + oReturn[a]
    }

    LockBody()
	*/
}

function ChangeType(v_dialog){
	if(!dialog && !v_dialog){
		return
	}
	
	if(v_dialog){
		dialog = v_dialog
	}

	if (dialog.find("#radio_image")[0].checked) {
		dialog.find("#txtWatermark").prop("disabled", true)
		dialog.find("#cmbFontFace").prop("disabled", true)
		dialog.find("#txtFontColor").prop("disabled", true)
		dialog.find("#txtFontSizeBig").prop("disabled", true)
		dialog.find("#txtFontSizeMedium").prop("disabled", true)
		dialog.find("#txtFontSizeSmall").prop("disabled", true)
		html = '<option value="top_left">Top left</option>'
		html += '<option value="top_center">Top center</option>'
		html += '<option value="top_right">Top right</option>'
		html += '<option value="middle_left">Middle left</option>'
		html += '<option value="middle_center" selected="selected">Middle center</option>'
		html += '<option value="middle_">Middle right</option>'
		html += '<option value="bottom_left">Bottom left</option>'
		html += '<option value="bottom_center">Bottom center</option>'
		html += '<option value="bottom_right">Bottom right</option>'
	} else {
		dialog.find("#txtWatermark").prop("disabled", false)
		dialog.find("#cmbFontFace").prop("disabled", false)
		dialog.find("#txtFontColor").prop("disabled", false)
		dialog.find("#txtFontSizeBig").prop("disabled", false)
		if (resize_thumb_m == "true") {
			dialog.find("#txtFontSizeMedium").prop("disabled", false)
		} else {
			dialog.find("#txtFontSizeMedium").prop("disabled", true)
		}
		if (resize_thumb_s == "true") {
			dialog.find("#txtFontSizeSmall").prop("disabled", false)
		} else {
			dialog.find("#txtFontSizeSmall").prop("disabled", true)
		}
		html = '<option value="top_left">Top left</option>'
		html += '<option value="top_center">Top center</option>'
		html += '<option value="top_right">Top right</option>'
		html += '<option value="middle_left">Middle left</option>'
		html += '<option value="middle_center" selected="selected">Middle center</option>'
		html += '<option value="middle_">Middle right</option>'
		html += '<option value="bottom_left">Bottom left</option>'
		html += '<option value="bottom_center">Bottom center</option>'
		html += '<option value="bottom_right">Bottom right</option>'
		html += '<option value="repeat1">Repeat 1 line</option>'
		html += '<option value="repeat2">Repeat 2 line</option>'
		html += '<option value="repeat3">Repeat 3 line</option>'
	}
	dialog.find("#cmbPosition").html(html)	
}

function ConfirmCrop() {
    current_operation = op_Crop
    postData = "AjaxRequest=y"
    postData += "&Operation=" + current_operation
    postData += "&x1=" + $("#x1")[0].value
    postData += "&y1=" + $("#y1")[0].value
    postData += "&x2=" + $("#x2")[0].value
    postData += "&y2=" + $("#y2")[0].value
    $('#mainImage').data("Jcrop").destroy();
    $("#CropInfo").css("display", "none")

    LockBody()
}

function CancelCrop() {
    $("#CropInfo").css("display", "none")
    $('#mainImage').data("Jcrop").destroy();
    LoadImage()
}

function showCoords(coords) {
    $('#x1').attr("value", coords.x);
    $('#y1').attr("value", coords.y);
    $('#x2').attr("value", coords.x2);
    $('#y2').attr("value", coords.y2);
    $('#width').attr("value", coords.w);
    $('#height').attr("value", coords.h);
}

function SetImageDimensions(img){
	image_width = $(img).width()
	image_height = $(img).height()
	//alert(image_width + "-" + image_height)
}

function LoadImage() {
    $("#imageWrap").html("&nbsp;")
    var img_path = image_path;
    if (image_index != 0) {
        img_path = image_path_temp + image_name_temp.replace(/#image_index#/gi, image_index)
    }
			
    var image = '<img src="' + img_path + "?t=" + Math.random() + '" onload="javascript:SetImageDimensions(this)" id="mainImage" alt="" />'
    $("#imageWrap").html(image)
	
	if (image_path_temp && thumb_m_path && image_index != 0) {
        thumb_path = image_path_temp + thumb_m_path.replace(/#image_index#/gi, image_index)
		var image = '<img src="' + thumb_path + "?t=" + Math.random() + '" id="thumb_1_mage" alt="" />'
		$("#thumb_1_wrap").html(image)
		
		thumb_path = image_path_temp + thumb_s_path.replace(/#image_index#/gi, image_index)
		var image = '<img src="' + thumb_path + "?t=" + Math.random() + '" id="thumb_2_mage" alt="" />'
		$("#thumb_2_wrap").html(image)	    
	}else{
		$("#thumb_1_wrap").html("&nbsp;")
		$("#thumb_2_wrap").html("&nbsp;")
	}
	
	if(icones && icones.length > 0 && icones[image_index] && icones[image_index] != ""){
		var image = '<img src="' + icones[image_index] + "?t=" + Math.random() + '" id="icone_mage" alt="" />'
		$("#icone_wrap").html(image)
	}else{
		$("#icone_wrap").html("&nbsp;")
	}
}


function LockBody() {
    $.blockUI({
		theme:     true, 		
        css: {
            padding: 0,
            margin: 0,
            width: '30%',
            top: '40%',
            left: '35%',
            textAlign: 'center',
            color: '#000',
            border: '1px solid #f00',
            backgroundColor: '#fff',
            cursor: 'wait'
        },
        overlayCSS: {
            //backgroundColor: lock_body_color,
            //opacity: lock_body_percentage,
            cursor: 'wait'
        },
        fadeIn: 400,
        message: '<table border=0 cellpadding=5><tr><td><img src="css/busy.gif" /></td>' +
						'<td valign="middle" class="blockText" ><br>&nbsp;&nbsp;Please wait...</br>&nbsp;</td></tr></table>',
        onBlock: SendRequest
    });
}

function UnLockBody() {
    $.unblockUI({
        fadeOut: 400,
        onUnblock: function () {
            if (must_close) {
				parent.CloseParent()
                //top.close();
            } else {
                LoadImage();
            }
        }
    });
}

