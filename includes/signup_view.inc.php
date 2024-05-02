<?php

declare(strict_types=1);


function signup_input (){

    if (isset($_SESSION["signup_data"]["username"]) && !isset
    ($_SESSION["error_signup"]["username_taken"])) {
        echo'<input type="text" name="username" placeholder="Username" value="' . $_SESSION["signup_data"]["username"] . '">';
    } else {
        echo '<input type="text" name="username" placeholder="Username">';
    }

    echo '<input type="password" name="password" placeholder="Password">';

    if (isset($_SESSION["signup_data"]["email"]) && !isset
    ($_SESSION["error_signup"]["email_registered"]) && !isset
    ($_SESSION["error_signup"]["invalid_email"])) {
        echo'<input type="text" name="email" placeholder="E-Mail" value="' . $_SESSION["signup_data"]["email"] . '">';
    } else {
        echo '<input type="text" name="email" placeholder="E-Mail">';
    }
}

function check_signup_error(){
    if (isset($_SESSION['error_signup'])) {
        $errors = $_SESSION['error_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class = "form-error">' . $error . '</p>';
        }

        unset($_SESSION['error_signup']);
    } elseif (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br>';
        echo '<p class="form-success">Signup Success!</p>';
    }
}