<?php
include_once 'createConnection.php';

function sendMessage($name,$email,$message){
    $query = "
        INSERT INTO `feedback`(`name`, `email`, `message`,`sending_time`,`status`) 
        VALUES ('".$name."','".$email."','".mysqli_real_escape_string(createConnection(), $message)."',now(),0)
    ";
    
    $result = mysqli_query(createConnection(), $query);
    return $result;

}


