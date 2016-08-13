<?php
if(!isset($_SESSION)){
	session_start();
}

include("dwzString.php");
include("dwzIO.php");
include("dwzImage.php");
include("class-php-ico.php");

$en_NONE = 0;
$en_Undo = 1;
$en_Resize = 2;
$en_Crop = 3;
$en_Rotate = 4;
$en_FlipH = 5;
$en_FlipV = 6;
$en_WatermarkText = 7;
$en_Invert = 8;
$en_Greyscale = 9;
$en_Brightness = 10;
$en_Contrast = 11;
$en_Gamma = 12;
$en_Color = 13;
$en_Smooth = 14;
$en_GaussianBlur = 15;
$en_MeanRemoval = 16;
$en_Sharpen = 17;
$en_EmbossLaplacian = 18;
$en_EdgeDetectQuick = 19;
$en_Confirm = 20;
$en_DeleteTempImages = 21;
$en_WatermarkImage = 22;
$en_SelectviveBlur = 23;
$en_Icone = 24;

$resizeEnabled = false;
$cropEnabled = false;
$flipEnabled = false;
$rotateEnabled = false;
$watermarkEnabled = false;
$filtersEnabled = false;
$createIcone = false;
$watermark_text_enabled = "false";
$watermark_image_enabled = "false";
$bgcolor = "#FFFFFF";
$image_min_width = 0;
$image_min_height = 0;
$image_max_width = 0;
$image_max_height = 0;
$image_keep_aspect_ratio = true;
$image_jpeg_quality = "80";
$lock_body_color = "#003399";
$lock_body_percentage = "0.5";
$image_path = "";
$image_temp_path = "";

$watermark_image_big = "";
$watermark_image_medium = "";
$watermark_image_small = "";

$operation = $en_NONE;

$resize_thumb_m = "false";
$resize_thumb_m_width = "";
$resize_thumb_m_height = "";
$resize_thumb_m_suffix = "";
$resize_thumb_m_suffix_pos = "";

$resize_thumb_s = "false";
$resize_thumb_s_width = "";
$resize_thumb_s_height = "";
$resize_thumb_s_suffix = "";
$resize_thumb_s_suffix_pos = "";
$fonts_list = "";
        
if (dwzString::GetRequest("AjaxRequest") != "")
{
	ExecuteAjaxRequest();
}

$theme = dwzString::GetRequest("theme");
$bgcolor = dwzString::GetRequest("bgcolor");
$watermark_text_enabled = dwzString::GetRequest("WatermarkText");
$watermark_image_enabled = dwzString::GetRequest("WatermarkImage");
$watermark_image_big = dwzString::GetRequest("WatermarkImageBig");
$watermark_image_medium = dwzString::GetRequest("WatermarkImageMedium");
$watermark_image_small = dwzString::GetRequest("WatermarkImageSmall");

$resizeEnabled = (dwzString::GetRequest("ResizeEnabled") == "true" ? true : false);
$cropEnabled = (dwzString::GetRequest("CropEnabled") == "true" ? true : false);
$flipEnabled = (dwzString::GetRequest("FlipEnabled") == "true" ? true : false);
$rotateEnabled = (dwzString::GetRequest("RotateEnabled") == "true" ? true : false);
$watermarkEnabled = (dwzString::GetRequest("WatermarkEnabled") == "true" ? true : false);
$filtersEnabled = (dwzString::GetRequest("FiltersEnabled") == "true" ? true : false);

$createIcone = (dwzString::GetRequest("CreateIcone") == "true" ? true : false);

$lock_body_color = dwzString::GetRequest("LockBodyColor");
$lock_body_percentage = dwzString::GetRequest("LockBodyPercentage");
$image_min_width = intval(dwzString::GetRequest("ImageMinWidth"));
$image_min_height = intval(dwzString::GetRequest("ImageMinHeight"));
$image_max_width = intval(dwzString::GetRequest("ImageMaxWidth"));
$image_max_height = intval(dwzString::GetRequest("ImageMaxHeight"));
$image_keep_aspect_ratio = dwzString::GetRequest("ImageKeepAspectRatio") == "true" ? "-1" : "0";
$image_jpeg_quality = intval(dwzString::GetRequest("ImageJpegQuality"));

$resize_thumb_m = dwzString::GetRequest("resize_thumb_m") == "true" ? "true" : "false";
$resize_thumb_m_width = dwzString::GetRequest("resize_thumb_m_width");
$resize_thumb_m_height = dwzString::GetRequest("resize_thumb_m_height");
$resize_thumb_m_suffix = dwzString::GetRequest("resize_thumb_m_suffix");
$resize_thumb_m_suffix_pos = (dwzString::GetRequest("resize_thumb_m_suffix_pos") == "1" ? dwzIO::BEFORE_NAME : dwzIO::BETWEEN_NAME_AND_EXTENSION);

$resize_thumb_s = dwzString::GetRequest("resize_thumb_s") == "true" ? "true" : "false";
$resize_thumb_s_width = dwzString::GetRequest("resize_thumb_s_width");
$resize_thumb_s_height = dwzString::GetRequest("resize_thumb_s_height");
$resize_thumb_s_suffix = dwzString::GetRequest("resize_thumb_s_suffix");
$resize_thumb_s_suffix_pos = (dwzString::GetRequest("resize_thumb_s_suffix_pos") == "1" ? dwzIO::BEFORE_NAME : dwzIO::BETWEEN_NAME_AND_EXTENSION);

$image_path = dwzString::GetRequest("ImagePath");
$image_temp_path = dwzString::GetRequest("ImageTempPath");
$fonts_list = dwzString::GetRequest("FontsList");

$image_manager = new dwzImage();
$image_manager->load(dwzIO::GetRealPath($image_path));
$image_size = $image_manager->GetImageSize();

$script = CreateJsVariables();

DeleteTempImages(session_id(), $image_temp_path);

