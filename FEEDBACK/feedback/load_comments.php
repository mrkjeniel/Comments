<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proto_comments";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = 3;

$sql = "SELECT user_ID, datePublished, suggestion, star_rating, comments FROM reviews ORDER BY datePublished DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="comment">';
        echo '<div class="upper-comment-descript">';
        echo '<div class="left-side">';
        echo '<img class="profile-img2" src="images/Feedback/profile-image.svg">';
        echo '</div>';
        echo '<div class="right-side">';
        echo '<div class="star-comments">';
        echo '<div class="rateyo" data-rateyo-rating="' . $row["star_rating"] . '" data-rateyo-num-stars="5" data-rateyo-score="3"></div>';
        echo '</div>';
        echo '<h1>' . htmlspecialchars($row["user_ID"]) . '</h1>';
        echo '<p>' . htmlspecialchars($row["datePublished"]) . '</p>';
        echo '<div class="lower-comment-descript">';
        echo '<p>' . htmlspecialchars($row["comments"]) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "";
}

$conn->close();
?>
