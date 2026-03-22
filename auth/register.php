<?php
include('../includes/db.php'); 
include('../includes/functions.php');

if (isset($_POST['register_btn'])) {
    // Get data from the form
    $user = mysqli_real_escape_string($conn, validate_input($_POST['username']));
    $email = mysqli_real_escape_string($conn, validate_input($_POST['email']));
    $pass = validate_input($_POST['password']);

    //Encrypt the password using password_hash() function
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    //SQL to insert into your 'users' table
    $query = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hashed_password')";

    if (mysqli_query($conn, $query)) {
        // after successful registration, show an alert and redirect to login page
        echo "<script>alert('Registration Successful! Please Login.'); window.location='login.php';</script>";
    } else {
        // If there's an error during registration, show an alert with the error message
        echo "<script>alert('Registration Failed. Please try again.'); window.location='register.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="login_container">
    <p class="login_title">
            <img src="../images/logo.png" class="login_logo" alt="logo">
            PremiumRecipes</p>
    <p class="login_welcome">Create an account to explore delicious recipes.</p>
    <form action="register.php" method="POST">

        <h2>Create Account</h2>
        <p class="login_message">Sign up to get started</p>

        <input type="text" name="username" placeholder="Username" class="login_input" required>

        <input type="email" name="email" placeholder="Email" class="login_input" required>

        <input type="password" name="password" placeholder="Password" class="login_input" required>

        <button name="register_btn" type="submit" class="login_button">Register</button>

        <p style="margin-top:20px;">
            Already have an account? <a href="login.php">Login</a>
        </p>
    </form>
</div>
</body>
</html>