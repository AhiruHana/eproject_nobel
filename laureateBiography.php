<!DOCTYPE html>
<html lang="en">

<?php
include_once 'layout/head.php';
include_once 'controller/biographyController.php';
?>

<?php
include_once 'layout/header.php'
?>
<main class="container my-5">
    <div class="row">
        <div style="width:22%"></div>
        <div style="width:78%;">
            <h2 class="gy-5"><?php echo $laureate['name'] ?></h2>
            <span class="view"><i class="fa-solid fa-eye"> </i> <?php echo $laureate['view'] ?> views</span>
        </div>
    </div>
    <div class="row">
        <div class=" sitemap">
            <ul class="my-5 px-1">
                <?php
                renderSitemap();
                ?>
            </ul>
        </div>

        <div class=" px-3 bio">
            <div class="infobox pb-4">
                <div class="row gx-1 summary">
                    <h5 class="name"><?php echo $laureate['name'] ?>
                        <?php if ($laureate['real_name'] != "") {
                            echo '<p class="real-name">( ' . $laureate['real_name'] . ' )</p>';
                        } ?>
                    </h5>
                    <div class="laureate-img mb-4">
                        <img class="full-w-h" src="<?php echo $laureate['avatar'] ?>">
                    </div>
                    <table>
                        <?php renderInfobox() ?>
                    </table>

                </div>
            </div>
            <?php
            renderBiography()
            ?>

        </div>
    </div>
    <?php
    renderTicker()
    ?>
</main>
<?php
include_once 'layout/footer.php'
?>
</body>

</html>