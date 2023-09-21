<?php
require('layout/head.php');
require 'controller/laureatesController.php';
?>

<!DOCTYPE html>
<?php

require('layout/header.php')
?>

<main>
    <div class="body-main">
        <div class="container">
            <h2 class="mt-5">
                <?php
                echo $cate['name'] ?? "All The Laureates"
                ?>
            </h2>
            <p> <?php
                echo $cate['description'] ?? "";
                ?>
            </p>

            <div class="row">
                <?php
                renderLaureatesByCategory();
                ?>
            </div>
        </div>
    </div>
    <?php
    renderTicker()
    ?>
</main>

<?php
require('layout/footer.php')
?>