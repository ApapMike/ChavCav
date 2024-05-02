<?php

declare(strict_types=1);

//check kung walang laman ang input
function is_input_empty(string $username, string $password, string $email){

    if(empty($username) || empty($password) || empty($email)){
        return true;
    }   else{
            return false;
        }

} 
// Check yung email
function is_email_invalid($email){

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }   else {
            return false;
        }

} 
//check yung username kung meron na
function is_username_taken(object $pdo, string $username){

    if (getUsername($pdo, $username)) {
        return true;
    }   else {
            return false;
        }

}
//check email kung registered na
function is_email_registered(object $pdo, string $email){

    if (getEmail($pdo, $email)) {
        return true;
    }   else {
            return false;
        }

}

function createUser(object $pdo ,string $username, string $password, string $email){
    set_user($pdo ,$username, $password, $email);
}