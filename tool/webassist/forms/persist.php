<?php
function WA_coalesce($arr) {
  for ($x=0; $x<sizeof($arr); $x++)  {
	if ($arr[$x] !== false) {
	  return $arr[$x];
	}
  }
  return "";
}

function WA_persistForm($savedIn,$savedAs,$expire = 0,$path="/",$domain="",$secure=false,$httponly=false ) {
  if ($savedIn == "cookie") {
	setcookie("WASF_" . $savedAs, serialize($_REQUEST), $expire, $path, $domain, $secure, $httponly);	
	$_COOKIE["WASF_" . $savedAs] = serialize($_REQUEST);
  } else {
    @session_start();
	$_SESSION["WASF_" . $savedAs] = $_REQUEST;
  }
}

function WA_getSavedFormValue($savedAs,$field,$index=-1) {
  @session_start();
  if (!isset($_SESSION["WASF_" . $savedAs])) {
	if (!isset($_COOKIE["WASF_" . $savedAs])) {
		return false;
	} else {
		$oldVals = @unserialize($_COOKIE["WASF_" . $savedAs]);
	}
  } else {
    $oldVals = $_SESSION["WASF_" . $savedAs];
  }
  if (isset($oldVals[$field])) {
	if (is_array($oldVals[$field]) && $index!=-1) {
	  return $oldVals[$field][$index];
	} else {
	  return $oldVals[$field];
	}
  }
  return false;
}
?>