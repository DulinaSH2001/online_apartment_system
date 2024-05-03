<?php
include 'connect.php';

// Check if an apartment ID is provided in the URL
if (isset($_GET['id'])) {
    $apartment_id = $_GET['id'];

    // Fetch apartment details from the database
    $sql = "SELECT * FROM apartment WHERE id = $apartment_id";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $apartment = $result->fetch_assoc();
        // Display apartment details
        echo "<h2>" . $apartment["name"] . "</h2>";
        echo "<p>Address: " . $apartment["address"] . "</p>";
        echo "<p>City: " . $apartment["city"] . "</p>";
        echo "<p>Price: $" . $apartment["price"] . "</p>";
        // Add more details as needed
    } else {
        echo "<p>Apartment not found.</p>";
    }
} else {
    echo "<p>Apartment ID not provided.</p>";
}
?>