
<?php

require_once 'repository/loginRepository.php';

$username = "";
$password = "";
$remember = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if (isset($_POST['remember'])) {
        $remember = $_POST['remember'];
    }
    // var_dump($remember);

    if ($username != "" && $password != "") {
        $result = getUser($username);

        if ($result != null) {
            $user = $result;
            $hashedPasswordFromDB = $user['password'];

            if (password_verify($password, $hashedPasswordFromDB)) {
                $role = $user['role'];

                if ($remember == "remember") {
                    // 2 ngày = 2 * 24 giờ * 60 phút * 60 giây;   
                    setcookie("login", $username, time() + (2 * 24 * 60 * 60), "/eproject_nobel");
                }

                if ($role === "admin") {
                    setcookie("login-admin", $username, time() + (2 * 24 * 60 * 60), "/eproject_nobel");
                    session_start();
                    $_SESSION["role"] = $role;
                    $_SESSION['username'] = $username;
                    header("Location: admin.php");
                } else {
                    header("Location: index.php");
                }
            } else {
                $_SESSION['message'] = "Login failed!";
                $_SESSION['text'] = " Password is incorrect!";
                $_SESSION['status'] = "error";
                echo $_SESSION['message'];
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Login failed!";
            $_SESSION['text'] = "Username is incorrect!";
            $_SESSION['status'] = "error";
            header("Location: login.php");
            exit();
        }
    }
}


