<?php
include('./includes/db.php');
include('./includes/functions.php');

// Check if the user is logged in, if not redirect to login page
if (!is_logged_in()) {
    header("Location: ./auth/login.php");
    exit();
}

// Get the category from the URL, if not set default to empty string
$cat = isset($_GET['cat']) ? mysqli_real_escape_string($conn, $_GET['cat']) : '';
// Get the search term from the URL, if not set default to empty string
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Default query and category name
$category_name = "All Recipes"; 
$query = "SELECT * FROM recipes";// Default query to get all recipes, we will modify this based on filters below

//Modify the query based on filters
if (!empty($search)) {
    // If search term is provided, we search in both name and category columns for that term
    $query = "SELECT * FROM recipes WHERE name LIKE '%$search%' OR category LIKE '%$search%' ORDER BY id DESC";
    $category_name = $search;
} 
elseif (!empty($cat) && $cat !== 'All') {
    // If category is provided and it's not "All", we filter by that category
    $query = "SELECT * FROM recipes WHERE category = '$cat' ORDER BY id DESC";
    $category_name = $cat;
} 
else {
    // If no filters are provided or category is "All", we just get all recipes
    $query = "SELECT * FROM recipes ORDER BY id DESC";
    $category_name = "All Recipes";
}

// Execute the query and get the result
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe List - <?php echo e($cat); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <p class="categorie_title">Result for <span><?php echo e($cat); ?></span></p>
    <p class="categorie_subtitle"><span><?php echo $count; ?></span> premium recipes found</p>

    <div class="list_div">
    <!-- Loop through the results and display each recipe in a card format -->
    <?php if ($count > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="card" style="width: 18rem;">
                <img src="<?php echo e($row['thumbnail']); ?>" class="card-img-top" style="background-color:#032830; height: 200px; object-fit: cover;" alt="<?php echo e($row['name']); ?>">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo e($row['name']); ?></h5>
                    <a href="recipes.php?id=<?php echo $row['id']; ?>" class="btn mt-auto">View details</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-info w-100 text-center">No recipes found in this category.</div>
    <?php endif; ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>