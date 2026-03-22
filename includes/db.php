
<?php
// Database configuration for WAMP setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recipe_book";

//Create the connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check if the connection actually worked
if (!$conn) {
    // If it fails, stop the page and show the error
    die("Connection failed: " . mysqli_connect_error());
}

//Start the session this way we can use session variables across the site
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>