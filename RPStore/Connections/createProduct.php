<?php
header("Access-Control-Allow-Origin: http://www.battle-comm.net/");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$hostname_battlecomm_sqli = "battle-comm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com";
$database_battlecomm_sqli = "hyberion_battlecomm";
$username_battlecomm_sqli = "bcadmin";
$password_battlecomm_sqli = "Xdxn9\zX5s";

$battlecomm_sqli = new mysqli($hostname_battlecomm_sqli, $username_battlecomm_sqli, $password_battlecomm_sqli, $database_battlecomm_sqli);

//Get data
$jsondata = file_get_contents('php://input');

//convert json object to php associative array
$data = json_decode($jsondata, true);

    //get product details
    $id = $data['id'];
    $SKU = $data['SKU'];
    $updated = $data['updated'];
    $name = $data['name'];
    $price = $data['price'];
    $description = $data['description'];
    $manufacturerId = $data['manufacturerId'];
    $gameSystem = $data['gameSystem'];
    $color = $data['color'];
    $tag = $data['tag'];
    $category = $data['category'];
    $stockQty = $data['stockQty'];
    $inStock = $data['inStock'];
    $filterVal = $data['filterVal'];
    $displayStatus = $data['displayStatus'];
    $featured = $data['featured'];
    $new = $data['new'];
    $onSale = $data['onSale'];
    $imgOneFront = $data['imageOne']['imgFrontUrl'];
    $imgOneBack = $data['imageOne']['imgBackUrl'];
    $imgOneAlt = $data['imageOne']['imgAlt'];
    $imgTwoFront = $data['imageTwo']['imgFrontUrl'];
    $imgTwoBack = $data['imageTwo']['imgBackUrl'];
    $imgTwoAlt = $data['imageTwo']['imgAlt'];
    $imgThreeFront = $data['imageThree']['imgFrontUrl'];
    $imgThreeBack = $data['imageThree']['imgBackUrl'];
    $imgThreeAlt = $data['imageThree']['imgAlt'];
    $imgFourFront = $data['imageFour']['imgFrontUrl'];
    $imgFourBack = $data['imageFour']['imgBackUrl'];
    $imgFourAlt = $data['imageFour']['imgAlt'];

    $sql = "INSERT INTO products(id, SKU, updated, name, price, description, manufacturerId, gameSystem, color, tag, category, stockQty, inStock, filterVal, displayStatus, featured, new, onSale, imgOneFront, imgOneBack, imgOneAlt, imgTwoFront, imgTwoBack, imgTwoAlt, imgThreeFront, imgThreeBack, imgThreeAlt, imgFourFront, imgFourBack, imgFourAlt)
        VALUES('$id', '$SKU', NOW(), '$name', '$price', '$description', '$manufacturerId', '$gameSystem', '$color', '$tag',
            '$category', '$stockQty', '$inStock', '$filterVal', '$displayStatus', '$featured', '$new', '$onSale', '$imgOneFront',
            '$imgOneBack', '$imgOneAlt', '$imgTwoFront', '$imgTwoBack', '$imgTwoAlt', '$imgThreeFront', '$imgThreeBack', '$imgThreeAlt',
            '$imgFourFront', '$imgFourBack', '$imgFourAlt')";
        if (mysqli_query($battlecomm_sqli, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($battlecomm_sqli);
        }

$battlecomm_sqli->close();

echo($outp);
?>
