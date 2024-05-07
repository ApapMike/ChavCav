<?php
// Include the necessary files
require_once 'includes/config_session.inc.php'; // This file should start the session
require_once 'includes/dbh.inc.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, display a pop-up message and redirect to the login page
    echo "<script>alert('You need to log in first to access this page. Redirecting...');</script>";
    header("Refresh: 2; URL=index.php"); // Redirect to the login page after 3 seconds
    exit; // Terminate the script
}

// Fetch user information from the database
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, email, first_name, last_name FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data is retrieved successfully
if ($user) {
    // Extract username, email, first name, and last name from the $user array
    $username = $user['username'];
    $email = $user['email'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
} else {
    // If user data is not found, display an error message
    echo "Error: User data not found";
    exit;
}

// Check if the form was submitted and update user information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $password = $_POST['password'];
        // Check if the user has updated their first name and last name
        if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
            // Fields are readonly if first name and last name are set in session
            $readonly = 'readonly';
        } else {
            // Fields are editable if first name and last name are not set in session
            $readonly = '';
        }
    // Update the user information in the database
    $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, password = ? WHERE id = ?");
    $stmt->execute([$firstName, $lastName, $password, $user_id]);

    // Check if the update was successful
    if ($stmt) {
        // Set session variable to indicate successful update
        $_SESSION['profile_updated'] = true;
    } else {
        // Redirect back to the userpage with an error message
        $_SESSION['error_message'] = "Failed to update user information. Please try again.";
        header("Location: userpage.php");
        exit; // Terminate the script
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Info</title>
    <link rel="stylesheet" href="css/edituser.css">
</head>
<body>
    <header>
    <h1>Edit User Info</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="username" readonly>Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>
        </div>
        <div>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo isset($_SESSION['first_name']) ? htmlspecialchars($_SESSION['first_name']) : ''; ?>" <?php echo isset($_SESSION['profile_updated']) ? 'readonly' : ''; ?>>
        </div>
        <div>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo isset($_SESSION['last_name']) ? htmlspecialchars($_SESSION['last_name']) : ''; ?>" <?php echo isset($_SESSION['profile_updated']) ? 'readonly' : ''; ?>>
        </div>
        <div>
            <label for="email" readonly>Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
        </div>
        <div>
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit">Update</button>
    </form>
    </header>
</body>
</html>