function CreateJsVariables()
{
	$text = "<script language='javascript'>\n";
	$text .= "var bgcolor = '" .$GLOBALS['bgcolor'] ."';\n";
	$text .= "var image_path_temp = '" .$GLOBALS['image_temp_path'] ."';\n";
	$text .= "var image_path = '" .$GLOBALS['image_path'] ."';\n";	
	$image_name_temp = GetImageTempName();
	$text .= "var image_name_temp = '" .$image_name_temp ."';\n";
	
	$text .= "var image_width = '" .$GLOBALS['image_size'][0] ."';\n";
	$text .= "var image_height = '" .$GLOBALS['image_size'][1] ."';\n";
	$text .= "var image_min_width = '" .$GLOBALS['image_min_width'] ."';\n";
	$text .= "var image_min_height = '" .$GLOBALS['image_min_height'] ."';\n";
	$text .= "var image_max_width = '" .$GLOBALS['image_max_width'] ."';\n";
	$text .= "var image_max_height = '" .$GLOBALS['image_max_height'] ."';\n";
	$text .= "var image_max_height = '" .$GLOBALS['image_max_height'] ."';\n";
	$text .= "var image_keep_aspect_ratio = '" .($GLOBALS['image_keep_aspect_ratio'] ? "true" : "false") ."'\n";
	$text .= "var image_jpeg_quality = '" .$GLOBALS['image_jpeg_quality'] ."';\n";	
	$text .= "var lock_body_color = '" .$GLOBALS['lock_body_color'] ."'\n";
	$text .= "var lock_body_percentage = parseFloat('" .$GLOBALS['lock_body_percentage'] ."')\n";
	$text .= "var watermark_text_enabled = '" .$GLOBALS['watermark_text_enabled'] ."'\n";
	$text .= "var watermark_image_enabled = '" .$GLOBALS['watermark_image_enabled'] ."'\n";
	
	$text .= "var resize_thumb_m = '" .strtolower($GLOBALS['resize_thumb_m']) ."'\n";
	$text .= "var resize_thumb_m_width = '" .$GLOBALS['resize_thumb_m_width'] ."'\n";
	$text .= "var resize_thumb_m_height = '" .$GLOBALS['resize_thumb_m_height'] ."'\n";
	$text .= "var resize_thumb_m_suffix = '" .$GLOBALS['resize_thumb_m_suffix'] ."'\n";
	$text .= "var resize_thumb_m_suffix_pos = '" .$GLOBALS['resize_thumb_m_suffix_pos'] ."'\n";
	if(strtolower($GLOBALS['resize_thumb_m']) == "true"){
		$thumb_path = dwzIO::GetRealPath(dwzIO::PathCombine($GLOBALS['image_temp_path'], $image_name_temp));
		$thumb_path = dwzIO::GetThumbPath($thumb_path, $GLOBALS['resize_thumb_m_suffix'], $GLOBALS['resize_thumb_s_suffix_pos']);
		$part = dwzIO::GetFilePart($thumb_path);
		$thumb_path = $part["name"] .$part["ext"];
	}else{
		$thumb_path = "";
	}
	$text .= "var thumb_m_path = '" .$thumb_path ."';\n";
	
	$text .= "var resize_thumb_s = '" .strtolower($GLOBALS['resize_thumb_s']) ."'\n";
	$text .= "var resize_thumb_s_width = '" .$GLOBALS['resize_thumb_s_width'] ."'\n";
	$text .= "var resize_thumb_s_height = '" .$GLOBALS['resize_thumb_s_height'] ."'\n";
	$text .= "var resize_thumb_s_suffix = '" .$GLOBALS['resize_thumb_s_suffix'] ."'\n";
	$text .= "var resize_thumb_s_suffix_pos = '" .$GLOBALS['resize_thumb_s_suffix_pos'] ."'\n";
	if(strtolower($GLOBALS['resize_thumb_s']) == "true"){
		$thumb_path = dwzIO::GetRealPath(dwzIO::PathCombine($GLOBALS['image_temp_path'], $image_name_temp));
		$thumb_path = dwzIO::GetThumbPath($thumb_path, $GLOBALS['resize_thumb_s_suffix'], $GLOBALS['resize_thumb_s_suffix_pos']);
		$part = dwzIO::GetFilePart($thumb_path);
		$thumb_path = $part["name"] .$part["ext"];
	}else{
		$thumb_path = "";
	}
	$text .= "var thumb_s_path = '" .$thumb_path ."';\n";
	
	$text .= "var watermark_image_big = '" .$GLOBALS['watermark_image_big'] ."'\n";
	$text .= "var watermark_image_medium = '" .$GLOBALS['watermark_image_medium'] ."'\n";
	$text .= "var watermark_image_small = '" .$GLOBALS['watermark_image_small'] ."'\n";
	$text .= "var fonts_list = '" .$GLOBALS['fonts_list'] ."'\n";

	$text .= "</script>\n";
	return $text;	
}

function GetSessionIdFromPath($image_path)
{
	$file_part = dwzIO::GetFilePart(dwzIO::GetRealPath($image_path));
	$image_name = $file_part["name"];
	$dwzPosition = strrpos($image_name, "_dwz_");
	$image_name_prefix = substr($image_name, 0, $dwzPosition);

	$image_name_prefix = substr($image_name_prefix, 0, strripos($image_name_prefix, "_"));
	$image_name_prefix = preg_replace("/dwz_/i", "", $image_name_prefix);
	return $image_name_prefix;
}

