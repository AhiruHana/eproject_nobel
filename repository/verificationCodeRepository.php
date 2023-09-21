<?php
include_once 'createConnection.php';

function checkToken($token)
{
    $query = '
        SELECT resetCode FROM users WHERE resetCode = "' . $token . '"
    ';
    $result = executeQuery($query);
    var_dump($query);
    return $result;
}
