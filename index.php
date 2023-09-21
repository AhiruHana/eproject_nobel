<!DOCTYPE html>
<html lang="en">

<?php
include_once 'layout/head.php';
include_once 'controller/indexController.php';
?>
<!--  -->
<?php
include_once 'layout/header.php'
?>
<main class="container my-5">
    <div class="khoi-main">
        <div clas="khoi-scientists">
            <h2 class="khoi-tieu-de">Eminent Laureates</h2>
            <div class="row col-sm-12">
                <?php
                renderEminent()
                ?>
            </div>
        </div>

        <div class="list-prizes my-5">
            <div class="row ">
                <div class="col-md-4 ">
                    <div class="link-prize ">
                        <div class="wrap">
                            <div class="main">
                                <p><a href="laureatesCategory.php" style="color: white;">See the full list of prizes and laureates</a></p>
                                <h1>All Nobel Prizes</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="hinh-anh ">
                        <img class="" src="<?php echo $picture['img'] ?>" height="500px" width="auto" alt=" ">
                    </div>
                </div>
            </div>
        </div>
        <div class="khoi-expriments ">
            <h2 class="khoi-tieu-de ">Experiments of the era</h2>
            <div class="row">
                <?php
                renderResearchEminert()
                ?>
            </div>
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