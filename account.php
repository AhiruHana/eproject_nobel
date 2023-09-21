<?php

session_start();
if (!isset($_COOKIE["login-admin"]) || !isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
}

include_once 'controller/accountController.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once 'layout/adminHead.php';
?>

<body class="sb-nav-fixed">
    <?php
    include_once 'layout/adminHeader.php';
    ?>
    <div id="layoutSidenav">
        <?php
        include_once 'layout/adminSidenav.php';
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="my-5">Change password</h3>
                    <form method="post" action="account.php">
                        <table class="table table-border">
                            <tr>
                                <td>Current Password</td>
                                <td class="input-password-container">
                                    <input type="password" id="current-password" class="form-control" name="current-password" required>
                                    <span id="toggle-password" class="password-toggle" style="top:13px ;" onclick="togglePasswordVisibility('current-password','toggle-password')"><i class="fa-solid fa-eye"> </i></span>
                                </td>
                            </tr>
                            <tr>
                                <td>New Password</td>
                                <td class="input-password-container">
                                    <input type="password" id="new-password" class="form-control" name="new-password" required>
                                    <span id="new-toggle-password" class="password-toggle" style="top:13px ;" onclick="togglePasswordVisibility('new-password','new-toggle-password')"><i class="fa-solid fa-eye"> </i></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Confirm New Password</td>
                                <td class="input-password-container">
                                    <input type="password" id="confirm-password" class="form-control" name="confirm-password" required>
                                    <span id="confirm-toggle-password" class="password-toggle"style="top:13px ;" onclick="togglePasswordVisibility('confirm-password','confirm-toggle-password')"><i class="fa-solid fa-eye"> </i></span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn btn-success">Save</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </main>
            <?php
            include_once 'layout/adminFooter.php';
            ?>
        </div>
    </div>
    <?php
    include_once 'layout/adminScript.php';
    ?>
</body>

</html>