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

$now = new DateTime();

//convert json object to php associative array
$data = json_decode($jsondata, true);

    //get product details
    $id = $data['id'];
    $rewardPoints = $data['user_points'];

    $sql = "UPDATE user_login SET user_points=$rewardPoints WHERE id=$id";
        if (mysqli_query($battlecomm_sqli, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($battlecomm_sqli);
        }

$battlecomm_sqli->close();

echo($outp);
?>
