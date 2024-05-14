<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proto_comments";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT user_ID, datePublished, suggestion, star_rating, comments FROM reviews ORDER BY datePublished DESC LIMIT 3";
$result = $conn->query($sql);

$total_comments_sql = "SELECT COUNT(*) as count FROM reviews";
$total_comments_result = $conn->query($total_comments_sql);
$total_comments_row = $total_comments_result->fetch_assoc();
$total_comments = $total_comments_row['count'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link href="https://fonts.googleapis.com/css2?family=Candal&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wdth,wght@75,400;87.5,700;100,400;100,600;100,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Niramit:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/feedback.css">
</head>
<body>
    <div class="navigation">
        <div class="left-nav">
            <nav>
                <ul class='nav-bar'>
                    <input type='checkbox' id='check' />
                    <span class="menu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.html">Products</a></li>
                        <li><a href="promos/promosPage.html">Promos</a></li>
                        <li><a href="news-and-reviews.html">News and Reviews</a></li>
                        <li><a href="contact-us.html">Contact Us</a></li>
                        <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
                    </span>
                    <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
                </ul>
            </nav>
        </div>

        <div class="right-nav">
            <p> MITSUBISHI </p>
            <div class="logo-img">
                <img src="../images/Products/logo.svg">
            </div>
        </div>
    </div>

    <div class="body">
        <div class="hero-image">
            <div class="hero-title">
                <h1>We Value your Feedback!</h1>
            </div>
            <div class="hero-button">
                <button class="add-comment">ADD COMMENT > </button>
            </div>
        </div>
        <div class="count-comments">
            <h1>Comments (<?php echo $result->num_rows; ?>)</h1>
        </div>

        <!-- Comment submission form -->
        <form method="POST" action="addreview.php">
            <input type="hidden" name="uid" value="Anonymous">
            <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
            <div class="comment">
                <div class="upper-comment">
                    <button type="button" class="suggestion" value="Convenient">Convenient</button>
                    <button type="button" class="suggestion" value="User-Friendly">User-Friendly</button>
                    <button type="button" class="suggestion" value="Hard to Navigate">Hard to Navigate</button>
                    <button type="button" class="suggestion" value="Poor Management">Poor Management</button>
                    <input type="hidden" name="suggestion" id="suggestion">
                </div>

                <div class="star">
                    <p>Leave A Star for Us:</p>
                    <div class="rateyo" id="rating" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
                    <input type="hidden" name="rating" id="rating-value">
                </div>

                <div class="comment-box">
                    <img class="profile-img" src="images/Feedback/profile-image.svg" alt="Profile Image">
                    <textarea class="textbox" name="comment" placeholder="&nbsp;Leave your comment"></textarea>
                    <button type="submit" name="submit"><img class="enter" src="images/Feedback/enter-image.svg" alt="Submit"></button>
                </div>
            </div>
        </form>

        <!-- Comments section -->
        <div id="comments-container">
            <?php
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
                echo "<p>No comments yet. Be the first to leave a comment!</p>";
            }
            ?>
        </div>

        <?php if ($total_comments > 3): ?>
            <button id="load-more" data-offset="3">Load More Comments</button>
        <?php endif; ?>
    </div>

    <div class="content2">
        <!--CONTENT2_TEXT-->
        <div class="content2text">
            <p>For more information on Mitsubishi Motors financing options, please contact us or send us an email</p>
        </div>

        <!--CONTENT2_EMAIL-->
        <div class="content2email">
            <p>ryanbarreto.mitsubishi@gmail.com</p>
            <!--CONTENT2_SEND-->
            <div class="content2send">
                <a href="mailto:ryanjoybarreto@gmail.com"><p>SEND EMAIL <b>></b></p


    <?php
        include('../footer.php');
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });

    function highlight(button) {
    var buttons = document.querySelectorAll('.suggestion');
    buttons.forEach(function(btn) {
        btn.classList.remove('active');
    });
    button.classList.add('active');
}
</script>

<script>
        $(document).ready(function () {
        // Event listener for suggestion buttons
        $(".suggestion").on("click", function () {
            var suggestionValue = $(this).val();
            $("textarea[name='comment']").val(suggestionValue);
        });
    });

</script>

    <script>
            $(document).ready(function () {
                function fetchComments() {
                    $.get('fetch_comments.php', function (data) {
                        const comments = JSON.parse(data);
                        $('#comments-container').empty();
                        comments.forEach(function (comment) {
                            const commentHtml = `
                                <div class="comment">
                                    <div class="upper-comment-descript">
                                        <div class="left-side">
                                            <img class="profile-img2" src="images/Feedback/profile-image.svg" alt="Profile Image">
                                        </div>
                                        <div class="right-side">
                                            <div class="star-comments">
                                                <div class="rateyo" data-rateyo-rating="${comment.rating}"
                                                    data-rateyo-num-stars="5" data-rateyo-score="3">
                                                </div>
                                            </div>
                                            <h1>${comment.username}</h1>
                                            <p>${comment.date}</p>
                                            <div class="lower-comment-descript">
                                                <p>${comment.comment}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#comments-container').append(commentHtml);
                        });
                        $(".rateyo").rateYo({
                            readOnly: true,
                            starWidth: "20px"
                        });
                    });
                }
                $("#rating").rateYo({
                    rating: 3,
                    numStars: 5,
                    precision: 2,
                    fullStar: true
                }).on("rateyo.set", function (e, data) {
                    $("#rating-value").val(data.rating);
                });

                $(".suggestion").on("click", function () {
                    $(".suggestion").removeClass("selected");
                    $(this).addClass("selected");
                    $("#suggestion").val($(this).val());
                });

                $('#commentForm').on('submit', function (e) {
                    e.preventDefault();
                    const formData = $(this).serialize();
                    $.post('process_comments.php', formData, function (response) {
                        console.log(response);
                        fetchComments();
                    });
                });

                fetchComments();
            });
    </script>

		</body>
		</html>