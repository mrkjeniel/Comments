<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proto_comments";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT user_ID, datePublished, comments, star_rating FROM reviews ORDER BY date DESC";
$result = $conn->query($query);

$comments = array();
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

echo json_encode($comments);

$conn->close();
?>
