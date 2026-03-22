<?php
// 1. Include the database connection
include('./includes/db.php');
include('./includes/functions.php');

//logout logic
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: ./auth/login.php");
    exit();
}

// Check if the user is logged in, if not redirect to login page
if (!is_logged_in()) {
    header("Location: ./auth/login.php");
    exit();
}

// Get the username from the session to display on the profile page
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | PremiumRecipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand d-flex " href="./index.php">
                <img src="./images/logo.png" alt="Logo" width="30" height="30" class="d-inline-block ms-4 align-text-top">
                <p class="mb-0 fw-bold">PremiumRecipes</p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link fw-bold" href="./index.php">Home</a></li>
                    <li class="nav-item ms-4"><a class="nav-link fw-bold" href="./categories.php">Categories</a></li>
                    <li class="nav-item ms-4"><a class="nav-link fw-bold" href="./recipes.php">Recipes</a></li>
                    <li class="nav-item ms-4"><a class="nav-link fw-bold" href="./contact.php">Contact Us</a></li>
                    <li id="profile_desk" class="nav-item ms-4">
                        <a class="nav-link fw-bold active" href="./profile.php">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="profile_body">
        <div class="profile_container">
            <img src="./images/avatar.png" alt="profile avatar"  class="profile_avatar">
            <p class="username"><?php echo $username; ?></p>
            
            <a href="profile.php?action=logout"  class="logout">Logout</a>
        </div>
    </div>
    
    <footer>
        <div>
            <div class="footer_logo">
                <img src="./images/logo.png" alt="footer logo">
                <p>PremiumRecipes</p>
            </div>
            <div class="footer_links">
                <p>Quick Links</p>
                <a href="./index.php">Home</a>
                <a href="./categories.php">Categories</a>
                <a href="./recipes.php">Recipes</a>
                <a href="./contact.php">Contact Us</a>
            </div>
            <div class="footer_conect">
                <p class="footer_conect_text">Connect</p>
                <div class="footer_conect_links">
                    <a href="https://github.com/Prabod-Sandaruwan" target="_blank" rel="noopener"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/sandaruwan-hapudeniya" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="mailto:sandaruwanhapudeniya@gmail.com"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>
        </div>
        <div>
            <!-- Copyright get year using PHP -->
            <p class="copyright">© <?php echo date("Y"); ?> PremiumRecipes. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="./js/script.js"></script>
</body>
</html>