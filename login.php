<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



</head>

<body>


    <div class="container">
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
            </div>

            <div class="form-button">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>

</html>

<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username and password match the user table
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION['user'] = $user;

        // Check user role and redirect accordingly
        if ($user['role'] == 'seller') {
            echo "<script>window.location.href = 'seller_dashboard.php';</script>";
            exit;
        } else {
            echo "<script>window.location.href = 'user_profile.php';</script>";
            exit;
        }
    } else {
        echo "Invalid username or password";
    }
}
?>