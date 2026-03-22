<?php
// Start the session and include the database connection
include('./includes/db.php');
include('./includes/functions.php');

// Check if the user is logged in, if not redirect to login page
if (!is_logged_in()) {
    header("Location: ./auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
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
    <p class="categorie_title">Explore Categories</p>
    <p class="categorie_subtitle">Dive into our hand-picked collections. From comforting home classics to exotic
        seafood, discover your next favorite meal.</p>
    <div class="categorie_div">
        <!-- bootstrap cards -->
        <div class="card " style="width: 18rem;">
            <img src="./images/beef.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Beef</h5>
                <a href="list.php?cat=Beef" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/chicken.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Chicken</h5>
                <a href="list.php?cat=Chicken" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/dessert.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Dessert</h5>
                <a href="list.php?cat=Dessert" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/miscellaneous.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Miscellaneous</h5>
                <a href="list.php?cat=Miscellaneous" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/pasta.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Pasta</h5>
                <a href="list.php?cat=Pasta" class="btn ">View Recipes</a>
            </div>
        </div>

        <div class="card " style="width: 18rem;">
            <img src="./images/pork.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Pork</h5>
                <a href="list.php?cat=Pork" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/seafood.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Seafood</h5>
                <a href="list.php?cat=Seafood" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/side.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Side</h5>
                <a href="list.php?cat=Side" class="btn ">View Recipes</a>
            </div>
        </div>

        <div class="card " style="width: 18rem;">
            <img src="./images/starter.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Starter</h5>
                <a href="list.php?cat=Starter" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/vegan.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Vegan</h5>
                <a href="list.php?cat=Vegan" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/vegitarian.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Vegetarian</h5>
                <a href="list.php?cat=Vegetarian" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/breakfast.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Breakfast</h5>
                <a href="list.php?cat=Breakfast" class="btn ">View Recipes</a>
            </div>
        </div>
        <div class="card " style="width: 18rem;">
            <img src="./images/goat.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title">Goat</h5>
                <a href="list.php?cat=Goat" class="btn ">View Recipes</a>
            </div>
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
                <p>Connect</p>
                <div class="footer_conect_links">
                    <a href="https://github.com/Prabod-Sandaruwan" target="_blank" rel="noopener"><i class="fa-brands fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/sandaruwan-hapudeniya" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="mailto:sandaruwanhapudeniya@gmail.com"><i class="fa-solid fa-envelope"></i></a>
                </div>
            </div>
        </div>
        <div>
            <p class="copyright">© 2026 PremiumRecipes. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>