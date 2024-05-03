<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
</head>

<body>
    <h2>Sign Up</h2>
    <form action="signup.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="nic">NIC:</label>
        <input type="text" id="nic" name="nic" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">I am a:</label>
        <select id="role" name="role">
            <option value="buyer">Buyer</option>
            <option value="seller">Seller</option>
        </select><br><br>

        <label for="profile_image">Profile Image:</label>
        <input type="file" id="profile_image" name="profile_image"><br><br>

        <button type="submit">Sign Up</button><br><br>
    </form>

</body>

</html>
<?php
include 'connect.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Database connection


    // Get the image file
    $profileImage = $_FILES['profile_image']['name'];
    $profileImageTmp = $_FILES['profile_image']['tmp_name'];

    // Generate a unique ID for the image file
    $uniqueId = uniqid();
    $profileImageName = $uniqueId . '_' . $profileImage;

    // Move the uploaded image to a desired location
    $targetDirectory = "profile_img/";
    $targetFile = $targetDirectory . basename($profileImageName);
    move_uploaded_file($profileImageTmp, $targetFile);

    $sql = "INSERT INTO users (name, nic, phone, address, dob, email, username, password, role, profile_image) VALUES ('$name', '$nic', '$phone', '$address', '$dob', '$email', '$username', '$password', '$role', '$profileImageName')";

    // Execute the statement
    if ($connect->query($sql) === TRUE) {

        echo "User inserted successfully!";
        echo '<script>window.location.href = "login.php";</script>';

    } else {
        echo "Error: " . $connect->error;
    }

    // Close the connection
    $connect->close();
}
?>