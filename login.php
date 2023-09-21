<?php
session_start();

require_once 'controller/loginController.php';

if ((isset($_COOKIE["login"])) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] === "admin") {
        header("Location: admin.php");
    } else {
        header("Location: index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once 'layout/head.php';
?>

<body>

    <div id="wrap">
        <div id="main">
            <div class="row">
                <div class="col-md-5 logo-login text-end">
                    <img src="assets/img/logo.png" height="">
                </div>
                <div class="col-md-7 login-form">
                    <h2 class="text-center mb-5" style="color: #FFDE59;">LOGIN</h2>
                    <form class="login-input" method="POST" action="login.php">
                        <div class="row row-margin">
                            <div class="col-md-1 ">
                                <i class="fa-solid fa-user icon"></i>
                            </div>
                            <div class="col-md-11">
                                <input id="input-username" type="text" name="username" class="form-control input" placeholder="Username or Email" required>
                            </div>
                        </div>
                        <div class="row row-margin">
                            <div class="col-md-1">
                                <i class="fa-solid fa-lock icon"></i>
                            </div>
                            <div class="col-md-11 input-password-container">
                                <input id="input-password" type="password" name="password" class="form-control input" placeholder="Password" required>
                                <span class="password-toggle" onclick="togglePasswordVisibility('input-password','toggle-password')"><i class="fa-solid fa-eye"> </i></span>
                            </div>
                        </div>
                        <div class="row remember-me">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="checkbox" name="remember" value="remember">
                                    </div>
                                    <div class="col-md-9">Remember Me</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <a  href="forgotPassword.php">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="row row-margin">
                            <button type="submit" class="btn-login">Login</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/passwordVisibility.js"></script>
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