<?php
if (!isset($site_root)) {
  if(isset($_SERVER['SCRIPT_FILENAME'])){
	  $WA_DOCUMENT_ROOT = $_SERVER['SCRIPT_FILENAME'];
  }
  if(!isset($WA_DOCUMENT_ROOT)){
	  if(isset($_SERVER['PATH_TRANSLATED'])){
		  $WA_DOCUMENT_ROOT =  $_SERVER['PATH_TRANSLATED'];
	  }
  }
  if(!isset($WA_DOCUMENT_ROOT)){
	  $WA_DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
  }
  if (realpath($WA_DOCUMENT_ROOT)) $WA_DOCUMENT_ROOT = realpath($WA_DOCUMENT_ROOT);
  $WA_DOCUMENT_ROOT = str_replace('\\', '/', $WA_DOCUMENT_ROOT);
  $WA_DOCUMENT_ROOT = str_replace('//', '/', $WA_DOCUMENT_ROOT);
  $PHPSelf = $_SERVER['PHP_SELF'];
  while (strtolower(basename($WA_DOCUMENT_ROOT)) == strtolower(basename($PHPSelf)) && $WA_DOCUMENT_ROOT != "/" && $WA_DOCUMENT_ROOT!="")  {
	  $WA_DOCUMENT_ROOT = dirname($WA_DOCUMENT_ROOT);
	  $PHPSelf = dirname($PHPSelf);
  }
  $site_root = $WA_DOCUMENT_ROOT;
  $virtualdir = $PHPSelf;
  if ($site_root == "/" || $site_root == "\\") $site_root = "";
  if ($virtualdir == "/" || $virtualdir == "\\") $virtualdir = ""; 
}

if (!function_exists('rel2abs') )  {
	function rel2abs($rel, $base)  {
	  $baseRoot = str_replace("\\","/",$GLOBALS['site_root']);
	  $baseRoot = str_replace("//","/",$baseRoot);
	  $base = str_replace("\\","/",$base);
	  $base = str_replace("//","/",$base);
	  if($baseRoot != "" && strpos(strtolower($base), strtolower($baseRoot)) === 0) $base = substr($base,strlen($baseRoot));
	  $rel = str_replace("\\","/",$rel);
	  if($baseRoot != "" && strpos(strtolower($rel), strtolower($baseRoot)) === 0) $rel = substr($rel,strlen($baseRoot));
	  
	  if (strpos($rel,"/")===0 || $base==$rel) {
	  return $rel;
	  }
	  $added = false;
	  if  (strpos($base,"/")!==0)  {
	  $base = "/" . $base;	
	  $added = true;
	  }
	  while (strpos($rel,"../")===0)  {
	  $base = substr($base,0,strrpos($base,"/"));
	  $rel = substr($rel,3);
	  }
	  if ($added) $base = substr($base,1);
	  if ($rel!=""){
		  $base = $base . ( ($rel == ".") ? "" : "/" . $rel );
	  }
	  if ($GLOBALS['virtualdir']!="" && strpos($base,$GLOBALS['virtualdir']) !== 0)  {
		  $base = $GLOBALS['virtualdir'] . $base;
	  }
	  
	  return $base;
	}
}

if (!function_exists('abs2rel') )  {
	function abs2rel($abs, $base, $belowroot = false)  {
	  $baseRoot = str_replace("\\","/",$GLOBALS['site_root']);
	  $baseRoot = str_replace("//","/",$baseRoot);
	  $base = str_replace("\\","/",$base);
	  $base = str_replace("//","/",$base);
	  if(!$belowroot && $baseRoot != "" && strpos(strtolower($base), strtolower($baseRoot)) === 0) $base = substr($base,strlen($baseRoot));
	  $abs = str_replace("\\","/",$abs);
	  if(!$belowroot && $baseRoot != "" && strpos(strtolower($abs), strtolower($baseRoot)) === 0) $abs = substr($abs,strlen($baseRoot));
	  if  ($GLOBALS['virtualdir']!="")  {
		  if(strpos($base, $GLOBALS['virtualdir']) === 0) $base = wa_replace_once($GLOBALS['virtualdir'],"",$base);
		  if(strpos($abs, $GLOBALS['virtualdir']) === 0) $abs = wa_replace_once($GLOBALS['virtualdir'],"",$abs);
	  }
			  
	  if ($base=="/" && strpos($abs, "/") === 0) return substr($abs,1);
	  if ($base!="" && strrpos($base,"/") != strlen($base)) $base .="/";
	  while  (strpos($abs,"/") !== false && strtolower(substr($abs,0,strpos($abs,"/")+1))  == strtolower(substr($base,0,strpos($base,"/")+1)) )  {
		  $abs = substr($abs,strpos($abs,"/")+1);
		  $base = substr($base,strpos($base,"/")+1);
	  }
	  while (strpos($base,"/") !== false)  {
			  if (strpos($abs,"/")===0)  {
				  $abs = substr($abs,1);	
			  }
		  $abs = "../".$abs;
		  $base = substr($base,strpos($base,"/")+1);
	  }
	  if (strpos($abs,"/")===0)  {
		   $abs = substr($abs,1);	
	  }
	  // $site_root should be set in the theme_open.php page
	  $abs = str_replace($GLOBALS['site_root'],"",$abs);
	  return $abs;
	}
}

if (!function_exists('wa_replace_once') )  {
	function wa_replace_once($search, $replace, $subject) {
		$firstChar = strpos($subject, $search);
		if($firstChar !== false) {
			$beforeStr = substr($subject,0,$firstChar);
			$afterStr = substr($subject, $firstChar + strlen($search));
			return $beforeStr.$replace.$afterStr;
		} else {
			return $subject;
		}
	}
}

?>