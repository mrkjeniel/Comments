<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proto_comments";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $uid = $_POST['uid'];
    $date = $_POST['date'];
    $suggestion = $_POST['suggestion'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO reviews (user_ID, datePublished, suggestion, star_rating, comments) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $bind_result = $stmt->bind_param("sssds", $uid, $date, $suggestion, $rating, $comment);
    if (!$bind_result) { 
        die("Bind failed: " . $stmt->error);
    }

    if ($stmt->execute()) {
        echo 'Comment submitted successfully';
        $stmt->close();
        $conn->close();
        header("Location: feedback.php");
    } else {
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
