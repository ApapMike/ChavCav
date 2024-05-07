<?php
// Include the necessary files
require_once 'includes/config_session.inc.php'; // This file should start the session
require_once 'includes/dbh.inc.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: index.php");
    exit; // Terminate the script
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the database query to update user information
    $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, password = ? WHERE id = ?");
    $stmt->execute([$firstName, $lastName, $hashedPassword, $_SESSION['user_id']]);

    // Check if the query was successful
    if ($stmt) {
        // Set session variable to indicate successful update
        $_SESSION['profile_updated'] = true;

        
        // Redirect back to the userpage with a success message
        header("Location: userpage.php");
        exit; // Terminate the script
        
    } else {
        // Redirect back to the userpage with an error message
        $_SESSION['error_message'] = "Failed to update user information. Please try again.";
        header("Location: userpage.php");
        exit; // Terminate the script
    }
} else {
    // If the form was not submitted via POST method, redirect to the userpage
    header("Location: userpage.php");
    exit; // Terminate the script
}

