<?php
include_once 'repository/contactRepository.php';

$name = "";
$email = "";
$message = "";

if (isset($_POST["name"])) {
    $name = $_POST["name"];
}
if (isset($_POST["email"])) {
    $email = $_POST["email"];
}
if (isset($_POST["email"])) {
    $message = $_POST["message"];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["submit"])) {
        $result = sendMessage($name, $email, $message);
        if ($result) {
            $_SESSION['message'] = "The message was sent successfully!";
            $_SESSION['text']= "";
            $_SESSION['status'] = "success";

            header("Location:contact.php");
            exit();
        } else {
            $_SESSION['message'] = "Oops...";
            $_SESSION['text'] = "Something went wrong!";
            $_SESSION['status'] = "error";

            header("Location:contact.php");
            exit();
        }
        
    }
}

?>