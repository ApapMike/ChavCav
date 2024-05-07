<?php

declare(strict_types=1);

function output_username(){
    if (isset($_SESSION["user_id"])){
}
}

function check_login_errors(){
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            // JavaScript code to show pop-up message
            echo '<script>alert("' . $error . '");</script>';
        }

        unset($_SESSION["errors_login"]);
    } elseif (isset($_GET['login']) && $_GET['login'] === "success") {
        // Optionally, display a success message
        echo '<script>alert("Login successful!");</script>';
        echo '<br>';
    }
}