<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$hostname_battlecomm_sqli = "battle-comm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com";
$database_battlecomm_sqli = "hyberion_battlecomm";
$username_battlecomm_sqli = "bcadmin";
$password_battlecomm_sqli = "Xdxn9zX5s";

$battlecomm_sqli = new mysqli($hostname_battlecomm_sqli, $username_battlecomm_sqli, $password_battlecomm_sqli, $database_battlecomm_sqli);

$currentProduct = $_GET['id'];
$result = $battlecomm_sqli->query("SELECT id, SKU, updatedAt, name, price, description, manufacturerId, gameSystem, color, tags, category, stockQty, inStock, filterVal, displayStatus, featured, new, onSale, imgAlt, imgOneFront, imgOneBack, imgTwoFront, imgTwoBack, imgThreeFront, imgThreeBack, imgFourFront, imgFourBack FROM Products WHERE id='$currentProduct' ");


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"' . $rs["id"] . '",';
    $outp .= '"SKU":"' . $rs["SKU"] . '",';
    $outp .= '"updated":"' . $rs["updatedAt"] . '",';
    $outp .= '"name":"' . $rs["name"] . '",';
    $outp .= '"price":"' . $rs["price"] . '",';
    $outp .= '"description":"' . $rs["description"] . '",';
    $outp .= '"manufacturerId":"' . $rs["manufacturerId"] . '",';
    $outp .= '"gameSystem":"' . $rs["gameSystem"] . '",';
    $outp .= '"color":"' . $rs["color"] . '",';
    $outp .= '"tag":"' . $rs["tags"] . '",';
    $outp .= '"category":"' . $rs["category"] . '",';
    $outp .= '"stockQty":"' . $rs["stockQty"] . '",';
    $outp .= '"inStock":"' . $rs["inStock"] . '",';
    $outp .= '"filterVal":"' . $rs["filterVal"] . '",';
    $outp .= '"displayStatus":"' . $rs["displayStatus"] . '",';
    $outp .= '"featured":"' . $rs["featured"] . '",';
    $outp .= '"new":"' . $rs["new"] . '",';
    $outp .= '"onSale":"' . $rs["onSale"] . '",';
    $outp .= '"imageOne":' . '{"imgFrontUrl":"' . $rs["imgOneFront"] . '",';
    $outp .= '"imgBackUrl":"' . $rs["imgOneBack"] . '",';
    $outp .= '"imgAlt":"' . $rs["imgAlt"] . '"},';
    $outp .= '"imageTwo":' . '{"imgFrontUrl":"' . $rs["imgTwoFront"] . '",';
    $outp .= '"imgBackUrl":"' . $rs["imgTwoBack"] . '",';
    $outp .= '"imgAlt":"' . $rs["imgAlt"] . '"},';
    $outp .= '"imageThree":' . '{"imgFrontUrl":"' . $rs["imgThreeFront"] . '",';
    $outp .= '"imgBackUrl":"' . $rs["imgThreeBack"] . '",';
    $outp .= '"imgAlt":"' . $rs["imgAlt"] . '"},';
    $outp .= '"imageFour":' . '{"imgFrontUrl":"' . $rs["imgFourFront"] . '",';
    $outp .= '"imgBackUrl":"' . $rs["imgFourBack"] . '",';
    $outp .= '"imgAlt":"' . $rs["imgAlt"] . '"}}';
}
$outp ='{"products":['.$outp.']}';
$battlecomm_sqli->close();

echo($outp);
?>
