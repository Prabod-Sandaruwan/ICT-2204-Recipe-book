<?php
session_start();
include('../includes/db.php'); 
include('../includes/functions.php');

if (isset($_POST['login_btn'])) {
    // We get the email from the form
    $email = mysqli_real_escape_string($conn, validate_input($_POST['email']));
    $pass = validate_input($_POST['password']);

    // search email in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // verify the password using password_verify() function and redirect to index.php if successful
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = isset($row['role']) ? $row['role'] : 'user';
            header("Location: ../index.php");
            exit();
        } else {
            // Invalid password
            echo "<script>alert('Invalid Password!');</script>";
        }
    } else {
        // No account found with that email and say "please register first"
        echo "<script>alert('No account found with that email!please register first.');</script>";
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
        <p class="login_welcome">We’re happy to see you again. Please log in to continue.</p>

        <form action="login.php" method="POST">

            <h2>Login</h2>

            <label class="login_username" for="email">Email</label>
            <input class="login_input" type="email" id="email" name="email" placeholder="Enter your email"
                required>

            <label class="login_password" for="password">Password</label>
            <input class="login_input" type="password" id="password" name="password" placeholder="Enter your password"
                required>

            <button name="login_btn" class="login_button" type="submit">Login</button>

            <p class="login_register">
                Don't have an account? <a href="register.php">Register</a>
            </p>
        </form>
    </div>
</body>
</html>