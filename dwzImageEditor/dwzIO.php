<?php

class dwzIO
{
	const  BETWEEN_NAME_AND_EXTENSION = 2;
	const  BEFORE_NAME = 1;
	
	public static function ConvertRelativeToAbsolutePath($page_absolute_path, $relative_path){
		if(dwzString::StartWith($relative_path, "/")){
			$relative_path = preg_replace("/\//", (self::IsMac() ? "/" : "\\"), $relative_path);
			$new_path = self::PathCombine(self::GetSiteRoot(), $relative_path);
			return $new_path;
		}
		$page_path = self::GetFilePart($page_absolute_path);
		$page_path['path'] = dwzString::TrimRight($page_path['path'], (self::IsMac() ? "/" : "\\"));
						
		$relative_path = dwzString::TrimLeft($relative_path, "./");
		$levels = 0;
		while(substr($relative_path, 0, 3) == "../"){
			$levels ++;
			$relative_path = substr($relative_path, 3);
		}				
		$relative_path = preg_replace("/\//", (self::IsMac() ? "/" : "\\"), $relative_path);		
		if(self::IsMac()){
			$folders = preg_split("/\//", $page_path['path']);
		}else{
			$folders = preg_split("/\\\\/", $page_path['path']);
		}						
		$new_path = "";
		if(count($folders) > 1){
			for($i=0; $i<count($folders) - $levels; $i++){
				if($new_path != ""){
					$new_path .= (self::IsMac() ? "/" : "\\");
				}
				$new_path .= $folders[$i];
			}
		}
		if($new_path == ""){
			$new_path = $page_path['path'];
		}
		
		$new_path = self::PathCombine($new_path, $relative_path);
		if(self::IsMac() && !dwzString::StartWith($new_path, "/")){
			$new_path = "/" .$new_path;
		}
		if(!dwzString::StartWith($new_path, self::GetSiteRoot())){
			$new_path = self::GetSiteRoot();
		}
		return $new_path;
	}
	
	public static function GetSiteRootRelativePath($absolute_path){
		$root = self::GetSiteRoot();
		$site_relative_path = substr($absolute_path, strlen($root));
		return preg_replace("/\\\\/", "/", $site_relative_path);
	}
	
	public static function ConvertAbsoluteToRelativePath($page_absolute_path, $absolute_path_to_convert){
		$root_path = self::GetSiteRoot();
		$page = self::GetFilePart($page_absolute_path);
		$rel_page = self::GetFilePart($absolute_path_to_convert);
		
		$page['path'] = dwzString::TrimRight($page['path'], (self::IsMac() ? "/" : "\\"));
		$page['path'] = dwzString::TrimLeft($page['path'], $root_path);
		$page['path'] = dwzString::TrimLeft($page['path'], (self::IsMac() ? "/" : "\\"));
		
		$rel_page['path'] = dwzString::TrimRight($rel_page['path'], (self::IsMac() ? "/" : "\\"));
		$rel_page['path'] = dwzString::TrimLeft($rel_page['path'], $root_path);	
		$rel_page['path'] = dwzString::TrimLeft($rel_page['path'], (self::IsMac() ? "/" : "\\"));
		$rel_page['path'] = preg_replace("/\\\\/", "/", $rel_page['path']);
		
		if(self::IsMac()){
			$levels = count(preg_split("/\//", $page['path']));
		}else{
			$levels = count(preg_split("/\\\\/", $page['path']));
		}
		$rel_path = "";
		for($i=0; $i<$levels; $i++){
			$rel_path .= "../";
		}
		return $rel_path .$rel_page['path'] ."/" .$rel_page['name'] .$rel_page['ext'];
	} 
	
