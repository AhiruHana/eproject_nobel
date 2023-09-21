<?php
include_once 'createConnection.php';

function checkUsername($username)
{
    $query = "
    SELECT * FROM `users` WHERE username = '" . $username . "'
    ";
    $result = executeQuery($query);
    return $result;
    // var_dump($result);
}

function createUser($username, $password, $role)
{

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "
        INSERT INTO `users`(`username`, `password`, `role`, `create_date`) 
        VALUES ('" . $username . "','" . $hashedPassword . "','" . $role . "',now());
    ";
    $result = executeQuery($query);
    return $result;
    // var_dump($query);
}

function updateUser($username, $password, $role, $id)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "
        UPDATE`users`SET `username`='" . $username . "', `role`='" . $role . "'
    ";
    if ($password != "") {
        $query = $query . ",`password`='" . $hashedPassword . "'";
    }
    $query = $query . "WHERE id='" . $id . "'";
    
    $result = executeQuery($query);
    return $result;
    // var_dump($query);
}
