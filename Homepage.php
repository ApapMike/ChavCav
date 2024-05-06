<?php
// Include the necessary files
require_once 'includes/config_session.inc.php'; // This file should start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, display a pop-up message and redirect to the login page
    echo "<script>alert('You need to log in first to access this page. Redirecting...');</script>";
    header("Refresh: 2; URL=index.php"); // Redirect to the login page after 3 seconds
    exit; // Terminate the script
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="./imgs/tablogo.ico">
</head>
<body>
    <!-- Your homepage content goes here -->
    <header>
        <div class="logo">
            <img src="./imgs/logo.png" alt="Logo">
        </div>
        <div class="logout-container">
            <!-- Display logout button -->
            <form action="includes/logout.inc.php" method="post">
                <button class="logout">Logout</button>
            </form>
        </div>
    </header>
    <!-- Other content goes here -->
</body>
</html>
