<?php
include("dwzString.php");
include("dwzIO.php");

class WebImageEditor
{
	
	var $cong,
	$Root,
	$ReloadPage,
	$DialogWidth,
	$DialogHeight,
	$Bgcolor,
	$ImagePath,
	$ImageTempPath,
	//$LockBodyColor,
	//$LockBodyPercentage,
	$theme, 
		
	$ResizeEnabled,
	$CropEnabled,
	$FlipEnabled ,
	$RotateEnabled,
	$FiltersEnabled,	
	$WatermarkEnabled,
	$WatermarkText,
	$WatermarkImage,
	$createIcone,
	
	$WatermarkImageBig,
	$WatermarkImageMedium,
	$WatermarkImageSmall ,
		
	$ImageMaxWidth,
	$ImageMaxHeight,
	$ImageMinWidth,
	$ImageMinHeight,
	$ImageKeepAspectRatio,
	$ImageJpegQuality,
	
	$ResizeThumbMedium,
	$ResizeThumbMediumWidth,
	$ResizeThumbMediumHeight,
	$ResizeThumbMediumSuffix,
	$ResizeThumbMediumSuffixPosition,
	
	$ResizeThumbSmall,
	$ResizeThumbSmallWidth,
	$ResizeThumbSmallHeight,
	$ResizeThumbSmallSuffix,
	$ResizeThumbSmallSuffixPosition;

	function Init(){
		$this->cong = "@_@";
	}
	
	function SetParams($param){
		$tmp = preg_split("/". $this->cong ."/", $param);
		$this->Root = $tmp[0];
		$this->ReloadPage = $tmp[1];
		$this->DialogWidth = $tmp[2];
		$this->DialogHeight = $tmp[3];
		$this->Bgcolor = $tmp[4];
		$this->ImagePath = $this->ConvertToAbsolutePath($this->GetDynamicValue($tmp[5]));
		$this->ImageTempPath = $this->ConvertToAbsolutePath($this->GetDynamicValue($tmp[6]));
		if(substr($this->ImageTempPath, -1) != "/"){
			$this->ImageTempPath = $this-> ImageTempPath ."/";
		}
		//$this->LockBodyColor = $tmp[7];
		//$this->LockBodyPercentage = preg_replace("/,/", ".", strval(round(doubleval($tmp[8]) / 100.0, 2)));		
		$this->ResizeEnabled = $tmp[9];
		$this->CropEnabled = $tmp[10];
		$this->FlipEnabled = $tmp[11];
		$this->RotateEnabled = $tmp[12];
		$this->FiltersEnabled = $tmp[13];
		$this->WatermarkEnabled = $tmp[14];
		$this->WatermarkText = $tmp[15];
		$this->WatermarkImage = $tmp[16];
		$this->WatermarkImageBig = $this->ConvertToAbsolutePath($this->GetDynamicValue($tmp[17]));
		$this->WatermarkImageMedium = $this->ConvertToAbsolutePath($this->GetDynamicValue($tmp[18]));
		$this->WatermarkImageSmall = $this->ConvertToAbsolutePath($this->GetDynamicValue($tmp[19]));
		
		$this->ImageMaxWidth = $tmp[20];
		$this->ImageMaxHeight = $tmp[21];
		$this->ImageMinWidth = $tmp[22];
		$this->ImageMinHeight = $tmp[23];
		$this->ImageKeepAspectRatio = $tmp[24];
		$this->ImageJpegQuality = $tmp[25];
		
		$this->ResizeThumbMedium = $tmp[26];
		$this->ResizeThumbMediumWidth = $tmp[27];
		$this->ResizeThumbMediumHeight = $tmp[28];
		$this->ResizeThumbMediumSuffix = $tmp[29];
		$this->ResizeThumbMediumSuffixPosition = $tmp[30];
		
		$this->ResizeThumbSmall = $tmp[31];
		$this->ResizeThumbSmallWidth = $tmp[32];
		$this->ResizeThumbSmallHeight = $tmp[33];
		$this->ResizeThumbSmallSuffix = $tmp[34];
		$this->ResizeThumbSmallSuffixPosition = $tmp[35];		
		
		if(count($tmp) > 36){
			$this->createIcone = $tmp[36];
		}else{
			$this->createIcone = "false";
		}
		
		if(count($tmp) > 37){
			$this->theme = $tmp[37];
		}else{
			$this->theme = "cupertino";
		}
		
	}
	
	function InsertCode(){
		$params = $this->CreateParams();
		echo "javascript:dwzOpenImageEditor(" .$params .")";
	}
	
