// functions to run and bind the parameters of the data before inserting into the database.
// this statement ($stmt = $pdo->prepare) will prevent the SQL injection 
// paki check nalang maigi Eugene, at paki-intindi. Thanks!


<?php

declare(strict_types=1);


function getUsername(object $pdo, string $username)
{
    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getEmail(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo ,string $username, string $password, string $email){
    $query = "INSERT INTO users(username, password, email) VALUES (:username, :password, :email)";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPwd);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

}