<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        require_once 'login_view.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // ERROR HANDLERS
        // CHECK FOR EMPTY FIELDS
        // CHECK IF USERNAME AND PASSWORD(BOTH HASHED AND UNHASHED) IS CORRECT
        // REVIEWHIN MO EUGENE
        $errors = [];

        if (isInputEmpty($username, $password)) {
            $errors["empty_input"] = "Fill all fields!";
        }

        $result = getUser($pdo, $username);

        if (isUsernameWrong($result)) {
            $errors["login_incorrect"] = "Incorrect Login info!";

        }
        
        if (!isUsernameWrong($result) && isPasswordWrong($password, $result["password"])) {
            $errors["login_incorrect"] = "Incorrect Login info!";
        }

        //I-start nya yung session para mag run yung error sa baba 
        require_once 'config_session.inc.php';

        if($errors){
            $_SESSION["errors_login"] = $errors;

            header("Location: ../index.php");
            die();
        }

        // If there are no errors, set session variables and redirect to homepage
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();
        header("Location: ../Homepage.php?login=success");
        exit(); // Terminate the script

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
}

else{
    header("Location: ../index.php");
    die();
}