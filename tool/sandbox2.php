<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="admin_temp.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>

<form method="post">

<?php $outcome=" ";  $out_points=" "; ?>
<select id="outcome" name="outcome">
  <option value="nada">Chose Outcome</option>
  <option value="win">Win</option>
  <option value="draw">Draw</option>
  <option value="loss">Loss</option>
</select>


<?php echo "<input type=\"text\" value=\" $outcome \" name=\"name\">"?>
<input type="submit" value="submit" name="submit">


</form>
<?php 
if($_POST['outcome'] && $_POST['outcome'] != "nada")
{
   $outcome=$_POST['outcome'];
}
?><?php if ($outcome=='win'){
	$out_points="winpoints";}
	elseif ($outcome=='draw'){
		$out_points="drawpoints";}
	else {
		$out_points="losspoints";} ?>
   <?php echo "Game Outcome:$outcome <br/> GamePoints: $out_points <br/>"?>
</body>
</html>