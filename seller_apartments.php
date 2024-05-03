<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Apartments</title>
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

        .action-links a {
            margin-right: 8px;
        }
    </style>
</head>

<body>


    <?php
    include 'connect.php';
    include 'header.php';

    // Check if user is logged in
    if (!isset($_SESSION['user'])) {
        header("Location: login.php"); // Redirect to login page if not logged in
        exit;
    }

    $user_id = $_SESSION['user']['id'];

    // Fetch apartments owned by the logged-in user
    $sql = "SELECT * FROM apartment WHERE userid = $user_id";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>Image</th><th>Address</th><th>City</th><th>Price</th><th>Available</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td><img src='" . $row["image"] . "' width='200'></td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td>$" . $row["price"] . "</td>";
            echo "<td>" . ($row["available"] ? 'Yes' : 'No') . "</td>";
            echo "<td class='action-links'>";
            echo "<a href='edit_apartment.php?id=" . $row["id"] . "'>Edit</a>";
            echo "<a href='delete_apartment.php?id=" . $row["id"] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No apartments found.</p>";
    }
    ?>

    <a href="add_apartment.php">Add New Apartment</a>
</body>

</html>