<?php
/* Database Credentials */
$servername = "localhost";
$username = "hyberion_dbadmin";
$password = "opensesame1234";
$dbname = "hyberion_battlecomm";

/* Create connection */
$conn = new mysqli($servername, $username, $password, $dbname);
/* Check connection */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if ($_SERVER["REQUEST_METHOD"] === "POST")
{
  if (isset($_GET["news"]))
  {
    // AJAX form submission
    $news = json_decode($_GET["news"], true);
	$news_author = $news['news_author'];
	$news_title = $news['news_title'];
	$news_date_submitted = $news['news_date_submitted'];
	$category = $news['game_system'];
	$parent = $news['parent'];
	$news_callout = $news['news_callout'];
	$news_body = $news['news_body'];
	$tags = $news['tags'];
	$publish = $news['publish'];
  }
  else
  {
    $result = "INVALID REQUEST DATA";
  }
}


$query = "INSERT INTO bc_news (news_author, news_title, news_date_submitted, game_system, parent, news_callout, news_body, tags, publish)
VALUES ('$news_author', '$news_title',  now(), '$category', '$parent', '$news_callout', '$news_body',  '$tags', '$publish')";


if ($conn->query($query) === TRUE) {
    echo 'New record created successfully' . '<br/>';
    echo "Published? " . $publish;
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
$conn->close();
?>