function DeleteImages($max_image_index, $image_path)
{
	$file_part = dwzIO::GetFilePart($image_path);
	$folder = $file_part["path"];
	$image_name = $file_part["name"] .$file_part["ext"];

	$dwzPosition = strrpos($image_name, "_dwz_");
	$image_name_prefix = substr($image_name, 0, $dwzPosition);
	$image_name_suffix = substr($image_name, $dwzPosition);

	$image_name_prefix = substr($image_name_prefix, 0, strripos($image_name_prefix, "_") + 1);

	$temp_image_path = dwzIO::PathCombine($folder, $image_name_prefix .$max_image_index .$image_name_suffix);
		
	while(file_exists($temp_image_path)){
		try
		{
			unlink($temp_image_path);

			//if (resize_thumb_m)
			//{
			//    string thumb_path = GetThumbPath(temp_image_path, resize_thumb_m_suffix, resize_thumb_m_suffix_pos);
			//    if (File.Exists(thumb_path))
			//    {
			//        File.Delete(thumb_path);
			//    }
			//}

			//if (resize_thumb_s)
			//{
			//    string thumb_path = GetThumbPath(dwzIO::GetRealPath(temp_image_path), resize_thumb_s_suffix, resize_thumb_s_suffix_pos);
			//    if (File.Exists(thumb_path))
			//    {
			//        File.Delete(thumb_path);
			//    }
			//}
		}
		catch(Exception $e) { }
		$max_image_index++;
		$temp_image_path = dwzIO::PathCombine($folder, $image_name_prefix .$max_image_index .$image_name_suffix);
	}
}

function DeleteTempImages($session_id, $temp_path)
{
	$folder = dwzIO::GetRealPath($temp_path);	
	if(!file_exists($folder)){
		mkdir($folder);
	}
	try{
	if ($handle = opendir($folder)) {
    	while (false !== ($entry = readdir($handle))) {			
			if ($entry != "." && $entry != "..") {				
    	        if(preg_match("/dwz_" .$session_id ."_/i", $entry)){
					unlink(dwzIO::PathCombine($folder, $entry));
				}
	        }
	    }    	
    	closedir($handle);
	}
	}catch(Exception $e) { }	
}

function GetImageTempName()
{
	$file_path = $GLOBALS['image_path'];
	$file_part = dwzIO::GetFilePart(dwzIO::GetRealPath($file_path));
	$name = "dwz_" .session_id() ."_#image_index#_dwz_" .$file_part["name"] .$file_part["ext"];
	return $name;
}

