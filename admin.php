<?php

session_start();

if (!isset($_COOKIE["login-admin"])|| !isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
}
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
                    <h6 class="mt-5">This will be the location of the dashboard later</h6>
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