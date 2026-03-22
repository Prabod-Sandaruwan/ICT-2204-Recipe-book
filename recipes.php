<?php
include('./includes/db.php');

// Get the recipe ID from the URL query string
$recipe_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($recipe_id > 0) {
  // Fetch the recipe details from the database using the ID/
    $query = "SELECT * FROM recipes WHERE id = $recipe_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $recipe = mysqli_fetch_assoc($result);

    // If no recipe is found, redirect to the list page
    if (!$recipe) {
        header("Location: list.php");
        exit();
    }
} else {
    header("Location: list.php");
    exit();
}

// Security function
function e($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
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
    <div class="search_area">
        <form action="#" class="search_form">
            <input type="text" placeholder="Search for recipes..." class="search_input">
            <button class="search_submit"><i class="fa-brands fa-sistrix"></i></button>
        </form>
    </div>
    <div class="main_recipe_area">
        <div class="recipe_head">
                <img class="recipe_page_img" src="<?php echo e($recipe['thumbnail']); ?>" alt="Recipe Image">
            <p class="recipe_tag"><?php echo e($recipe['category']); ?></p>
            <p class="recipe_name"><?php echo e($recipe['name']); ?></p>
        </div>
        <div class="recipe_bottom">        
            <div class="ingrediant">
    <table>
        <?php 
        // Split the comma-separated strings into arrays
        $ingredients_array = explode(',', $recipe['all_ingredients']);
        $measures_array    = explode(',', $recipe['all_measures']);
        
       // Loop through the arrays and display the ingredients with their measures
        for ($i = 0; $i < count($ingredients_array); $i++): 
            $name = isset($ingredients_array[$i]) ? trim($ingredients_array[$i]) : '';
            $qty  = isset($measures_array[$i]) ? trim($measures_array[$i]) : '';
        ?>
            <tr>
                <td><?php echo e($name); ?></td>
                <td><?php echo e($qty); ?></td>
            </tr>
        <?php endfor; ?>
    </table>
</div>
            <div class="step">
                <p class="instruction_tit">Instructions</p>
                <p class="instruction_info"><?php echo e($recipe['instructions']); ?></p>
                <?php
                    $yt = trim($recipe['youtube'] ?? '');
                    $embed = '';
                    if ($yt !== '') {
                        // extract video id from common YouTube URL forms
                        if (preg_match('/(?:v=|\/embed\/|\.be\/)([A-Za-z0-9_-]{6,})/', $yt, $m)) {
                            $vid = $m[1];
                        } elseif (preg_match('/^[A-Za-z0-9_-]{6,}$/', $yt)) {
                            $vid = $yt; // already an id
                        } else {
                            $vid = '';
                        }
                        if ($vid) {
                            // use privacy-enhanced embed domain
                            $embed = 'https://www.youtube-nocookie.com/embed/' . $vid;
                        }
                    }

                    if ($embed): ?>
                        <div class="ratio ratio-16x9 mb-2">
                            <iframe src="<?php echo e($embed); ?>" title="YouTube video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>
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