function ExecuteAjaxRequest()
{
	$image_source = dwzString::GetRequest("ImageSource");
	$image_destination = dwzString::GetRequest("ImageDestination");
	$session_id = "";

	$max_image_index = intval(dwzString::GetRequest("max_image_index"));
	$image_temp_path = dwzString::GetRequest("image_path_temp");
	$resize_thumb_m = (strtolower(dwzString::GetRequest("resize_thumb_m")) == "true" ? true : false);
	$resize_thumb_m_width = dwzString::GetRequest("resize_thumb_m_width");
	$resize_thumb_m_height = dwzString::GetRequest("resize_thumb_m_height");
	$resize_thumb_m_suffix = dwzString::GetRequest("resize_thumb_m_suffix");
	$resize_thumb_m_suffix_pos = (dwzString::GetRequest("resize_thumb_m_suffix_pos") == "1" ? dwzIO::BEFORE_NAME : dwzIO::BETWEEN_NAME_AND_EXTENSION);

	$resize_thumb_s = (strtolower(dwzString::GetRequest("resize_thumb_s")) == "true" ? true : false);
	$resize_thumb_s_width = dwzString::GetRequest("resize_thumb_s_width");
	$resize_thumb_s_height = dwzString::GetRequest("resize_thumb_s_height");
	$resize_thumb_s_suffix = dwzString::GetRequest("resize_thumb_s_suffix");
	$resize_thumb_s_suffix_pos = (dwzString::GetRequest("resize_thumb_s_suffix_pos") == "1" ? dwzIO::BEFORE_NAME : dwzIO::BETWEEN_NAME_AND_EXTENSION);

	$image_keep_aspect_ratio = (strtolower(dwzString::GetRequest("ImageKeepAspectRatio")) == "true" ? "-1" : "0");
	$jpeg_image_quality = intval(dwzString::GetRequest("ImageJpegQuality"));

	$watermark_image_big = dwzString::GetRequest("watermark_image_big");
	$watermark_image_medium = dwzString::GetRequest("watermark_image_medium");
	$watermark_image_small = dwzString::GetRequest("watermark_image_small");

	$watermark_text = dwzString::GetRequest("WatermarkText");
	$watermark_font_face = "./fonts/" . dwzString::GetRequest("WatermarkFontFace") .".ttf";	
	$watermark_font_size_big = dwzString::GetRequest("WatermarkFontSizeBig");
	$watermark_font_size_medium = dwzString::GetRequest("WatermarkFontSizeMedium");
	$watermark_font_size_small = dwzString::GetRequest("WatermarkFontSizeSmall");
	$watermark_font_color = dwzString::GetRequest("WatermarkFontColor");
	$watermark_text_position = dwzString::GetRequest("WatermarkPosition");

	$watermark_big_image_path = dwzString::GetRequest("watermark_image_big");
	$watermark_medium_image_path = dwzString::GetRequest("watermark_image_medium");
	$watermark_small_image_path = dwzString::GetRequest("watermark_image_small");
	$watermark_image_position = dwzString::GetRequest("WatermarkPosition");

	$image_manager = new dwzImage();
	$image_manager->load(dwzIO::GetRealPath($image_source));
	
	$operation = intval(dwzString::GetRequest("Operation"));
		
	DeleteImages($max_image_index, dwzIO::GetRealPath($image_destination));
	
			
	switch ($operation)
	{
		case $GLOBALS['en_Brightness']:
			$nBrightness = intval(dwzString::GetRequest("Valore"));
			$image_manager->Brightness($nBrightness);
			break;
		case $GLOBALS['en_Color']:
			$red = intval(dwzString::GetRequest("Red"));
			$green = intval(dwzString::GetRequest("Green"));
			$blue = intval(dwzString::GetRequest("Blue"));
			$image_manager->Color($red, $green, $blue);
			break;
		case $GLOBALS['en_Contrast']:
			$nContrast = intval(dwzString::GetRequest("Valore"));
			$image_manager->Contrast($nContrast);
			break;
		case $GLOBALS['en_Crop']:
			$crop_x_1 = intval(dwzString::GetRequest("x1"));
			$crop_y_1 = intval(dwzString::GetRequest("y1"));
			$crop_x_2 = intval(dwzString::GetRequest("x2"));
			$crop_y_2 = intval(dwzString::GetRequest("y2"));
			$image_manager->crop($crop_x_1, $crop_y_1, $crop_x_2, $crop_y_2, NULL);
			break;
		case $GLOBALS['en_EdgeDetectQuick']:
			$image_manager->EdgeDetectQuick();
			break;
		case $GLOBALS['en_EmbossLaplacian']:
			$image_manager->EmbossLaplacian();
			break;
		case $GLOBALS['en_FlipH']:
			$image_manager->FlipH();
			break;
		case $GLOBALS['en_FlipV']:
			$image_manager->FlipV();
			break;
		case $GLOBALS['en_Gamma']:
			$input = doubleval(dwzString::GetRequest("InputGamma"));
			$output = doubleval(dwzString::GetRequest("OutputGamma"));
			$image_manager->Gamma($input, $output);
			break;
		case $GLOBALS['en_GaussianBlur']:
			$image_manager->GaussianBlur();
			break;
		case $GLOBALS['en_SelectviveBlur']:
			$image_manager->SelectiveBlur();
			break;
		case $GLOBALS['en_Greyscale']:
			$image_manager->GrayScale();
			break;
		case $GLOBALS['en_Invert']:
			$image_manager->Invert();
			break;
		case $GLOBALS['en_MeanRemoval']:
			$nWeight = intval(dwzString::GetRequest("Valore"));
			$image_manager->MeanRemoval($nWeight);
			break;
		case $GLOBALS['en_Resize']:
			$width = intval(dwzString::GetRequest("Width"));
			$height = intval(dwzString::GetRequest("Height"));			
			$image_manager->resize($width, $height);
			break;
		case $GLOBALS['en_Rotate']:		
			$image_manager->Rotate();
			break;
		case $GLOBALS['en_Sharpen']:
			$nWeight = intval(dwzString::GetRequest("Valore"));
			$image_manager->Sharpen($nWeight);
			break;
		case $GLOBALS['en_Smooth']:
			$nWeight = intval(dwzString::GetRequest("Valore"));
			$image_manager->Smooth($nWeight);
			break;
		case $GLOBALS['en_WatermarkText']:
			break;
		case $GLOBALS['en_WatermarkImage']:
			break;
		case $GLOBALS['en_Icone']:
			$sizes = array();
			if(dwzString::GetRequest("Ico_16") == "true"){
				$sizes[] = array( 16, 16 );
			}
			if(dwzString::GetRequest("Ico_24") == "true"){
				$sizes[] = array( 24, 24 );
			}
			if(dwzString::GetRequest("Ico_32") == "true"){
				$sizes[] = array( 32, 32 );
			}
			if(dwzString::GetRequest("Ico_48") == "true"){
				$sizes[] = array( 48, 48 );
			}
			if(dwzString::GetRequest("Ico_96") == "true"){
				$sizes[] = array( 96, 96 );
			}
			if(dwzString::GetRequest("Ico_128") == "true"){
				$sizes[] = array( 128, 128 );
			}
			if(dwzString::GetRequest("Ico_256") == "true"){
				$sizes[] = array( 256, 256 );
			}
			if(dwzString::GetRequest("Ico_512") == "true"){
				$sizes[] = array( 512, 512 );
			}
			$icone_name = dwzString::GetRequest("IconeName");
			if($icone_name == ""){
				$icone_name = "originaldwzname";
			}
			$source = dwzIO::GetRealPath($image_source);
			$icone_destination = $image_destination .".ico";
			$icone_destination = dwzIO::GetRealPath($icone_destination);
			
			$ico_lib = new PHP_ICO( $source, $sizes );
			$ico_lib->save_ico( $icone_destination );
			
			break;
		case $GLOBALS['en_Confirm']:
			$image_path = dwzString::GetRequest("image_path");						
			dwzIO::FileCopy(dwzIO::GetRealPath($image_source), dwzIO::GetRealPath($image_path), true);			
			if ($resize_thumb_m)
			{
				$source_thumb_path = dwzIO::GetThumbPath(dwzIO::GetRealPath($image_source), $resize_thumb_m_suffix, $resize_thumb_m_suffix_pos);
				$dest_thumb_path = dwzIO::GetThumbPath(dwzIO::GetRealPath($image_path), $resize_thumb_m_suffix, $resize_thumb_m_suffix_pos);
				if (dwzIO::FileExist($source_thumb_path))
				{
					dwzIO::FileCopy($source_thumb_path, $dest_thumb_path, true);
				}
			}

			if ($resize_thumb_s)
			{
				$source_thumb_path = dwzIO::GetThumbPath(dwzIO::GetRealPath($image_source), $resize_thumb_s_suffix, $resize_thumb_s_suffix_pos);
				$dest_thumb_path = dwzIO::GetThumbPath(dwzIO::GetRealPath($image_path), $resize_thumb_s_suffix, $resize_thumb_s_suffix_pos);
				if (dwzIO::FileExist($source_thumb_path))
				{
					dwzIO::FileCopy($source_thumb_path, $dest_thumb_path, true);
				}
			}
			
			if(dwzIO::FileExist(dwzIO::GetRealPath($image_source .".ico"))){
				$image_path_part = dwzIO::GetFilePart(dwzIO::GetRealPath($image_path));
				$icon_temp_path = dwzIO::GetRealPath($image_source .".ico");
				$icon_path = dwzIO::PathCombine($image_path_part["path"], $image_path_part["name"] .".ico");				
				/*
				echo var_export($image_path_part);
				echo "<br>";
				echo $icon_temp_path;
				echo "<br>";
				echo $icon_path;
				exit();
				*/
				dwzIO::FileCopy($icon_temp_path, $icon_path, true);				
			}
						
			$session_id = GetSessionIdFromPath($image_source);
			DeleteTempImages($session_id, $image_temp_path);

			break;
		case $GLOBALS['en_DeleteTempImages']:
			$session_id = GetSessionIdFromPath($image_source);
			DeleteTempImages($session_id, $image_temp_path);
			break;
	}
	
	if ($operation != $GLOBALS['en_Confirm'] && $operation != $GLOBALS['en_DeleteTempImages'])
	{				
		$image_manager->save(dwzIO::GetRealPath($image_destination), $image_manager->GetImageType(), $jpeg_image_quality);

		if ($resize_thumb_m)
		{
			$thumb_path = dwzIO::GetThumbPath(dwzIO::GetRealPath($image_destination), $resize_thumb_m_suffix, $resize_thumb_m_suffix_pos);
			$image_manager = new dwzImage();
			$image_manager->load(dwzIO::GetRealPath($image_destination));
			$image_manager->resizeToRectangle(intval($resize_thumb_m_width), intval($resize_thumb_m_height), $image_keep_aspect_ratio);
			$image_manager->save($thumb_path, $image_manager->GetImageType(), $jpeg_image_quality);
		}

		if ($resize_thumb_s)
		{
			$thumb_path = dwzIO::GetThumbPath(dwzIO::GetRealPath($image_destination), $resize_thumb_s_suffix, $resize_thumb_s_suffix_pos);
			$image_manager = new dwzImage();
			$image_manager->load(dwzIO::GetRealPath($image_destination));
			$image_manager->resizeToRectangle(intval($resize_thumb_s_width), intval($resize_thumb_s_height), $image_keep_aspect_ratio);
			$image_manager->save($thumb_path, $image_manager->GetImageType(), $jpeg_image_quality);
		}

		if ($operation == $GLOBALS['en_WatermarkText'] || $operation == $GLOBALS['en_WatermarkImage'])
		{
			$image_manager = new dwzImage();
			$image_manager->load(dwzIO::GetRealPath($image_destination));
			if ($operation == $GLOBALS['en_WatermarkText'])
			{
				$image_manager->addWatermarkText($watermark_text, 
												$watermark_font_face, 
												$watermark_font_size_big, 
												$watermark_font_color, 
												$watermark_text_position);
			}
			else
			{
				$image_manager->addWatermarkImage(dwzIO::GetRealPath($watermark_big_image_path), $watermark_image_position);
			}
			$image_manager->save(dwzIO::GetRealPath($image_destination), $image_manager->GetImageType(), $jpeg_image_quality);

			if ($resize_thumb_m)
			{
				$thumb_path = dwzIO::GetThumbPath(dwzIO::GetRealPath($image_destination), $resize_thumb_m_suffix, $resize_thumb_m_suffix_pos);
				$image_manager = new dwzImage();
				$image_manager->load($thumb_path);
				$must_save = false;
				if ($operation == $GLOBALS['en_WatermarkText'])
				{			
					if($watermark_font_size_medium <> 0){
						$must_save = true;
						$image_manager->addWatermarkText($watermark_text, 
														$watermark_font_face, 
														$watermark_font_size_medium, 
														$watermark_font_color, 
														$watermark_text_position);
					}
				}
				else if ($operation == $GLOBALS['en_WatermarkImage'])
				{
					$must_save = true;
					$image_manager->addWatermarkImage(dwzIO::GetRealPath($watermark_medium_image_path), $watermark_image_position);
				}                     
				if($must_save){   
					$image_manager->save($thumb_path, $image_manager->GetImageType(), $jpeg_image_quality);
				}
			}
			
			if ($resize_thumb_s)
			{
				$thumb_path = dwzIO::GetThumbPath(dwzIO::GetRealPath($image_destination), $resize_thumb_s_suffix, $resize_thumb_s_suffix_pos);
							
				$image_manager = new dwzImage();
				$image_manager->load($thumb_path);
				$must_save = false;
				if ($operation == $GLOBALS['en_WatermarkText'])
				{
					if($watermark_font_size_small > 0){
						$must_save = true;
						$image_manager->addWatermarkText($watermark_text, 
														$watermark_font_face, 
														$watermark_font_size_small, 
														$watermark_font_color, 
														$watermark_text_position);
					}
				}
				else if ($operation == $GLOBALS['en_WatermarkImage'])
				{
					$must_save = true;
					$image_manager->addWatermarkImage(dwzIO::GetRealPath($watermark_small_image_path), $watermark_image_position);
				}
				if($must_save){ 
					$image_manager->save($thumb_path, $image_manager->GetImageType(), $jpeg_image_quality);
				}
			}
		}
	}
	
	echo "Done";
	exit();
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title></title>

<?php echo $script; ?>

<link rel="stylesheet" href="css/jquery.Jcrop.min.css" type="text/css" />
<link rel="stylesheet" href="css/themes/<?php echo $theme; ?>/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="css/themes/<?php echo $theme; ?>/theme.css" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.color.js"></script>
<script type="text/javascript" src="js/jquery.Jcrop.min.js" ></script>
<script type="text/javascript" src="js/jquery.blockUI.js" ></script>
<script type="text/javascript" src="js/FrmImageManager.js"></script>
<style type='text/css'>
body{font-size:.62em;}
.ui-widget {
	/* font-size: 0.9em; */
}
.ui-widget .ui-widget {
	/* font-size: 0.7em; */
}
.ui-widget input,
.ui-widget select,
.ui-widget textarea,
.ui-widget button {
	/* font-size: 0.8em; */
}
</style>
<style type="text/css">
.blockText{
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size:12px;
	font-weight:bold;
}
#spanFilter {
	font-family: Arial;
	font-size: 12px;
}
#cmbFilter {
	width: 150px;
}
#imageWrap, #thumb_1_wrap, #thumb_2_wrap, #icone_wrap {	
	margin: 5px 0px 0px 0px; /* Just while testing, to make sure we return the correct positions for the image & not the window */
}
.text { 
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
.Box{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	border:0px;
	width:50px;
	height:17px;
}
BODY
{
    margin-left:5px;
    margin-top:5px;
}
.link{
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size:9px;
	color:#666;
	text-decoration:none;
}
.link:hover{
	text-decoration:underline;
}
</style>
</head>


<body scroll="no" onload="Init()" >
<form id="form1" >
<div style="position:absolute;left:5px; top:0px;width:530px;">
<img src="css/trasparent.gif" width="500", height="1" />
  <table border="0" style="border:1px solid #000" cellpadding="0" cellspacing="0">
    <tr>
      <td style="width:30px;border-right:1px solid #000" id="tdClose" ><img id="imgClose" onclick="javascript:Close()" style="cursor:pointer;" src="Close.png" width="30" height="30" title="Close" alt="Close" /></td>
      <td style="width:30px;border-right:1px solid #000" id="tdSave" ><img id="imgSave" onclick="javascript:Save()" style="cursor:pointer;" src="Save.png" width="30" height="30" title="Save" alt="Save" /></td>
      <td style="width:30px;border-right:1px solid #000" id="tdUndo" ><img id="imgUndo" onclick="javascript:Undo()" style="cursor:pointer;" src="Undo.png" width="30" height="30" title="Undo" alt="Undo" /></td>
      <td style="width:30px;border-right:1px solid #000" id="tdRedo" ><img id="imgRedo" onclick="javascript:Redo()" style="cursor:pointer;" src="Redo.png" width="30" height="30" title="Redo" alt="Redo" /></td>
<?php
if ($resizeEnabled){
?> 
      <td style="width:30px;border-right:1px solid #000" id="tdResize" ><img id="imgResize" onclick="javascript:Resize()" style="cursor:pointer;" src="Resize.png" width="30" height="30" title="Resize" alt="Resize"/></td>
<?php } ?>   
<?php
if ($cropEnabled){
?>
      <td style="width:30px;border-right:1px solid #000" id="tdCrop" ><img id="imgCrop" onclick="javascript:Crop()" style="cursor:pointer;" src="Crop.png" width="30" height="30" title="Crop" alt="Crop"/></td>
<?php } ?>
<?php
if ($rotateEnabled){
?>
      <td style="width:30px;border-right:1px solid #000" id="tdRotate" ><img id="imgRotate" onclick="javascript:Rotate()" style="cursor:pointer;" src="Rotate.png" width="30" height="30" title="Rotate" alt="Rotate"/></td>
<?php } ?>
<?php
if ($flipEnabled){
?>
      <td style="width:30px;border-right:1px solid #000" id="tdFlipH" ><img id="imgFlipH" onclick="javascript:FlipH()" style="cursor:pointer;" src="FlipHorizontal.png" width="30" height="30"  title="Flip horizontal" alt="Flip horizontal"/></td>
      <td style="width:30px;border-right:1px solid #000" id="tdFlipV" ><img id="imgFlipV" onclick="javascript:FlipV()" style="cursor:pointer;" src="FlipVertical.png" width="30" height="30"  title="Flip vertical" alt="Flip vertical"/></td>
<?php } ?>
<?php
if ($watermarkEnabled){
?>
      <td style="width:30px;border-right:1px solid #000" id="tdWatermark" ><img id="imgWatermark" onclick="javascript:Watermark()" style="cursor:pointer;" src="Watermark.png" width="50" title="Watermark" height="30"  alt="Watermark"/></td>
<?php } ?>

<?php
if($createIcone){
?>
      <td style="width:30px;border-right:1px solid #000;" id="tdIcone" ><img id="imgIcone" onclick="javascript:CreateIcone()" style="cursor:pointer;" src="Icone.png" width="30" title="Icone" height="30" alt="Icone"/></td>
<?php } ?>      

<?php
if ($filtersEnabled){
?>
      <td bgcolor="#FFFFFF" id="tdFilterCombo" class="text"  valign="middle" align="center" rowspan="2" >Filters<br />&nbsp;&nbsp;<select id="cmbFilter" name="cmbFilter" onchange="javascript:ApplyFilter(this)" >
<option value=""></option>      
<option value="8">Invert</option>
<option value="9">Greyscale</option>
<option value="10">Brightness</option>
<option value="11">Contrast</option>
<option value="12">Gamma</option>
<option value="13">Color</option>
<option value="14">Smooth</option>
<option value="15">Gaussian blur</option>
<option value="23">Selective blur</option>
<option value="16">Mean removal</option>
<option value="17">Sharpen</option>
<option value="18">Emboss laplacian</option>
<option value="19">Edge detect quick</option>
        </select>&nbsp;&nbsp;</td>    
<?php } ?>
	</tr>
    <tr>
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdClose2"  align="center"><a class="link" href="javascript:Close()" title="Close">Close</a></td>
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdSave2"  align="center"><a class="link" href="javascript:Save()" title="Save">Save</a></td>
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdUndo2"  align="center"><a class="link" href="javascript:Undo()" title="Undo">Undo</a></td>
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdRedo2"  align="center"><a class="link" href="javascript:Redo()" title="Redo">Redo</a></td>
<?php
if ($resizeEnabled){
?> 
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdResize2"  align="center"><a class="link" href="javascript:Resize()" title="Resize">Resize</a></td>
<?php } ?> 
<?php
if ($cropEnabled){
?>
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdCrop2"  align="center"><a class="link" href="javascript:Crop()" title="Crop">Crop</a></td>
<?php } ?>
<?php
if ($rotateEnabled){
?>
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdRotate2"  align="center"><a class="link" href="javascript:Rotate()" title="Rotate">Rotate</a></td>
<?php } ?>
<?php
if ($flipEnabled){
?>
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdFlipH2"  align="center"><a class="link" href="javascript:FlipH()" title="Flip horizontal">Flip H</a></td>
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdFlipV2"  align="center"><a class="link" href="javascript:FlipV()" title="Flip vertical">Flip V</a></td>
<?php } ?>

<?php
if ($watermarkEnabled){
?>
      <td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdWatermark2"  align="center"><a class="link" href="javascript:Watermark()" title="Watermark">Watermark</a></td>
<?php } ?>

<?php
if($createIcone){
?>
<td bgcolor="#FFFFFF" style="width:30px;border-right:1px solid #000" id="tdIcone2" align="center"><a class="link" href="javascript:CreateIcone()" title="Icone">Icone</a></td>
<?php } ?>

    </tr>
  </table>
</div>


<table cellpadding="0" cellspacing="0" border="0" style="margin-top:50px;">
<?php
if ($cropEnabled){
?>
<tr>
<td>
  <table id="CropInfo"  style="margin-top:10px;border:1px solid #003399;display:none;" class="text" width="332" border="0" align="left" cellpadding="2" cellspacing="0">
	<tr>
	  <td width="50" align="right">x1:</td>
	  <td width="50"><input class="Box" name="x1" onfocus="blur()" type="text" id="x1" size="7" /></td>
	  <td width="50" align="right">x2:</td>
	  <td width="50"><input class="Box" name="x2" onfocus="blur()" type="text" id="x2" size="7" /></td>
	  <td width="50">&nbsp;</td>
	  <td width="50" align="right">width:</td>
	  <td width="50"><input class="Box" name="width" onfocus="blur()" type="text" id="width" size="7" /></td>
	</tr>
	<tr>
	  <td width="50" align="right">y1:</td>
	  <td width="50"><input  class="Box"name="y1" type="text" onfocus="blur()" id="y1" size="7" /></td>
	  <td width="50" align="right">y2:</td>
	  <td width="50"><input class="Box" name="y2" type="text" onfocus="blur()" id="y2" size="7" /></td>
	  <td width="50">&nbsp;</td>
	  <td width="50" align="right">height:</td>
	  <td width="50"><input class="Box" name="height" type="text" onfocus="blur()" id="height" size="7" /></td>
	  </tr>
	<tr>
	  <td colspan="7" align="center"><input type="button" name="btnConfirmCrop" value="Confirm crop" onclick="javascript:ConfirmCrop()" />&nbsp;&nbsp;<input type="button" name="btnAnnulla" value="Cancel crop" onclick="javascript:CancelCrop()" /></td>
	  </tr>
</table>
    </td>
    </tr>
<?php } ?> 
    <tr>

<td>  

<table align="left" border="0" cellpadding="0" cellspacing="5">
  <tr>
  <td>
	<div id="imageWrap">
		<img id="mainImage" src="" alt="" />
  	</div>
</td>

<?php if($resize_thumb_m == "true") { ?>
<td valign="top">
	<div id="thumb_1_wrap">
		<img id="thumb_1_image" src="" alt="" />
  	</div>
</td>
<?php } ?> 
<?php if($resize_thumb_s == "true") { ?>
<td valign="top">
	<div id="thumb_2_wrap">
		<img id="thumb_2_image" src="" alt="" />
  	</div>
</td>
<?php } ?> 




<td valign="top">
	<div id="icone_wrap">
		<img id="icone_image" src="" alt="" />
  	</div>
</td>



  </tr>
  </table>
  
  </td>
  </tr>
</table>


</form>


<div id="divColor" title="Color" style="display:none;">
<form onsubmit="return false">
<table class="text" border="0" align="left" cellpadding="2" cellspacing="0">
	<tr>
	  <td colspan="3" align="center">Enter value from -255 to 255</td>
  </tr>
	<tr>
	  <td align="left">Red:</td>
	  <td ><input class="Box" style="font-size:12px" name="txtColorRed" type="text" id="txtColorRed" maxlength="4" size="2" /></td>
      <td >
      	<div style="width:100px;margin-left:10px;" id="divColorSlider_1"></div>
      </td>
	  </tr>
      
      <tr>
	  <td align="left">Green:</td>
	  <td ><input class="Box" style="font-size:12px" name="txtColorGreen" type="text" id="txtColorGreen" maxlength="4" size="2" /></td>
      <td >
      	<div style="width:100px;margin-left:10px;" id="divColorSlider_2"></div>
      </td>
	  </tr>
      
      <tr>
	  <td align="left">Blue:</td>
	  <td ><input class="Box" style="font-size:12px" name="txtColorBlue" type="text" id="txtColorBlue" maxlength="4" size="2" /></td>
      <td >
      	<div style="width:100px;margin-left:10px;" id="divColorSlider_3"></div>
      </td>
	  </tr>
</table>
</form>
</div>


<div id="divGamma" title="Gamma" style="display:none;">
<form onsubmit="return false">
<table class="text" border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
            <td colspan="3" align="center">
                Enter values between 0.2 and 5.0
            </td>
        </tr>
        <tr>
            <td nowrap="nowrap" align="LEFT">
                Red:
            </td>
            <td >
                <input class="Box" name="txtGammaRed" style="font-size:12px" type="text" id="txtGammaRed" maxlength="4" value="1" size="2" />
            </td>
            <td >
            	<div style="width:100px;margin-left:10px;" id="divGammaSlider_1"></div>
            </td>
        </tr>
        <tr>
            <td nowrap="nowrap" align="LEFT">
                Green:
            </td>
            <td>
                <input class="Box" name="txtGammaGreen"  style="font-size:12px" type="text" id="txtGammaGreen" maxlength="4" value="1" size="2" />
            </td>
            <td >
            	<div style="width:100px;margin-left:10px;" id="divGammaSlider_2"></div>
            </td>
        </tr>
        <tr>
            <td nowrap="nowrap" align="left">
                Blue:
            </td>
            <td>
                <input class="Box" name="txtGammaBlue"  style="font-size:12px" type="text" id="txtGammaBlue" maxlength="4" value="1" size="2" />
            </td>
            <td >
            	<div style="width:100px;margin-left:10px;" id="divGammaSlider_3"></div>
            </td>
        </tr>        
    </table>
</form>
</div>





<div id="divParameter" title="Parameters" style="display:none;">
<form onsubmit="return false">
<table class="text" width="90%" border="0" align="left" cellpadding="2" cellspacing="0">
        <tr>
            <td align="left">
                Parameter:
            </td>
            <td >
                <input class="Box" style="font-size:12px" name="txtParam" type="text" id="txtParam" maxlength="4" size="4" />
            </td>
            <td >
            	<div style="width:90px;margin-left:10px;" id="divParameterSlider_1"></div>
            </td>
        <tr>
    </table>
</form>
</div>





<div id="divResize" style="display:none;visibility:hidden">
<form onsubmit="return false">

<table class="text"  border="0" align="center"
        cellpadding="2" cellspacing="0">
        <tr>
            <td colspan="2" align="center">&nbsp;
                
            </td>
        </tr>
        <tr>
            <td align="right">
                Current width:
            </td>
            <td id="tdCurrentWidth">&nbsp;</td>
        </tr>
        <tr>
            <td width="50%" align="right">
                Current height:
            </td>
            <td width="50%" id="tdCurrentHeight">&nbsp;</td>
        </tr>
        <tr>
            <td width="50%" align="right">
                Width:
            </td>
            <td width="50%">
                <input class="Box" style="font-size:12px" name="txtWidth" type="text" id="txtWidth"
                    size="4" />
                px
            </td>
        </tr>
        <tr>
            <td width="50%" align="right">
                Height:
            </td>
            <td width="50%">
                <input class="Box" style="font-size:12px" name="txtHeight" type="text" id="txtHeight"
                    size="4" />
                px
            </td>
        </tr>
    </table>
</form>
</div>




<div id="divWatermark" style="display:none;visibility:hidden">
<form onsubmit="return false">

<table class="text" border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
            <td align="right">
                Type:
            </td>
            <td align="left">
                <input type="radio" name="radio_type" checked="checked" id="radio_text" value="radio" /><label for="radio_text">Text</label>
                &nbsp;&nbsp;
                <input type="radio" name="radio_type" id="radio_image" value="radio2" /><label for="radio_image">Image</label>
            </td>
        </tr>
        <tr>
            <td align="right" nowrap="nowrap">
                Text:
            </td>
            <td >
                <input class="Box" style="font-size:12px" name="txtWatermark" type="text" id="txtWatermark" size="40" />
            </td>
        </tr>
        <tr>
            <td align="right" nowrap="nowrap">
                Position:
            </td>
            <td>
                <select id="cmbPosition" style="font-size:12px" name="cmbPosition">
                    <option value="top_left">Top left</option>
                    <option value="top_center">Top center</option>
                    <option value="top_right">Top right</option>
                    <option value="middle_left">Middle left</option>
                    <option value="middle_center" selected="selected">Middle center</option>
                    <option value="middle_">Middle right</option>
                    <option value="bottom_left">Bottom left</option>
                    <option value="bottom_center">Bottom center</option>
                    <option value="bottom_right">Bottom right</option>
                    <option value="repeat1">Repeat 1 line</option>
                    <option value="repeat2">Repeat 2 line</option>
                    <option value="repeat3">Repeat 3 line</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" nowrap="nowrap">
                Font face:
            </td>
            <td>
                <select id="cmbFontFace" style="font-size:12px" name="cmbFontFace">                   
                </select>
            </td>
        </tr>
        <tr>
            <td align="right" nowrap="nowrap">
                Font color:
            </td>
            <td>
                <input name="txtFontColor" style="font-size:12px" type="text" class="color" id="txtFontColor" value="#000000"
                    size="15" />
            </td>
        </tr>
        <tr>
            <td align="right" nowrap="nowrap">
                Font size:
            </td>
            <td>
                <input name="txtFontSizeBig" style="font-size:12px" type="text" class="Box" id="txtFontSizeBig" value="14"
                    size="5" maxlength="2" />&nbsp;px&nbsp;&nbsp;( Image )
            </td>
        </tr>
        <tr>
            <td align="right" nowrap="nowrap">
                Font size:
            </td>
            <td>
                <input name="txtFontSizeMedium" style="font-size:12px" type="text" class="Box" id="txtFontSizeMedium" value="10"
                    size="5" maxlength="2" />
                &nbsp;px&nbsp;&nbsp;( 1° thumb - 0 no watermark)
            </td>
        </tr>
        <tr>
            <td align="right" nowrap="nowrap">
                Font size:
            </td>
            <td>
                <input name="txtFontSizeSmall" style="font-size:12px" type="text" class="Box" id="txtFontSizeSmall" value="8"
                    size="5" maxlength="2" />&nbsp;px&nbsp;&nbsp;( 2° thumb - 0 no watermark)
            </td>
        </tr>
    </table>


</form>
</div>





<div id="divIcone" style="display:none;visibility:hidden">
<form onsubmit="return false">
<table class="text" border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
          <td align="right">&nbsp;</td>
          <td align="right">Sizes: </td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td width="14%" align="right">&nbsp;</td>
          <td width="41%"><input type="checkbox" name="ico_16" id="ico_16" />
            <label for="ico_16">16 x 16 </label></td>
          <td width="45%"><input type="checkbox" name="ico_24" id="ico_24" />
            <label for="ico_24">24  x 24 </label></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="checkbox" name="ico_32" id="ico_32" />
          <label for="ico_32">32 x 32 </label></td>
          <td><input type="checkbox" name="ico_48" id="ico_48" />
          <label for="ico_48">48 x 48 </label></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="checkbox" name="ico_96" id="ico_96" />
          <label for="ico_96">96 x 96 </label></td>
          <td nowrap="nowrap"><input type="checkbox" name="ico_128" id="ico_128" />
          <label for="ico_128">128 x 128 </label></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="checkbox" name="ico_256" id="ico_256" />
          <label for="ico_256">256 x 256 </label></td>
          <td nowrap="nowrap"><input type="checkbox" name="ico_512" id="ico_512" />
          <label for="ico_512">512 x 512 </label></td>
        </tr>
    </table>
</form>
</div>



</body>
</html>
