<?php
//Connect to the database
include('./includes/db.php');
include('./includes/functions.php');

// Check if the user is logged in, if not redirect to login page
if (!is_logged_in()) {
    header("Location: ./auth/login.php");
    exit(); 
}

// Get a random recipe from the database to show as "Recipe of the Day" on the homepage
$randomQuery = "SELECT * FROM recipes ORDER BY RAND() LIMIT 1";
$randomResult = mysqli_query($conn, $randomQuery);
$dailyRecipe = mysqli_fetch_assoc($randomResult);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="home_body">
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
                    <!-- Admin Link only visible to admin -->
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item ms-4">
                        <a class="nav-link fw-bold text-danger" href="./admin.php">Admin Inbox</a>
                    </li>
                <?php endif; ?>
                    <li id="profile_desk" class="nav-item ms-4">
                        <a class="nav-link fw-bold" href="./profile.php ">Profile</a>
                    </li>
                </ul>
                <a id="profile_icon" href="./profile.php" class="ms-auto me-4">
                    <i class="fa-solid fa-circle-user"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="home_hero">
        <p class="home_title_black">Discover Your Next</p>
        <p class="home_title_meal">Favorite Meal</p>
       <div class="home_hero_search">
            <form action="list.php" method="GET">
                <input type="text" 
                    name="search" 
                    placeholder="Search for recipes..." 
                    class="home_search_input"
                    required>
                <button type="submit" class="home_search_submit">
                    <i class="fa-brands fa-sistrix"></i>
                </button>
            </form>
    </div>
    <div class="home_recipe">
        <p class="home_recipe_title">Recipe of the Day</p>
        <div class="home_recipe_container">
            <?php if($dailyRecipe): ?>
                <img src="<?php echo $dailyRecipe['thumbnail']; ?>" alt="<?php echo $dailyRecipe['name']; ?>" class="home_recipe_img" >
                <div class="home_recipe_info">
                    <div class="home_recipe_tags">
                        <p class="home_recipe_categorie_tag"><?php echo $dailyRecipe['category']; ?></p>
                        <p class="home_recipe_area_tag">Featured</p>
                    </div>

                    <h3 class="home_recipe_name"><?php echo $dailyRecipe['name']; ?></h3>

                    <p class="home_recipe_description">
                        Not sure what to cook today? Click the button and discover a random recipe. From quick meals to exotic dishes, each surprise is a chance to try something new and delicious!
                    </p>

                    <a href="recipes.php?id=<?php echo $dailyRecipe['id']; ?>" class="btn home_recipe_btn">View Recipe</a>
                </div>
            <?php else: ?>
                <p>No recipes found. Please add data to your 'recipes' table in WAMP.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="home_categories">
        <p class="home_categories_title">Popular Categories</p>
        <div class="home_categorie_cards">
            <div class="card " style="width: 18rem;">
                <img src="./images/vegan.webp" class="card-img-top  " style="height: 200px; object-fit: cover;"  alt="...">
                <div class="card-body">
                    <h5 class="card-title">Vegan</h5>
                    <a href="list.php?cat=Vegan" class="btn ">View Recipes</a>
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
                <img src="./images/side.webp" class="card-img-top" style="height: 200px; object-fit: cover;" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Side Dishes</h5>
                    <a href="list.php?cat=Side" class="btn">View Recipes</a>
                </div>
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
</body>

</html>