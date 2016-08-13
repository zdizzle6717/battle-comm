<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$hostname_battlecomm_sqli = "battle-comm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com";
$database_battlecomm_sqli = "hyberion_battlecomm";
$username_battlecomm_sqli = "bcadmin";
$password_battlecomm_sqli = "Xdxn9\zX5s";

$battlecomm_sqli = new mysqli($hostname_battlecomm_sqli, $username_battlecomm_sqli, $password_battlecomm_sqli, $database_battlecomm_sqli);

$result = $battlecomm_sqli->query("SELECT id, customerId, created, updated, status, orderDetails, orderTotal, customerFullName, phone, shippingStreet, shippingApartment, shippingCity, shippingState, shippingZip, shippingCountry FROM product_orders");


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":' . $rs["id"] . ',';
    $outp .= '"customerId":"' . $rs["customerId"] . '",';
    $outp .= '"created":"' . $rs["created"] . '",';
    $outp .= '"updated":"' . $rs["updated"] . '",';
    $outp .= '"status":"' . $rs["status"] . '",';
    $outp .= '"orderDetails":"' . $rs["orderDetails"] . '",';
    $outp .= '"orderTotal":' . $rs["orderTotal"] . ',';
    $outp .= '"customerFullName":"' . $rs["customerFullName"] . '",';
    $outp .= '"phone":"' . $rs["phone"] . '",';
    $outp .= '"shippingStreet":"' . $rs["shippingStreet"] . '",';
    $outp .= '"shippingApartment":"' . $rs["shippingApartment"] . '",';
    $outp .= '"shippingCity":"' . $rs["shippingCity"] . '",';
    $outp .= '"shippingState":"' . $rs["shippingState"] . '",';
    $outp .= '"shippingZip":"' . $rs["shippingZip"] . '",';
    $outp .= '"shippingCountry":"' . $rs["shippingCountry"] . '"}';
}
$outp ='{"orders":['.$outp.']}';
$battlecomm_sqli->close();

echo($outp);
?>
