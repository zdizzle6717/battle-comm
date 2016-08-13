<?php require_once( "webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("loginA.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<p>TourneyAdmin: <?php echo $_SESSION['tourneyAdmin']; ?>
</p>
<p>EventAdmin: <?php echo $_SESSION['EventAdmin']; ?></p>
<p>venueAdmin: <?php echo $_SESSION['venueAdmin']; ?></p>
<p>NewsContributor: <?php echo $_SESSION['NewsContributor']; ?></p>
<p>siteAdmin: <?php echo $_SESSION['siteAdmin']; ?></p>
<p>ClubAdmin: <?php echo $_SESSION['clubAdmin']; ?></p>
</body>
</html>