<?php
include 'connect.php';
include 'header.php';

// Fetch available apartments from the database
$sql = "SELECT * FROM apartment WHERE available = 1";
$result = $connect->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Apartments</title>
    <style>
        .apartment {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }

        .apartment h3 {
            margin-top: 0;
        }

        .apartment p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <h2>Available Apartments</h2>

    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<div class='apartment'>";
            echo "<h3>" . $row["name"] . "</h3>";
            echo "<p>Address: " . $row["address"] . "</p>";
            echo "<img src='" . $row["image"] . "' width='200'>";
            echo "<p>City: " . $row["city"] . "</p>";
            echo "<p>Price: $" . $row["price"] . "</p>";
            // Add "View" button with link to view_apartment.php
            echo "<a href='view_apartment.php?id=" . $row["id"] . "'><button>View</button></a>";
            echo "</div>";
        }
    } else {
        echo "<p>No available apartments.</p>";
    }
    ?>

</body>

</html>