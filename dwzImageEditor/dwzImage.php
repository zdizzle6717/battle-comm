<?php
class dwzImage {
   
	var $image;
	var $image_type;
	
	function load($filename) {
		$image_info = getimagesize($filename);
		$this->image_type = $image_info[2];
		if( $this->image_type == IMAGETYPE_JPEG ) {
			$this->image = imagecreatefromjpeg($filename);
		} elseif( $this->image_type == IMAGETYPE_GIF ) {
			$this->image = imagecreatefromgif($filename);
		} elseif( $this->image_type == IMAGETYPE_PNG ) {
			$this->image = imagecreatefrompng($filename);
		}elseif( $this->image_type == IMAGETYPE_WBMP ) {
			$this->image = imagecreatefromwbmp($filename);
		}else{
			return false;
		}
		return true;
	}
			
	function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
		if( $image_type == IMAGETYPE_JPEG ) {
			imagejpeg($this->image,$filename,$compression);
		} elseif( $image_type == IMAGETYPE_GIF ) {
			imagegif($this->image,$filename);         
		} elseif( $image_type == IMAGETYPE_PNG ) {
			imagepng($this->image,$filename);
		} elseif( $image_type == IMAGETYPE_WBMP ) {
			image2wbmp($this->image,$filename);
		}		
		if( $permissions != null) {
			chmod($filename,$permissions);
		}
	}
	
	function GetImageSize(){
		$arr = array();
		$arr[] = $this->getWidth();
		$arr[] = $this->getHeight();
		return $arr;
	}
	
	function GetImageType(){
		return $this->image_type;
	}
	function output($image_type=IMAGETYPE_JPEG) {
		if( $image_type == IMAGETYPE_JPEG ) {
			imagejpeg($this->image);
		} elseif( $image_type == IMAGETYPE_GIF ) {
			imagegif($this->image);         
		} elseif( $image_type == IMAGETYPE_PNG ) {
			imagepng($this->image);
		} elseif( $image_type == IMAGETYPE_WBMP ) {
			image2wbmp($this->image);
		}   
	}
	function getWidth() {
		return imagesx($this->image);
	}
	function getHeight() {
		return imagesy($this->image);
	}
	
	function resizeToHeight($height) {
		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resize($width,$height);
	}
	function resizeToWidth($width) {
		$ratio = $width / $this->getWidth();
		$height = $this->getheight() * $ratio;
		$this->resize($width,$height);
	}
	function scale($scale) {
		$width = $this->getWidth() * $scale/100;
		$height = $this->getheight() * $scale/100; 
		$this->resize($width,$height);
	}
	
	function resize($width,$height) {
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;   
	}
   
	function resizeToRectangle($width,$height,$keep_ratio){
		$newW;
		$newH;
		
		$img_width = doubleval($this->getWidth());
		$img_height = doubleval($this->getHeight());
		
		if($keep_ratio == "-1"){
			$ratio_width = $img_width / doubleval($width);
			$ratio_height = $img_height / doubleval($height);
			
			if($ratio_width < 1 && $ratio_height < 1){
				$newW = $img_width;
				$newH = $img_height;
			}else if ($ratio_width > $ratio_height){
				$newW = ceil($img_width / $ratio_width);
				$newH = ceil($img_height / $ratio_width);
			}else{
				$newW = ceil($img_width / $ratio_height);
				$newH = ceil($img_height / $ratio_height);
			}			
		}else{			
			if ($img_width > $height){
				$newH = $height;
			}else{
				$newH = $img_height;
			}			
			if ($img_width > $width ){
				$newW = $width;
			}else{
				$newW = $img_width;
			}
		}
		$this->resize(intval($newW), intval($newH));
	}
   	
	function addWatermarkText($testo, $font, $size, $color, $Pos){
		
		$box = $this->calculateTextBox($size, 0, $font, $testo);
				
		if($box === false){
			return;
		}
		
		$ricalcola;
		$sLine = 1;
		$cStep = 0;
		
		while(true){
			$ricalcola = false;
			
			$txt_position = $this->getWatermarkTextPosition($this->getWidth(), 
													$this->getHeight(), 
													$box["width"],
													$box["height"],
													$Pos,									
													$cStep,
													$sLine);
			
			//echo var_dump($txt_position) ."\n\n";
						
			$PosX = $txt_position["x"];
			$PosY = $txt_position["y"];
					
			if ($txt_position["x"] == -1){
				if ($Pos == "repeat2" && $sLine == 1){
					$cStep = 0;
					$PosX = 0;
					$PosY = 0;
					$sLine = 2;
					$ricalcola = true;
				}elseif( $Pos == "repeat3" && $sLine == 1){
					$cStep = 0;
					$PosX = 0;
					$PosY = 0;
					$sLine = 2;
					$ricalcola = true;
				}elseif($Pos == "repeat3" && $sLine == 2){
					$cStep = 0;
					$PosX = 0;
					$PosY = 0;
					$sLine = 3;
					$ricalcola = true;
				}else{
					break;
				}
			}
			
			if(!$ricalcola){
				$cStep += 1;
				$PosX += 10;
				$PosY += 10;
				
				$col = $this->rgb2array($color);
				$int_col = imagecolorallocate ($this->image, $col[0], $col[1], $col[2]);
				$result = imagettftext ($this->image, $size, 0, $PosX, $PosY, $int_col, $font, $testo);
			}
			if( $Pos != "repeat1" && $Pos != "repeat2" && $Pos != "repeat3"){
				break;
			}
		}
		
		//exit();
	}
	
	function addWatermarkImage($watermark_path, $pos){
		$part_info = getimagesize($watermark_path);
		$part_type = $part_info[2];
		$part_image;
		if( $part_type == IMAGETYPE_JPEG ) {
			$part_image = imagecreatefromjpeg($watermark_path);
		}elseif( $part_type == IMAGETYPE_GIF ) {
			$part_image = imagecreatefromgif($watermark_path);
		}elseif( $part_type == IMAGETYPE_PNG ) {
			$part_image = imagecreatefrompng($watermark_path);
		}elseif( $part_type == IMAGETYPE_WBMP ) {
			$part_image = imagecreatefromwbmp($watermark_path);
		}else{
			return false;
		}
				
		$pos = $this->getWatermarkImagePosition($this->getWidth(),
									 		$this->getHeight(),
									 		imagesx($part_image),
									 		imagesy($part_image),
								 			$pos);
		
		imagecopy ( $this->image, $part_image, $pos[0], $pos[1], 0, 0, imagesx($part_image), imagesy($part_image) );
		imagedestroy( $part_image ); 
		
		return true;
	}
	
	function roundAngle($angle_path){
		$angle_info = getimagesize($angle_path);
		$angle_type = $angle_info[2];
		$angle_image;
		if( $angle_type == IMAGETYPE_JPEG ) {
			$angle_image = imagecreatefromjpeg($angle_path);
		}elseif( $angle_type == IMAGETYPE_GIF ) {
			$angle_image = imagecreatefromgif($angle_path);
		}elseif( $angle_type == IMAGETYPE_PNG ) {
			$angle_image = imagecreatefrompng($angle_path);
		}elseif( $angle_type == IMAGETYPE_WBMP ) {
			$angle_image = imagecreatefromwbmp($angle_path);
		}else{
			return false;	
		}
		
		$w = imagesx($angle_image);
		$h = imagesy($angle_image);
		$dest_x = 0;
		$dest_y = 0;
		imagecopy( $this->image, $angle_image, $dest_x, $dest_y, 0, 0, $w, $h );
		
		$angle_image = imagerotate($angle_image, -90, 0);
		$w = imagesx($angle_image);
		$h = imagesy($angle_image);
		$dest_x = $this->getWidth() - $w;
		$dest_y = 0;
		imagecopy ( $this->image, $angle_image, $dest_x, $dest_y, 0, 0, $w, $h );
		
		$angle_image = imagerotate($angle_image, -90, 0);
		$w = imagesx($angle_image);
		$h = imagesy($angle_image);
		$dest_x = $this->getWidth() - $w;
		$dest_y = $this->getHeight() - $h;
		imagecopy ( $this->image, $angle_image, $dest_x, $dest_y, 0, 0, $w, $h );
		
		$angle_image = imagerotate($angle_image, -90, 0);
		$w = imagesx($angle_image);
		$h = imagesy($angle_image);
		$dest_x = 0;
		$dest_y = $this->getHeight() - $h;
		imagecopy ( $this->image, $angle_image, $dest_x, $dest_y, 0, 0, $w, $h );
		
		imagedestroy( $angle_image ); 
		
		return true;
	}
	
	
	function crop($x1, $y1, $x2, $y2, $full_path){
		$w = $x2 - $x1;
		$h = $y2 - $y1;
		$crop = imagecreatetruecolor($w, $h);
		imagecopy ($crop, $this->image, 0, 0, $x1, $y1, $w, $h );
		
		if($full_path == NULL){
			$this->image = $crop;
		}else{
			if( $this->image_type == IMAGETYPE_JPEG ) {
				$this->image = imagejpeg($crop, $full_path, 100);
			}elseif( $this->image_type == IMAGETYPE_GIF ) {
				$this->image = imagegif($crop, $full_path);
			}elseif( $this->image_type == IMAGETYPE_PNG ) {
				$this->image = imagepng($crop, $full_path);
			}elseif( $this->image_type == IMAGETYPE_WBMP ) {
				$this->image = imagewbmp($crop, $full_path);
			}else{
				return false;	
			}
		}
		//imagedestroy( $crop ); 
	}
	
	function Brightness($nBrightness){
		imagefilter($this->image, IMG_FILTER_BRIGHTNESS, $nBrightness);			
	}
	
	function Color($red, $green, $blue){
		imagefilter($this->image, IMG_FILTER_COLORIZE, $red, $green, $blue);
	}
		
	function Contrast($nContrast){
		imagefilter($this->image, IMG_FILTER_CONTRAST, $nContrast);		
	}
	
	function EdgeDetectQuick(){	
		imagefilter($this->image, IMG_FILTER_EDGEDETECT);
	}
	
	function EmbossLaplacian(){
		imagefilter($this->image, IMG_FILTER_EMBOSS);
	}
	
	function FlipH(){
		imageflip($this->image, IMG_FLIP_HORIZONTAL);		
	}
	
	function FlipV(){
		imageflip($this->image, IMG_FLIP_VERTICAL);
	}
	
	function Gamma($input_gamma, $output_gamma){
		imagegammacorrect($this->image, $input_gamma, $output_gamma);
	}
	
	function SelectiveBlur(){
		imagefilter($this->image, IMG_FILTER_SELECTIVE_BLUR);
	}
	
	function GaussianBlur(){
		imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
	}
	
	function GrayScale(){
		imagefilter($this->image, IMG_FILTER_GRAYSCALE);
	}
	
	function Invert(){
		imagefilter($this->image, IMG_FILTER_NEGATE);
	}
	
	function MeanRemoval(){
		imagefilter($this->image, IMG_FILTER_MEAN_REMOVAL);
	}
	
	function Rotate(){
		$rotate = imagerotate($this->image, 90, 0);
		if($rotate  !== false){			
			$this->image = $rotate;
		}
	}
	
	function Sharpen($nWeight){
		$emboss = array();
		$emboss[] = array(0.0, -2.0, 0.0);
		$emboss[] = array(-2.0, $nWeight, -2.0);
		$emboss[] = array(0.0, -2.0, 0.0);
		$factor = $nWeight - 8.0;
		imageconvolution($this->image, $emboss, $factor, 8);		
	}
	
	function Smooth($nWeight){
		imagefilter($this->image, IMG_FILTER_SMOOTH, $nWeight);
	}
	
	
	
	
	
	
	
	function getWatermarkImagePosition($iWidth, 
										$iHeight,
										$wWidth,
										$wHeight,
										$pos){
											
		$pos = strtolower($pos);
		switch($pos){
		case "top_left":
			$xPos = 0;
			$yPos = 0;
			break;
		case "top_center":
			$xPos = round(($iWidth - $wWidth) / 2.0, 0);
			$yPos = 0;
			break;
		case "top_right":
			$xPos = $iWidth - $wWidth;
			$yPos = 0;
			break;
		case "middle_left":
			$xPos = 0;
			$yPos = round(($iHeight / 2.0) - ($wHeight / 2.0), 0);
			break;
		case "middle_center":
			$xPos = round(($iWidth - $wWidth) / 2.0, 0);
			$yPos = round(($iHeight / 2.0) - ($wHeight / 2.0), 0);
			break;
		case "middle_right":
			$xPos = $iWidth - $wWidth;
			$yPos = round(($iHeight / 2.0) - ($wHeight / 2.0), 0);
			break;
		case "bottom_left":
			$xPos = 0;
			$yPos = $iHeight - $wHeight;
			break;
		case "bottom_center":
			$xPos = round(($iWidth - $wWidth) / 2.0);
			$yPos = $iHeight - $wHeight;
			break;
		case "bottom_right":
			$xPos = $iWidth - $wWidth;
			$yPos = $iHeight - $wHeight;
			break;
		default:
			$xPos = $iWidth - $wWidth;
			$yPos = $iHeight - $wHeight;
			break;
		}
		return array($xPos, $yPos);
	}
	
	
	
	
	function getWatermarkTextPosition($iWidth, 
										$iHeight, 
										$wWidth,
										$wHeight,
										$Pos,									
										$cStep,
										$sLine){
	
		switch($Pos){
		case "top_left":
			$xPos = 0;
			$yPos = 10;
			break;
		case "top_center";
			$xPos = round(($iWidth - $wWidth) / 2.0, 0);
			$yPos = 10;
			break;
		case "top_right":
			$xPos = $iWidth - $wWidth;
			$yPos = 10;
			break;
		case "middle_left":
			$xPos = 0;
			$yPos = round(($iHeight / 2.0) - ($wHeight / 2.0), 0);
			break;
		case "middle_center":
			$xPos = round(($iWidth - $wWidth) / 2.0, 0);
			$yPos = round(($iHeight / 2.0) - ($wHeight / 2.0), 0);
			break;
		case "middle_right":
			$xPos = $iWidth - $wWidth;
			$yPos = round(($iHeight / 2.0) - ($wHeight / 2.0), 0);
			break;
		case "bottom_left":
			$xPos = 0;
			$yPos = $iHeight - $wHeight;
			break;
		case "bottom_center":
			$xPos = round(($iWidth - $wWidth) / 2.0, 0);
			$yPos = $iHeight - $wHeight;
			break;
		case "bottom_right":
			$xPos = $iWidth - $wWidth;
			$yPos = $iHeight - $wHeight;
			break;
		case "repeat1":
			
			$yPos = round($iHeight - ($wHeight / 2.0), 0);
			$xPos = ($wWidth * 2.0) * $cStep;
			if($xPos >= $iWidth){
				$xPos = -1;
			}
			break;
		case "repeat2":
			if ($sLine == 1){
				 $yPos = round(($iHeight / 3.0) - ($wHeight / 2.0), 0);
			}else{
				$yPos = round(($iHeight / 3.0 * 2) - ($wHeight / 2.0), 0);
			}
			
			$xPos = ($wWidth * 2.0) * $cStep;
			
			if($xPos + $wWidth > $iWidth){
				$xPos = -1;
			}
			
			if($xPos >= $iWidth){
				$xPos = -1;
			}
			break;
		case "repeat3":
			
			if($sLine == 1){
				$yPos = 10;
			}elseif($sLine == 2){
				$yPos = round(($iHeight / 2.0) - ($wHeight / 2.0), 0);
			}else{
				$yPos = $iHeight - $wHeight;
			}
			
			$xPos = ($wWidth * 2.0) * $cStep;
			
			if($xPos + $wWidth > $iWidth){
				$xPos = -1;
			}
			if($xPos >= $iWidth){
				$xPos = -1;
			}
			break;
		default:
			$xPos = $iWidth - $wWidth;
			$yPos = $iHeight - $wHeight;
		}
		return array("x" => $xPos, "y" => $yPos);
	}

	function calculateTextBox($font_size, $font_angle, $font_file, $text) { 
		$box   = imagettfbbox($font_size, $font_angle, $font_file, $text); 
		if( !$box ) 
		return false; 
		$min_x = min( array($box[0], $box[2], $box[4], $box[6]) ); 
		$max_x = max( array($box[0], $box[2], $box[4], $box[6]) ); 
		$min_y = min( array($box[1], $box[3], $box[5], $box[7]) ); 
		$max_y = max( array($box[1], $box[3], $box[5], $box[7]) ); 
		$width  = ( $max_x - $min_x ); 
		$height = ( $max_y - $min_y ); 
		$left   = abs( $min_x ) + $width; 
		$top    = abs( $min_y ) + $height; 
		// to calculate the exact bounding box i write the text in a large image 
		$img     = @imagecreatetruecolor( $width << 2, $height << 2 ); 
		$white   =  imagecolorallocate( $img, 255, 255, 255 ); 
		$black   =  imagecolorallocate( $img, 0, 0, 0 ); 
		imagefilledrectangle($img, 0, 0, imagesx($img), imagesy($img), $black); 
		// for sure the text is completely in the image! 
		imagettftext( $img, $font_size, 
					$font_angle, $left, $top, 
					$white, $font_file, $text); 
		// start scanning (0=> black => empty) 
		$rleft  = $w4 = $width<<2; 
		$rright = 0; 
		$rbottom   = 0; 
		$rtop = $h4 = $height<<2; 
		for( $x = 0; $x < $w4; $x++ ) 
		for( $y = 0; $y < $h4; $y++ ) 
		  if( imagecolorat( $img, $x, $y ) ){ 
			$rleft   = min( $rleft, $x ); 
			$rright  = max( $rright, $x ); 
			$rtop    = min( $rtop, $y ); 
			$rbottom = max( $rbottom, $y ); 
		  } 
		// destroy img and serve the result 
		imagedestroy( $img ); 
		return array( "left"   => $left - $rleft, 
					"top"    => $top  - $rtop, 
					"width"  => $rright - $rleft + 1, 
					"height" => $rbottom - $rtop + 1 ); 
	} 

	/**
	 * Convert color from hex in XXXXXX (eg. FFFFFF, 000000, FF0000) to array(R, G, B)
	 * of integers (0-255).
	 *
	 * name: rgb2array
	 * author: Yetty
	 * @param $color hex in XXXXXX (eg. FFFFFF, 000000, FF0000)
	 * @return string; array(R, G, B) of integers (0-255)
	 */
	function rgb2array($rgb) {
		if(substr($rgb,0,1) == "#"){
			$rgb = substr($rgb,1);
		}
		return array(
			base_convert(substr($rgb, 0, 2), 16, 10),
			base_convert(substr($rgb, 2, 2), 16, 10),
			base_convert(substr($rgb, 4, 2), 16, 10),
		);
	}
	

}
?>