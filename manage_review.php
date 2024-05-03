<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Admin Dashboard</h2>

    <?php
    include 'connect.php';

    // Fetch reviews from the database
    $sql = "SELECT * FROM reviews";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        // Display reviews in a table
        echo "<table>";
        echo "<tr><th>User</th><th>Email</th><th>Comment</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["user_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["comment"] . "</td>";
            echo "<td><a href='edit_review.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_review.php?id=" . $row["id"] . "'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No reviews found.</p>";
    }
    ?>

    <a href="add_review.php">Add New Review</a>
</body>

</html>