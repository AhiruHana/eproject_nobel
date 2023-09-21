<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once 'repository/forgotPasswordRepository.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    $checkEmail = checkEmail($email);
    // var_dump( $checkEmail);
    if ($checkEmail != null) {
        //Cap nhat resetCode
        $token = "";
        for ($i = 0; $i < 6; $i++) {
            $token .= random_int(0, 9);
        }

        $expirationTime = time() + (5 * 60);
        
        setcode($token,$email);

        //Gui mail
        $mail = new PHPMailer(true);

        // Cấu hình thông tin máy chủ SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'nvy1621@gmail.com';
        $mail->Password = 'ocinttzxalhymith';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Cấu hình thông tin người gửi 
        $mail->setFrom('nvy1621@gmail.com', 'Biography');
        // Cấu hình thông tin người nhận
        $mail->addAddress($email);

        // Cấu hình nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Verification codes';
        $mail->Body = 'Đây là mã xác thực của bạn "'.$token.'"';
        // $mail->Body = 'Nhấp vào link để đổi mật khẩu <a href="localhost/resetPassword.php?resetCode="'.$token.'"';


        if ($mail->send()) {
            $_SESSION['email']= $email;
            header("Location: verificationCode.php");
        } else {
            echo 'Error: ' . $mail->ErrorInfo;
        }
    } else {
        $_SESSION['message'] = "Opps!";
        $_SESSION['text'] = "No email found! Please enter your email address again!";
        $_SESSION['status'] = "error";
        header("Location: forgotPassword.php");
        exit();
    }
}
