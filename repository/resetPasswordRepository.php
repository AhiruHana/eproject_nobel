<?php
include_once 'createConnection.php';


function resetPassword($password, $email)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE `users` SET `password`='" . $hashedPassword . "' WHERE `email` = '" . $email . "'";
    $result = executeQuery($query);
    return $result;
}