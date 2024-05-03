<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Apartment</title>
</head>

<body>
    <h2>Add Apartment</h2>
    <form method="POST" action="add_apartment.php" enctype="multipart/form-data">

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>
        </div>
        <div>
            <label for="available">Available:</label>
            <select id="available" name="available" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <input type="submit" value="Add Apartment">
    </form>

</body>

</html>
<?php
include 'connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user']['id'];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $price = $_POST["price"];
    $available = $_POST["available"];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $apartmentImage = $_FILES['image']['name'];
        $apartmentImageTmp = $_FILES['image']['tmp_name'];


        $uniqueId = uniqid();
        $apartmentImageName = $uniqueId . '_' . $apartmentImage;


        $targetDirectory = "apartment_image/";
        $targetFile = $targetDirectory . basename($apartmentImageName);


        if (move_uploaded_file($apartmentImageTmp, $targetFile)) {

            $sql = "INSERT INTO apartment (userid, name, address, city, price, available, image) VALUES ('$user_id', '$name', '$address', '$city', '$price', '$available', '$targetFile')";
            if ($connect->query($sql) === TRUE) {
                echo "Apartment added successfully!";
                header("Location: user_profile.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $connect->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {

        $sql = "INSERT INTO apartment (userid, name, address, city, price, available) VALUES ('$user_id', '$name', '$address', '$city', '$price', '$available')";
        if ($connect->query($sql) === TRUE) {
            echo "Apartment added successfully!";
            header("Location: user_profile.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}

?>