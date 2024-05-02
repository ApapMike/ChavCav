<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    try {
        
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';
        
        // ERROR HANDLERS
        // CHECK FOR EMPTY FIELDS
        $errors = [] ;

        if (is_input_empty($username, $password, $email)){
            $errors["empty_input"] = "Fill all fields!";
        }
        if(is_email_invalid($email)){
            $errors["invalid_email"] = "Invalid E-mail!";
        }
        if(is_username_taken($pdo, $username)){
            $errors["username_taken"] = "Username is already taken!";
        }
        if(is_email_registered($pdo, $email)){
            $errors["email_registered"] = "Email is already registered";
        }
        //I-start nya yung session para mag run yung error sa baba 
        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["error_signup"] = $errors;

            $signUpData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signUpData;

            header("Location: ../index.php");
            die();
        }

        createUser( $pdo , $username,  $password,  $email);

        header("Location: ../index.php?signup=success");
        
        $pdo = null;
        $stmt = null;


        die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

}else {
    header("Location: ../index.php");
    die();
}