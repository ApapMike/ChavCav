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
    </form>

    <?php 
    check_login_errors();
    ?>

    <form id="signup-form" action="includes/signup.inc.php" method="post">
        <h2>Sign Up</h2>
        <?php 
            signup_input ()
        ?>
        <input type="submit" name="signup-submit" value="Sign Up">
    </form>

    <?php
    check_signup_error();
    ?>
</body>
</html>


