<?php
session_start();
include('./includes/db.php');
include('./includes/functions.php');

// Check if the user is logged in and has admin role, if not redirect to index.php
if (!is_logged_in() || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

//Fetch all messages from the database
$sql = "SELECT * FROM messages ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// Fetch total users count for the status section
$user_res = mysqli_query($conn, "SELECT COUNT(*) AS count FROM users");
$user_row = mysqli_fetch_assoc($user_res);
$totalUsers = $user_row['count'];

// Fetch total recipes count for the status section
$recipe_res = mysqli_query($conn, "SELECT COUNT(*) AS count FROM recipes");
$recipe_row = mysqli_fetch_assoc($recipe_res);
$totalRecipes = $recipe_row['count']; // This variable will be used in the HTML below to show total recipes in the status section
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Messages</title>
    <link rel="stylesheet" href="./css/styles.css"> 
</head>
<body>

<div class="admin-container">
    <a href="index.php" class="admin-back-link">< Back to Site</a>

    <div class="status">
        <div class="total_users">Total Users: <?php echo $totalUsers; ?></div>
        <div class="total_recipes">Total Recipes: <?php echo $totalRecipes; ?></div>
    </div>
    <h2 class="admin-title">User Inquiries</h2>

    <div class="admin-table-wrapper">
        <table class="admin-data-table">
            <thead>
                <tr>
                    <th>Sender Name</th>
                    <th>Email Address</th>
                    <th>Message Details</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Loop through the messages and display them in the table
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td class='admin-msg-text'>" . nl2br(htmlspecialchars($row['message'])) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='admin-no-data'>No messages found in database.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>