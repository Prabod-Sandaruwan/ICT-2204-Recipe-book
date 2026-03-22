<?php
session_start();
include('./includes/db.php');
include('./includes/functions.php');

$status = "";

// Check if the form is submitted and handle the message saving to the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_msg'])) {
    
    $name = mysqli_real_escape_string($conn, validate_input($_POST['name']));
    $email = mysqli_real_escape_string($conn, validate_input($_POST['email']));
    $message = mysqli_real_escape_string($conn, validate_input($_POST['message']));

    // Insert the message into the database
    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

    // Set the status based on whether the query was successful or not
    if (mysqli_query($conn, $sql)) {
        $status = "success";
    } else {
        $status = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand d-flex " href="./index.php">
                <img src="./images/logo.png" alt="Logo" width="30" height="30"
                    class="d-inline-block ms-4 align-text-top">
                <p class="mb-0 fw-bold">PremiumRecipes</p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link fw-bold" href="./categories.php">Categories</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link fw-bold" href="./recipes.php">Recipes</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a class="nav-link fw-bold" href="./contact.php">Contact Us</a>
                    </li>
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item ms-4">
                        <a class="nav-link fw-bold text-danger" href="./admin.php">Admin Inbox</a>
                    </li>
                <?php endif; ?>
                    <li id="profile_desk" class="nav-item ms-4">
                        <a class="nav-link fw-bold" href="./profile.php">Profile</a>
                    </li>
                </ul>
                <a id="profile_icon" href="./profile.php" class="ms-auto me-4">
                    <i class="fa-solid fa-circle-user"></i>
                </a>
            </div>
        </div>
    </nav>
    <div class="contact_head">
        <div class="contact_head_text">
            <p class="contact_lable">Our Story</p>
            <p class="contact_title">A passion for sharing global recipes and culinary exploration.</p>
            <p class="contact_subtitle">From a humble home kitchen to a global platform, our journey has been fueled by
                a deep-seated love for diverse cultures and authentic flavors. We believe that cooking is a universal
                language that brings people together.</p>
            <p class="contact_subtitle">Our mission is to provide you with meticulously tested, premium recipes that
                inspire creativity and confidence in your own kitchen. Every dish we share is a tribute to the
                traditions that make global cuisine so vibrant.</p>
            <div class="contact_count">
                <div class="recipe_count">
                    <p class="contact_count_numb">500+</p>
                    <p class="contact_count_text">Global Recipes</p>
                </div>
                <div class="categorie_count">
                    <p class="contact_count_numb">10+</p>
                    <p class="contact_count_text">Categories</p>
                </div>
            </div>
        </div>
        <div class="contact_head_img">
            <img src="./images/contact.png" alt="" class="contact_image">
        </div>
    </div>
    <div class="contact_bottom">
        <div class="contact_bottom_text">
            <p class="contact_bottom_title">Get in touch</p>
            <p class="contact_bottom_subtitle">Have a question about a recipe? We'd love to hear from you.</p>
            <div class="email">
                <i class="fa-solid fa-envelope"></i>
                <p class="contact_method">Email Us</p>
                <p class="contact_details">sandaruwanhapudeniya@gmail.com</p>
            </div>
            <div class="powered">
                <i class="fa-solid fa-bolt"></i>
                <p class="contact_method">Recipe from</p>
                <p class="contact_details">mealDB</p>
            </div>
        </div>
        <div class="contact_bottom_form">
            <form action="contact.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control contact_input" id="name" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control contact_input" id="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control contact_input" name="message" id="message" rows="4"
                        placeholder="Enter your message"></textarea>
                </div>
                <button name="submit_msg" type="submit" class="contact_btn">Submit</button>
            </form>
            <?php if($status == "success"): ?>
                <div class="status-msg success-alert">
                    Message Sent Successfully!
                </div>
            <?php endif; ?>
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
            <p class="copyright">© 2023 PremiumRecipes. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</body>

</html>