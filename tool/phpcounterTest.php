<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<table width="700" border="1">
  <tr>
<?php
//Enter your code here, enjoy!

$GameNum=13;
$numPlayers=3;
$a=1;
$count=1;
$game=1;

while ($a <= $GameNum) {

	while ($count <=$numPlayers) {
	echo "	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name=\"Game $game\" type=\"text\" id=\"Game $game\" value=\"Game # $game\"></td>";
		$count++;
	}
$count=1;
$game++;
$a++;
}

?>
  </tr>
</table>
</body>
</html>