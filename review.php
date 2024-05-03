<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'connect.php';
    include 'header.php';

    // Fetch reviews from the database
    $sql = "SELECT * FROM reviews";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        // Output reviews if there are any
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<p>User: " . $row["user_name"] . "</p>";
            echo "<p>Email: " . $row["email"] . "</p>";
            echo "<p>Comment: " . $row["comment"] . "</p>";
            echo "<img src='profile_img/" . $row["user_image"] . "' alt='User Image' width='100'>";
            echo "</div>";
        }
    } else {
        // Output a message if there are no reviews
        echo "<p>No reviews found.</p>";
    }
    ?>

</body>

</html>