	public static function GetSiteURL() {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"];
		}
		return $pageURL;
	}
	
	public static function GetSiteRoot(){
		//return "/www/root/";		 
		$path = @$_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
		if(strlen($path) == 0){
			$path = @$_SERVER['DOCUMENT_ROOT'];
		}
		if(strlen($path) == 0){
			$path = @$HTTP_SERVER_VARS['DOCUMENT_ROOT'];
		}
		if(strlen($path) == 0){
			$path = @$_SERVER['APPL_PHYSICAL_PATH'];
		}
		if(strlen($path) == 0 && isset($_SESSION)){
			$path = @$_SESSION['SITE_ROOT'];
			if(strlen($path) != 0){
				$path = dwzString::TrimRight($path, (self::IsMac() ? "/" : "\\"));
			}
		}
		// For test on Mac
		//	$path = "/var/www/vhosts/esenciaslozano.com/httpdocs";
		return $path;
	}
	
	public static function PathCombine($path_1, $path_2){
		$path_separator = self::GetPathSeparator();
		$path_1 = dwzString::TrimRight($path_1, (self::IsMac() ? "/" : "\\"));
		$path_2 = dwzString::TrimLeft($path_2, (self::IsMac() ? "/" : "\\"));
		return $path_1 .(self::IsMac() ? "/" : "\\") .$path_2;
	}
	
	public static function GetRealPath($path){
		if($path == ""){
			return "";
		}
		$root = self::GetSiteRoot();
		$rel_path = "";
		if(substr($path, 0, 1) == "/"){
			if(strpos($root, "/") !== false){
				//	/folder/
				if(substr($root, -1) == "/" && substr($path, 0, 1) == "/"){
					$path = substr($path, 1);
				}
				$rel_path = $root .$path;
			}else{
				//	c:\folder\
				if(self::IsMac()){
					$rel_path = self::PathCombine($root, $path);
				}else{
					$rel_path = self::PathCombine($root, preg_replace("/\//", "\\", $path));
				}
			}
		}else{
			//echo $path ."<br>";
			$page_absolute_path = self::GetCurrentAbsolutePath();
			//for test on Mac
			//	/var/www/vhosts/esenciaslozano.com/httpdocs/intranet/admin			
			$rel_path = self::ConvertRelativeToAbsolutePath($page_absolute_path, $path);				
		}		
		$part = self::GetFilePart($rel_path);
		if($part['path'] != "" && self::IsNotDir($part['path'])){
			self::CreateFoldersTree($part['path']);
		}
		return $rel_path;
	}
	
	public static function GetCurrentAbsolutePath(){
		//return "/www/root/test/test_file/";
		$path = @$_SERVER["SCRIPT_FILENAME"];
		if(strlen($path) == 0){
			$path = @$_SERVER["ORIG_PATH_TRANSLATED"];
		}
		if(strlen($path) == 0){
			$path = $_ENV["DOCUMENT_ROOT"];
		}
		if(strlen($path) == 0){
			$path = $_ENV["SCRIPT_FILENAME"];
		}
		if(strlen($path) == 0){
			$path = $_ENV["ORIG_PATH_TRANSLATED"];
		}
		if(strlen($path) == 0){
			return realpath(".");
		}else{
			$part = self::GetFilePart($path);
			return $part['path'];
		}
	}
	
	public static function GetThumbPath($image_path, $suffix, $suffix_position){
		$part = self::GetFilePart($image_path);		
		if($suffix_position == self::BEFORE_NAME){
			return self::PathCombine($part["path"], $suffix .$part["name"] .$part["ext"]);
		}else{
			return self::PathCombine($part["path"], $part["name"] .$suffix .$part["ext"]);
		}
	}
	
	public static function GetFilePart($file_path){
		$pattern = (self::IsMac() ? "/\//" : "/\\\\/");
		$parts = preg_split($pattern, $file_path);
		
		$name = "";
		$ext = "";
		$path = "";
		$separator = self::GetPathSeparator();
		
		if(!self::IsWindows()){
			$path = "/";
		}
		
		$counter = count($parts);
		if(strripos($parts[count($parts) - 1], ".") !== false){
			$tmp_name = preg_split("/\./", $parts[count($parts) - 1]);
			$counter = count($parts) - 1;			
			$name = $tmp_name[0];
			$ext = "." .$tmp_name[1];
		}
		
		for($i=0; $i<$counter; $i++){
			if($path != "" && $path != $separator && $i > 0){
				$path .= $separator;
			}
			$path .= $parts[$i];
		}
						
		if(substr($path, -1) != $separator){
			$path .= $separator;
		}
		
		$ret_val =  array("name" => $name, "path" => $path, "ext" => $ext);
		//echo var_dump($file_path);
		//exit();
		return $ret_val;
		/*
		if(strripos($file_path, ".") === false){
			$name = "";
			$ext = "";
			$path = $file_path;
		}else{
			$name = substr($file_path, 0, strripos($file_path, "."));
			if(strpos($file_path, $separator)  !== false){
				$path = substr($name, 0, strripos($name, $separator) + 1);
				$name = substr($name, strripos($name, $separator) + 1);
			}else{
				$path = "";
			}
			$ext = substr($file_path, strripos($file_path, "."));
		}
		return array("name" => $name, "path" => $path, "ext" => $ext);
		*/
	}
	
	public static function GetPathSeparator(){
		$path = self::GetSiteRoot();
		if(strpos($path, "/") !== false){
			return "/";
		}else{
			return "\\";
		}
	}
	
	public static function CreateFoldersTree($path){
		$path_separator = self::GetPathSeparator();
		$folder = "";
			
		if($path_separator == "/"){			
			$tmp = preg_split("/\//", $path);
		}else{
			$tmp = preg_split("/\\\/", $path);
		}
		
		if(!self::IsWindows() && $folder == ""){
			$folder = "/";
		}
		
		foreach($tmp as $part){
			if($folder != "" && $folder != $path_separator){
				$folder .= $path_separator;
			}
			if($part != ""){
				$folder .= $part;
				//echo $folder ."<br>";
				if($part != ".." && self::IsNotDir($folder)){
					//echo "Create<br>";
					self::CreateFolder($folder);
				}
			}
		}		
		return $folder;
	}
	
	public static function FileCopy($source_path, $dest_path, $overwrite){
		if(!self::FileExist($source_path) || (self::FileExist($source_path) && $overwrite)){
			return copy($source_path, $dest_path);
		}
		return false;
	}
	
	public static function FileExist($file_path){
		if(@file_exists($file_path)){
			return true;
		}else{
			return false;
		}
	}
	
	public static function IsNotDir($folder){
		if(@is_dir($folder)){
			return false;
		}else{
			return true;
		}
	}
	
	public static function CreateFolder($folder){
		if(self::IsNotDir($folder)){
			@mkdir($folder, 0755, true);
		}
	}
	
	public static function VerifyFolder($folder){
		$path = self::GetRealPath($folder);
		self::CreateFoldersTree($path);
	}

	public static function IsWindows(){
		$path = self::GetSiteRoot();
		if(preg_match("/^[a-zA-Z]+:/", $path)){
			return true;
		}
		return false;
	}
	
	public static function IsMac(){
		$path = self::GetSiteRoot();
		if(strpos($path, "\\") !== false){
			return false;
		}
		return true;
	}
}

?>