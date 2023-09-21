<!DOCTYPE html>
<html lang="en">

<?php
include_once 'layout/head.php';
include_once 'controller/researchDetailController.php';
?>
<!--  -->
<?php
include_once 'layout/header.php'
?>
<main class="container my-5">
    <?php
    renderResearchDetail();
    ?>
    <div class="row my-5">
        <h2>Similar Researches and Experiments</h2>
        <div class=" row mt-5 similar">
            <?php
            renderSimilarResearch()
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