<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="shortcut icon" type="image/x-icon" href="./imgs/tablogo.ico">
</head>
<body>

<form id="login-form" action="includes/login.inc.php" method="post">
    <h2>Login</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Login">
    <button onclick="toggleForms()">Sign Up</button>
    <div>
        <a href="forgot_password.php">Forgot Password?</a>
    </div>

<?php 
    check_login_errors();
?>

</form>

<form id="signup-form" action="includes/signup.inc.php" method="post" style="display: none;">
    <h2>Sign Up</h2>
    <?php 
        signup_input ()
    ?>
    <input type="submit" name="signup-submit" value="Sign Up">
    <button onclick="toggleForms()">Login</button>
    <?php 

    check_signup_error();
?>
</form>

<script>
    // Function to toggle between login and signup forms
    function toggleForms() {
        var loginForm = document.getElementById('login-form');
        var signupForm = document.getElementById('signup-form');

        if (loginForm.style.display === 'none') {
            loginForm.style.display = 'block';
            signupForm.style.display = 'none';
        } else {
            loginForm.style.display = 'none';
            signupForm.style.display = 'block';
        }
    }
</script>

</body>
</html>
