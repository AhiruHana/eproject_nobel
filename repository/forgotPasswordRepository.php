<?php
include_once 'createConnection.php';

function checkEmail($email)
{
    $query = '
        SELECT email FROM users WHERE email = "' . $email . '";
    ';
    $result = executeQuery($query);
    return $result;
}
function setCode($token,$email)
{
    $query = '
        UPDATE users SET resetCode = "'.$token.'", resetCodeTime = now() WHERE email = "'.$email.'"
    ';
    $result = executeQuery($query);
    return $result;
}

