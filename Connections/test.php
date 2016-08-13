<?php
$servername = "battle-comm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com";
$username = "bcadmin";
$password = "Xdxn9\zX5s";
$database = "hyberion_battlecomm";
$port = 3306;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database, $port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>