	function CreateParams(){
		
		$params = "";
		$params .= "'" .$this->Root ."'";
		$params .= ",'" .$this->ReloadPage ."'";
		$params .= ",'" .$this->DialogWidth ."'";
		$params .= ",'" .$this->DialogHeight ."'";
		$params .= ",'" .$this->Bgcolor ."'";
		$params .= ",'" .$this->ImagePath ."'";
		$params .= ",'" .$this->ImageTempPath ."'";
		$params .= ",'" .$this->ResizeEnabled  ."'";
		$params .= ",'" .$this->CropEnabled ."'";
		$params .= ",'" .$this->FlipEnabled ."'";
		$params .= ",'" .$this->RotateEnabled ."'";
		$params .= ",'" .$this->WatermarkEnabled ."'";
		$params .= ",'" .$this->WatermarkText ."'";
		$params .= ",'" .$this->WatermarkImage ."'";
		$params .= ",'" .$this->WatermarkImageBig ."'";
		$params .= ",'" .$this->WatermarkImageMedium ."'";
		$params .= ",'" .$this->WatermarkImageSmall  ."'";
		$params .= ",'" .$this->FiltersEnabled ."'";
		
		$params .= ",''"; //.$this->LockBodyColor ."'";
		$params .= ",''"; //.$this->LockBodyPercentage ."'";
		
		$params .= ",'" .$this->ImageMaxWidth ."'";
		$params .= ",'" .$this->ImageMaxHeight ."'";
		$params .= ",'" .$this->ImageMinWidth ."'";
		$params .= ",'" .$this->ImageMinHeight ."'";
		$params .= ",'" .$this->ImageKeepAspectRatio ."'";
		$params .= ",'" .$this->ImageJpegQuality ."'";
		
		$params .= ",'" .$this->ResizeThumbMedium ."'";
		$params .= ",'" .$this->ResizeThumbMediumWidth ."'";
		$params .= ",'" .$this->ResizeThumbMediumHeight ."'";
		$params .= ",'" .$this->ResizeThumbMediumSuffix ."'";
		$params .= ",'" .$this->ResizeThumbMediumSuffixPosition ."'";
		
		$params .= ",'" .$this->ResizeThumbSmall ."'";
		$params .= ",'" .$this->ResizeThumbSmallWidth ."'";
		$params .= ",'" .$this->ResizeThumbSmallHeight ."'";
		$params .= ",'" .$this->ResizeThumbSmallSuffix ."'";
		$params .= ",'" .$this->ResizeThumbSmallSuffixPosition ."'";
		$params .= ",'" .$this->GetFontsList() ."'";
		
		$params .= ",'" .$this->createIcone ."'";
		$params .= ",'" .$this->theme ."'";
				
		return $params;
	}
	
	function GetFontsList(){
		$list = "";			
		if ($handle = opendir(dwzIO::GetRealPath($this->Root .'dwzImageEditor/fonts'))) {					
			/* This is the correct way to loop over the directory. */
			while (false !== ($entry = readdir($handle))) {
				
				//echo substr(strtolower($entry), -4);
				//exit();
				
				if($entry != "." && $entry != "" && substr(strtolower($entry), -4) == ".ttf"){
					if($list != ""){
						$list .= ";";
					}
					$list .= substr($entry, 0, strlen($entry) - 4);
				}
			}		
			closedir($handle);
		}
		return $list;
	}
	
