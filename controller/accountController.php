<?php
include_once 'repository/adminRepository.php';
include_once 'repository/accountRepository.php';

$currentPassword = "";
$newPassword = "";
$confirmPassword = "";
$username = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['current-password'])) {
        $currentPassword = $_POST['current-password'];
    }

    if (isset($_POST['new-password'])) {
        $newPassword = $_POST['new-password'];
    }
    if (isset($_POST['confirm-password'])) {
        $confirmPassword = $_POST['confirm-password'];
    }

    if ($currentPassword != "" && $newPassword != "") {

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }
        $result = getUser($username);

        if ($result != null) {
            $user = $result;
            $hashedPasswordFromDB = $user['password'];

            if (password_verify($currentPassword, $hashedPasswordFromDB)) {

                if ($newPassword == $currentPassword) {
                    $_SESSION['message'] = "Something went wrong!";
                    $_SESSION['text'] = "New Password and Current password must not be coincide!";
                    $_SESSION['status'] = "error";
                    
                    header("Location: account.php");
                    exit();
                } else {

                    if ($newPassword == $confirmPassword) {
                        changePassword($newPassword, $username);

                        $_SESSION['message'] = "Change password successfully!";
                        $_SESSION['text'] = " Please login again!";
                        $_SESSION['status'] = "success";

                        $_SESSION['changePassword'] ="true";
                        
                    } else {
                        $_SESSION['message'] = "Something went wrong!";
                        $_SESSION['text'] = "New Password and Confirm Password must be coincide!";
                        $_SESSION['status'] = "error";

                        header("Location: account.php");
                        exit();
                    }
                }
            } else {
                $_SESSION['message'] = "Something went wrong!";
                $_SESSION['text'] = "Password is incorrect!";
                $_SESSION['status'] = "error";

                header("Location: account.php");
                exit();
            }
        }
    }
}
