<?php
include_once 'createConnection.php';

function getUser($username)
{
    $query = "SELECT * FROM users WHERE username = '" . $username . "'";
    $result = executeQuery($query);
    return reset($result);
}