	function ParseDynamicValue($str){
		if(strlen(trim($str)) == 0){
			return "";
		}
		
		$str = trim($str);
				
		$valore = $str;
		$matches;
		$pattern = array();
		
		$pattern[] = "/\\\$row_([\w\d]+)\[['\"]+([\w\d\s]*)['\"]+/";
		$pattern[] = "/\\\$_SESSION\[['\"]+([\w\d\s]*)['\"]+/";
		$pattern[] = "/\\\$_REQUEST\[['\"]+([\w\d\s]*)['\"]+/";
		$pattern[] = "/\\\$_POST\[['\"]+([\w\d\s]*)['\"]+/";
		$pattern[] = "/\\\$_GET\[['\"]+([\w\d\s]*)['\"]+/";
		$pattern[] = "/\\\$_COOKIE\[['\"]+([\w\d\s]*)['\"]+/";
		$pattern[] = "/\\\$_SERVER\[['\"]+([\w\d\s]*)['\"]+/";
		$pattern[] = "/\\\$_ENV\[['\"]+([\w\d\s]*)['\"]+/";
		$pattern[] = "/\\\$GLOBALS\[['\"]+([\w\d\s]*)['\"]+/";		
		$pattern[] = "/dwzGetRecValue\(['\"]+([\w\d\s]+)['\"]+\s*,\s*['\"]+([\w\d\s]+)/";
		$pattern[] = "/^([\w]+)\(/";
		
		$index = -1;
		for($p=0; $p<count($pattern); $p++){
			if(preg_match_all($pattern[$p], $valore, $matches) !== false){
				if(!empty($matches[1]) && count($matches[1]) > 0){
					$index = $p;
					break;
				}
			}
		}
				
		//if($matches && (count($matches) == 2 || count($matches) == 3)){
		switch($index){
			case 0:	$valore = $GLOBALS["row_" .$matches[1][0]][$matches[2][0]]; break;
			case 1:	$valore = $_SESSION[$matches[1][0]]; break;
			case 2:	$valore = $_REQUEST[$matches[1][0]]; break;
			case 3:	$valore = $_POST[$matches[1][0]]; break;
			case 4:	$valore = $_GET[$matches[1][0]]; break;
			case 5:	$valore = $_COOKIE[$matches[1][0]]; break;
			case 6:	$valore = $_SERVER[$matches[1][0]]; break;
			case 7:	$valore = $_ENV[$matches[1][0]]; break;
			case 8:	$valore = $GLOBALS[$matches[1][0]]; break;
			case 9: $valore = dwzGetRecValue($matches[1][0], $matches[2][0]); break;
			case 10:				
				$result = false;
				//here we must use the eval
				if(substr($str, strlen($str) - 1) != ";"){
					$str .= ";";
				}
				@eval("\$result = " .$str);
				if($result === false || $result == null){
					$result = $str;
				}else{
					$result = strval($result);
				}
				$valore = $result;
				
				break;
			//default:break;
		}
		//}
		
		return $valore;
	}
		
	
	function GetDynamicValue($str){
		$valore = $str;	
		
		if(strlen(trim($valore)) != 0){
			$valore = trim($valore);
			$valore = preg_replace("/@_end_@/i", "", $valore);
			$valore = preg_replace("/@_ec_ho_@/i", "", $valore);
			$valore = preg_replace("/@_dollar_@/i", "$", $valore);
			$valore = preg_replace("/@_dot_comma_@/i", "", $valore);		
			$valore = preg_replace("/@_''_@/i", "\"", $valore);
			$matches = preg_split("/@_start_@/i", $valore);
			$valore = preg_replace("/@_start_@/i", "", $valore);
			
			for($i=0; $i<count($matches); $i++){
				if(!empty($matches[$i])){
					$val = trim($this->ParseDynamicValue($matches[$i]));
					$pattern = preg_quote($matches[$i], '/');
					$valore = preg_replace("/" .$pattern ."/", $val, $valore);
				}
			}						
		}
		
		return $valore;
	}
	
	function ConvertToAbsolutePath($path){
		if(strlen($path) == 0){
			return "";
		}
		$abs_path = dwzIO::GetRealPath($path);
		return dwzIO::GetSiteRootRelativePath($abs_path);
	}
}


function WebImageEditorIncludes($params){
	$tmp = preg_split("/;/", $params);
	$root = $tmp[0];
	$theme = "cupertino";
	if(count($tmp) > 1){
		$theme = $tmp[1];
	}
	echo "<link rel='stylesheet' type='text/css' href='" .$root ."dwzImageEditor/css/themes/" .$theme ."/jquery-ui.min.css'>\n";
	echo "<link rel='stylesheet' type='text/css' href='" .$root ."dwzImageEditor/css/themes/" .$theme ."/theme.css'>\n";	
	
	echo "<script>window.jQuery || document.write('<script src=\"" .$root ."dwzImageEditor/js/jquery.min.js\"><\/script>')</script>\n";		
	/*
	echo "<script type='text/javascript' src='" .$root ."dwzImageEditor/js/jquery.min.js'></script>\n";
	*/
	echo "<script type='text/javascript' src='" .$root ."dwzImageEditor/js/jquery-ui.min.js'></script>\n";
	echo "<script type='text/javascript' src='" .$root ."dwzImageEditor/js/jquery.blockUI.js'></script>\n";
	echo "<script type='text/javascript' src='" .$root ."dwzImageEditor/WebImageEditor.js'></script>\n";
	echo "<style type='text/css'>\n";
	echo ".ui-widget {\n";
	echo "	font-size: 0.9em;\n";
	echo "}\n";
	echo ".ui-widget .ui-widget {\n";
	echo "	font-size: 0.7em;\n";
	echo "}\n";
	echo ".ui-widget input,\n";
	echo ".ui-widget select,\n";
	echo ".ui-widget textarea,\n";
	echo ".ui-widget button {\n";
	echo "	font-size: 0.8em;\n";
	echo "}\n";
	echo "</style>\n";
}
?>