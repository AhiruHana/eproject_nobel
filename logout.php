<?php
// Khởi động phiên làm việc
session_start();

// Xóa tất cả các biến phiên làm việc
session_unset();

// Xóa phiên làm việc
session_destroy();

// Xóa cookie đăng nhập
setcookie('login', '', time() - 3600 - 2 * 24 * 60 * 60);
setcookie('login-admin', '', time() - 3600 - 2 * 24 * 60 * 60);

header('Location: login.php');
exit();
