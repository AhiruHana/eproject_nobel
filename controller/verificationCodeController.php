<?php
include_once 'repository/verificationCodeRepository.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = "";

    for ($i = 1; $i <= 6; $i++) {
        if (isset($_POST['token'.$i])) {
            $token = $token. $_POST['token'.$i];
        }
    }

    $checkToken = checkToken($token);

    if($checkToken !=null){
        header("Location: resetPassword.php");
    }else{
        $_SESSION['message'] = "Opps!";
        $_SESSION['text'] = "Verification is incorrect!";
        $_SESSION['status'] = "error";
        header("Location: verificationCode.php");
    }
}
