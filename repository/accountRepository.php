<?php
include_once 'createConnection.php';

function changePassword($newPassword, $username)
{
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $query = "UPDATE `users` SET `password`='" . $hashedPassword . "' WHERE `username` = '" . $username . "'";
    $result = executeQuery($query);
    return $result;
}

function getUser($username)
{
    $query = "SELECT * FROM users WHERE username = '" . $username . "'";
    $result = executeQuery($query);
    return reset($result);
}
