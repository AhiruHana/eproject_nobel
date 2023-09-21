<?php
session_start();
include_once 'layout/head.php';
include_once 'controller/verificationCodeController.php';
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
                    <a href="forgotPassword.php"><i class="fa-solid fa-arrow-left"></i></a>
                    <h4 class="text-center mb-4" style="color: #996D2A;">Verification Code</h4>
                    <small class="font-weight-light">We have just sent verification code to your email address. Please check your email.</small>
                    <br>
                    <form method="post" action="verificationCode.php">
                        <div class="form-group mt-5">

                            <div class="input-group">
                                <input class="form-control" type="text" id="token1" name="token1" maxlength="1" required oninput="moveToNextInput(event, 'token2')" autofocus>
                                <input class="form-control" type="text" id="token2" name="token2" maxlength="1" required oninput="moveToNextInput(event, 'token3')" onkeyup="moveToPreviousInput(event, 'token1')">
                                <input class="form-control" type="text" id="token3" name="token3" maxlength="1" required oninput="moveToNextInput(event, 'token4')" onkeyup="moveToPreviousInput(event, 'token2')">
                                <input class="form-control" type="text" id="token4" name="token4" maxlength="1" required oninput="moveToNextInput(event, 'token5')" onkeyup="moveToPreviousInput(event, 'token3')">
                                <input class="form-control" type="text" id="token5" name="token5" maxlength="1" required oninput="moveToNextInput(event, 'token6')" onkeyup="moveToPreviousInput(event, 'token4')">
                                <input class="form-control" type="text" id="token6" name="token6" maxlength="1" required onkeyup="moveToPreviousInput(event, 'token5')">
                            </div>
                        </div>
                        <div class="mx-2 my-3">
                            Resend Code
                        </div>
                        <div class="text-center mx-2">
                            <button class="btn btn-primary w-100 " type="submit" style="border-radius: 20px;">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .form-group {
            margin: 0 auto;
        }

        .form-group .input-group {
            display: flex;
        }

        .input-group input {
            flex: 1;
            font-size: 20px;
            border-radius: 10px;
            border: 1px solid #ccc;
            text-align: center;
            margin: 0 10px auto;
            width: 10px;
            font-weight: bold;
        }

        input {
            border-radius: 7px !important;
        }
    </style>
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
    <script>
        function moveToNextInput(event, nextInputId) {
            const input = event.target;
            const inputValue = input.value;
            const maxLength = parseInt(input.getAttribute('maxlength'));
            const currentLength = input.value.length;

            //kiểm tra giá trị nhập vào có phải kí tự hay không
            if (/[^0-9]/.test(inputValue)) {
                input.value = "";
            } else {
                if (currentLength === maxLength) {
                    const nextInput = document.getElementById(nextInputId);
                    if (nextInput) {
                        nextInput.focus();
                    }
                }
            }
        }

        function moveToPreviousInput(event, previousInputId) {
            const input = event.target;
            const currentLength = input.value.length;

            if (event.key === 'Backspace' && currentLength === 0) {
                const previousInput = document.getElementById(previousInputId);
                if (previousInput) {
                    previousInput.focus();
                }
            }
        }
    </script>
</body>

</html>