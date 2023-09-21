<?php
session_start();
include_once 'layout/head.php';
include_once 'controller/resetPasswordController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="wrap">
        <div id="main">
            <div class="py-5" style="background-color: white;width:30%;margin:0 auto; border-radius:10px;">
                <div class="mx-3">
                    <a href="verificationCode.php"><i class="fa-solid fa-arrow-left"></i></a>
                    <h4 class="text-center mb-4" style="color: #996D2A;">Set New Password</h4>

                    <br>
                    <form action="resetPassword.php" method="post">
                        <h6 class="text-left" style="color: #996D2A;">Password</h6>
                        <input class="form-control mt-2 mb-4" type="password" name="password" required>

                        <h6 class="text-left" style="color: #996D2A;">Confirm Password</h6>
                        <input class="form-control mt-2" type="password" name="confirm-password" required>

                        <div class="text-center">
                            <button class="btn btn-primary mt-5 w-100" type="submit" style="border-radius: 20px;">Reset Password</button>
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