<?php
include 'connect.php';
session_start();
$u = $_SESSION['user'];

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE id = {$u['id']}";
$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user['id'] = $row['id']; // Add this line to fetch the user ID
    $user['name'] = $row['name'];
    $user['nic'] = $row['nic'];
    $user['phone'] = $row['phone'];
    $user['address'] = $row['address'];
    $user['dob'] = $row['dob'];
    $user['email'] = $row['email'];
    $user['username'] = $row['username'];
    $user['password'] = $row['password'];

    $user['profile_image'] = $row['profile_image']; // Add this line to fetch the profile image
} else {
    echo "No user found!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>

<body>
    <h1>User Profile</h1>

    <form method="POST" action="user_profile_update.php" enctype="multipart/form-data">

        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>
        </div>
        <div>
            <label for="nic">NIC:</label>
            <input type="text" id="nic" name="nic" value="<?php echo $user['nic']; ?>" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
        </div>
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" required>
        </div>
        <div>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo $user['dob']; ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>" required>
        </div>
        </br>
        <div>
            <label for="profile_image">Profile Picture:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*">
            <?php if (isset($user['profile_image']) && !empty($user['profile_image'])): ?>
            <img id="imagePreview" src="profile_img/<?php echo $user['profile_image']; ?>" alt="Profile Image"
                style="max-width: 200px; max-height: 200px;">
            <?php else: ?>
            <img id="imagePreview" src="" alt="Profile Image"
                style="max-width: 200px; max-height: 200px; display: none;">
            <?php endif; ?>
        </div>

        <input type="submit" value="Update Profile">
    </form>
    <form method="POST" action="delete_user.php">
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
        <input type="submit" value="Delete Account">
    </form>

</body>
<script>
document.getElementById('profile_image').addEventListener('change', function(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
        var imagePreview = document.getElementById('imagePreview');
        imagePreview.src = reader.result;
        imagePreview.style.display = 'block';
    };

    reader.readAsDataURL(input.files[0]);
});
</script>

</html>