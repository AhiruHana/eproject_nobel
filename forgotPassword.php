<?php
session_start();
require_once 'controller/forgotPasswordController.php'; 
include_once 'layout/head.php';
?>
<!DOCTYPE html>
<html lang="en">
<body>

    <div id="wrap">
        <div id="main">
            <div class=" py-5" style="background-color: white; width:30%;margin:0 auto; border-radius:10px;">
                <div class="mx-3">
                <a href="login.php"><i class="fa-solid fa-arrow-left"></i></a>
                    <h4 class="text-center mb-4" style="color: #996D2A;">You Forgot Password?</h4>
                    <small class="font-weight-light">Don't worry! It happens to us all.</small>
                    <br>
                    <small>Please enter your email address associated with your account and we'll send you an email with instrutions to reset your password.</small>
                    </br><br>
                    <form action="forgotPassword.php" method="post">
                        <h6 class="text-left" style="color: #996D2A;">Email Address</h6>
                        <input class="form-control mt-2" type="email" name="email" placeholder="Enter your email address" required>
                        <div class="text-center">
                            <button class="btn btn-primary mt-5 w-100" type="submit" style="border-radius: 20px;">Continue</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php

    if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
        echo '
        <script>
            Swal.fire({
                title: "' . $_SESSION['message'] . '",
                text: "' . $_SESSION['text'] . '",
                icon: "' . $_SESSION['status'] . '"
            })' . (isset($_SESSION['changePassword']) ? ".then(() => {
                window.location.href = 'logout.php';
            });" : "") . '
        </script>
    ';
        unset($_SESSION['message']);
        unset($_SESSION['text']);
        unset($_SESSION['status']);
    }

    ?>
</body>

</html>