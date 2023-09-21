<?php
function createConnection()
{
    $host = "localhost";
    $user = "root";
    $password = 'password';
    $database = 'eproject_biograph';
    $connect = new mysqli($host, $user, $password, $database);
    if ($connect->connect_error) {
        return null;
    } else {
        return $connect;
    }
}
function executeQuery($query)
{
    $connection = createConnection();
    $result = $connection->query($query);
    
    if ($result === true) {
        return true;
    } else if ($result === false) {
        return false;
    } else {
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
        }
        return $data;
    }
}
