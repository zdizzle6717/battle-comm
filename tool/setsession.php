<?php session_start();
$_SESSION['svAdminName'] = $_POST['admiinName'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Set Session</title>
</head>

<body>
<p>Session value is set to: <?php echo $_SESSION['svAdminName'];?>
</p>
<p>*************************************</p>
<p> Admin UserName 
<form name="setSession" method="post" action="setsession.php"><input name="admiinName" type="text" id="admiinName"> 
      <input name="button" type="submit" id="button" formaction="setsession.php" formmethod="POST" value="Button">
     
      </form></p>
<p>[Proceed to tool index Page]<a href="index.php"> --&gt;</a></p>
</body>
</html>