<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "hyberion_dbadmin", "opensesame1234", "hyberion_battlecomm");

$page_id = $_GET['news_id'];

$result = $conn->query("SELECT news_id, news_title, featured_image, news_callout, news_body, news_author, news_date_submitted, game_system, parent, tags FROM bc_news WHERE news_id=$page_id");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"ID":"'  . $rs["news_id"] . '",';
	$outp .= '"Title":"'   . $rs["news_title"] . '",';
	$outp .= '"ImageUrl":"'   . $rs["featured_image"] . '",';
	$outp .= '"Body":"'   . $rs["news_callout"]        . '",';
	$outp .= '"Body":"'   . $rs["news_body"]        . '",';
    $outp .= '"Author":"'   . $rs["news_author"]        . '",';
	$outp .= '"Posted":"'   . $rs["news_date_submitted"]        . '",';
	$outp .= '"GameSystem":"'   . $rs["game_system"]        . '",';
	$outp .= '"Category":"'   . $rs["parent"]        . '",';
    $outp .= '"Tags":"'. $rs["tags"]     . '"}'; 
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>