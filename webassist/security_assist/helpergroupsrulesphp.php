<?php

function WA_Auth_GetComparisonsForRule($ruleName){
	$comparisons = array();
	
	switch ($ruleName){
		case "Bad return url from encryption email":
			$comparisons[0] = array(TRUE, "".((isset($_GET['badURL']))?$_GET['badURL']:"")  ."", 2, "");
			break;
		case "ClubAdmin":
			$comparisons[0] = array(TRUE, "".((isset($_SESSION['clubAdmin']))?$_SESSION['clubAdmin']:"")  ."", 1, "yes");
			$comparisons[1] = array(FALSE, "".((isset($_SESSION['clubAdmin']))?$_SESSION['clubAdmin']:"")  ."", 1, "no");
			break;
		case "Email address not found":
			$comparisons[0] = array(TRUE, "".((isset($_GET['notFound']))?$_GET['notFound']:"")  ."", 2, "");
			break;
		case "Email server failure":
			$comparisons[0] = array(TRUE, "".((isset($_GET['EmailFail']))?$_GET['EmailFail']:"")  ."", 2, "");
			break;
		case "Emailed password":
			$comparisons[0] = array(TRUE, "".((isset($_GET['emailedPassword']))?$_GET['emailedPassword']:"")  ."", 2, "");
			break;
		case "Encrypted email return set":
			$comparisons[0] = array(TRUE, "".((isset($_SESSION["WAENCRYPTEDRETURNUSED"]) && $_SESSION["WAENCRYPTEDRETURNUSED"])?"1":"")  ."", 2, "");
			break;
		case "Encrypted email return success":
			$comparisons[0] = array(TRUE, "".((isset($_SESSION["WAENCRYPTEDRETURNSUCCESS"]) && $_SESSION["WAENCRYPTEDRETURNSUCCESS"])?"1":"")  ."", 2, "");
			break;
		case "eventAdmin":
			$comparisons[0] = array(TRUE, "".((isset($_SESSION['EventAdmin']))?$_SESSION['EventAdmin']:"")  ."", 1, "yes");
			$comparisons[1] = array(FALSE, "".((isset($_SESSION['EventAdmin']))?$_SESSION['EventAdmin']:"")  ."", 1, "no");
			break;
		case "Failed log in":
			$comparisons[0] = array(TRUE, "".((isset($_GET['failedLogin']))?$_GET['failedLogin']:"")  ."", 2, "");
			break;
		case "Log in success":
			$comparisons[0] = array(TRUE, "".((isset($_GET['loggedIn']))?$_GET['loggedIn']:"")  ."", 2, "");
			break;
		case "Logged in to user_login":
			$comparisons[0] = array(TRUE, "".((isset($_SESSION['SecurityAssist_id']))?$_SESSION['SecurityAssist_id']:"")  ."", 2, "");
			break;
		case "newsContributor":
			$comparisons[0] = array(TRUE, "".((isset($_SESSION['NewsContributor']))?$_SESSION['NewsContributor']:"")  ."", 1, "yes");
			$comparisons[1] = array(FALSE, "".((isset($_SESSION['NewsContributor']))?$_SESSION['NewsContributor']:"")  ."", 1, "no");
			break;
		case "Successful forgot password update":
			$comparisons[0] = array(TRUE, "".((isset($_GET['fpsuccess']))?$_GET['fpsuccess']:"")  ."", 2, "");
			break;
		case "Successful update":
			$comparisons[0] = array(TRUE, "".((isset($_GET['success']))?$_GET['success']:"")  ."", 2, "");
			break;
		case "systemAdmin":
			$comparisons[0] = array(TRUE, "".((isset($_SESSION['siteAdmin']))?$_SESSION['siteAdmin']:"")  ."", 1, "yes");
			$comparisons[1] = array(FALSE, "".((isset($_SESSION['siteAdmin']))?$_SESSION['siteAdmin']:"")  ."", 1, "no");
			break;
		case "tourneyAdmin":
			$comparisons[0] = array(TRUE, "".((isset($_SESSION['tourneyAdmin']))?$_SESSION['tourneyAdmin']:"")  ."", 1, "yes");
			$comparisons[1] = array(FALSE, "".((isset($_SESSION['tourneyAdmin']))?$_SESSION['tourneyAdmin']:"")  ."", 1, "no");
			$comparisons[2] = array(FALSE, "".((isset($_SESSION['SecurityAssist_id']))?$_SESSION['SecurityAssist_id']:"")  ."", 1, "");
			break;
		case "Validated form":
			$comparisons[0] = array(TRUE, "".((isset($_GET['invalid']))?$_GET['invalid']:"")  ."", 2, "");
			break;
		case "venueAdmin":
			$comparisons[0] = array(TRUE, "".((isset($_SESSION['venueAdmin']))?$_SESSION['venueAdmin']:"")  ."", 1, "yes");
			$comparisons[1] = array(FALSE, "".((isset($_SESSION['venueAdmin']))?$_SESSION['venueAdmin']:"")  ."", 1, "no");
			break;
		case "verifiedUser":
			$comparisons[0] = array(FALSE, "".((isset($_SESSION['SecurityAssist_id']))?$_SESSION['SecurityAssist_id']:"")  ."", 1, "");
			$comparisons[1] = array(TRUE, "".((isset($_SESSION['activation_state']))?$_SESSION['activation_state']:"")  ."", 1, "1");
			break;
	}
	return $comparisons;	
}


function WA_Auth_GetGroup($groupName){
	$group = Array();
	
	switch($groupName){
	
	}

	return $group;
}

?>
