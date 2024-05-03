<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:wght@300&display=swap');

*{
padding: 0;
margin: 0;
font-family: "Open Sans", sans-serif;
}

body {
background-image: url('img/login.jpg'); 
background-position: center;
background-repeat: no-repeat;
color: #1C1678; 
}

.container {
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
}

form {
padding: 20px;
width: auto;
background-color: rgb(174, 226, 255, 0.75); /* Blue color theme with some transparency */
border-radius: 10px;
width: 25%;
padding: 50px;
}

.form-group {
display: flex;
flex-direction: column;
}

.form-button {
display: flex;
justify-content: center;
}

input[type="text"],
input[type="password"] {
width: 100%;
height: 30px;
border: none;
border-radius: 10px;
background-color: white;
}

input[type="submit"] {
width: 50%;
border-radius: 20px;
border: none;
height: 30px;
font-size: 20px;
background-color: #00A9FF;
color: #1C1678;
}

.signup-button {
    background-color: #4CAF50;
    color: white;
    text-align: center;
    display: inline-block;
    font-size: 20px;
    cursor: pointer;
    border-radius: 20px;
    border: none;
    height: 30px;
    font-size: 20px;
    width: 50%;
}





</style>

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
                <button class="signup-button" onclick="window.location.href='signup.php'">Sign Up</button>
            </div>

        </form>
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
            echo "<script>window.location.href = 'user_profile.php';</script>";
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