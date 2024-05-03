<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
</head>

<body>
    <h2>Edit Review</h2>

    <?php
    include 'connect.php';

    // Check if review ID is provided in the URL
    if (!isset($_GET['id'])) {
        echo "Review ID not provided.";
        exit;
    }

    $review_id = $_GET['id'];

    // Fetch review details based on the ID
    $sql = "SELECT * FROM reviews WHERE id = $review_id";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display the review details in a form
        ?>
        <form method="POST" action="update_review.php">
            <input type="hidden" name="review_id" value="<?php echo $row['id']; ?>">
            <textarea name="new_comment" required><?php echo $row['comment']; ?></textarea><br>
            <button type="submit">Update Review</button>
        </form>
        <?php
    } else {
        echo "Review not found.";
    }
    ?>

</body>

</html>