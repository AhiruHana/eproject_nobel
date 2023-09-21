<?php
include_once 'repository/resetPasswordRepository.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (isset($_POST['confirm-password'])) {
        $confirmPassword = $_POST['confirm-password'];
    }

    if ($password != $confirmPassword) {
        $_SESSION['message'] = "Something went wrong!";
        $_SESSION['text'] = "Password and Confirm password must be coincide!";
        $_SESSION['status'] = "error";
        header("Location: resetPassword.php");
        exit();
    } else {
        $email = $_SESSION['email'];
        $resetPassword = resetPassword($password, $email);

        $_SESSION['message'] = "Reset password successfully!";
        $_SESSION['text'] = " Please login again!";
        $_SESSION['status'] = "success";

        $_SESSION['changePassword'] = "true";
    }
}
